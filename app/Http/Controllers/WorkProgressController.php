<?php

namespace App\Http\Controllers;

use App\Models\WorkProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkProgressController extends Controller
{
    public function index()
    {
        $workProgresses = WorkProgress::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('work-progress.index', compact('workProgresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|in:' . implode(',', WorkProgress::categories()),
            'title' => 'required|string|max:255',
            'description' => ['required', 'string', function($attribute, $value, $fail) {
                if (str_word_count($value) < 20) {
                    $fail('The description must be at least 20 words.');
                }
            }],
            'attachment.*' => 'required|file|max:153600' // 150MB limit
        ]);

        $workProgress = new WorkProgress();
        $workProgress->user_id = Auth::id();
        $workProgress->category = $request->category;
        $workProgress->title = $request->title;
        $workProgress->description = $request->description;
        $workProgress->save();

        if ($request->hasFile('attachment')) {
            foreach($request->file('attachment') as $file) {
                $path = $file->store('attachments', 'public');
                
                $workProgress->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }
        }


        return redirect()->route('work-progress')->with('success', 'Work progress added successfully');
    }

    public function update(Request $request, $id)
    {
        $workProgress = WorkProgress::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'category' => 'required|string|in:' . implode(',', WorkProgress::categories()),
            'title' => 'required|string|max:255',
            'description' => ['required', 'string', function($attribute, $value, $fail) {
                if (str_word_count($value) < 20) {
                    $fail('The description must be at least 20 words.');
                }
            }],
            'attachment.*' => 'nullable|file|max:153600' // 150MB limit
        ]);

        $workProgress->title = $request->title;
        $workProgress->description = $request->description;

        if ($request->hasFile('attachment')) {
            // Delete old attachments
            foreach ($workProgress->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $workProgress->attachments()->delete();

            // Store new attachments
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('attachments', 'public');
                
                $workProgress->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        $workProgress->save();

        return redirect()->route('work-progress')->with('success', 'Work progress updated successfully');
    }

    public function destroy($id)
    {
        $workProgress = WorkProgress::where('user_id', Auth::id())->findOrFail($id);

        // Delete all attachments
        foreach ($workProgress->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $workProgress->delete(); // This will also delete attachments due to cascade

        return redirect()->route('work-progress')->with('success', 'Work progress deleted successfully');
    }
}