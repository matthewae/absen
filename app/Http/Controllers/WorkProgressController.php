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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|max:2048'
        ]);

        $workProgress = new WorkProgress();
        $workProgress->user_id = Auth::id();
        $workProgress->title = $request->title;
        $workProgress->description = $request->description;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            $workProgress->attachment = $path;
        }

        $workProgress->save();

        return redirect()->route('work-progress')->with('success', 'Work progress added successfully');
    }

    public function update(Request $request, $id)
    {
        $workProgress = WorkProgress::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|max:2048'
        ]);

        $workProgress->title = $request->title;
        $workProgress->description = $request->description;

        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($workProgress->attachment) {
                Storage::disk('public')->delete($workProgress->attachment);
            }

            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            $workProgress->attachment = $path;
        }

        $workProgress->save();

        return redirect()->route('work-progress')->with('success', 'Work progress updated successfully');
    }

    public function destroy($id)
    {
        $workProgress = WorkProgress::where('user_id', Auth::id())->findOrFail($id);

        if ($workProgress->attachment) {
            Storage::disk('public')->delete($workProgress->attachment);
        }

        $workProgress->delete();

        return redirect()->route('work-progress')->with('success', 'Work progress deleted successfully');
    }
}