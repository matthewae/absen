@extends('layouts.app')

@section('content')
<div class="sidebar">
    <div class="sidebar-brand">
        PT. Mandajaya
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('home') }}" class="menu-item">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('work-progress') }}" class="menu-item">
            <i class="fas fa-tasks"></i> Work Progress
        </a>
    </div>
</div>

<div class="main-content">
    @yield('dashboard-content')
</div>

<style>
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 250px;
        background: #2c3e50;
        color: white;
        padding: 1rem;
        z-index: 1000;
    }

    .sidebar-brand {
        padding: 1.5rem 1rem;
        color: #FFD700;
        font-weight: 700;
        font-size: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .menu-item {
        padding: 0.75rem 1rem;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        margin: 0.25rem 0;
    }

    .menu-item:hover {
        background: rgba(255,255,255,0.1);
        color: #FFD700;
    }

    .menu-item i {
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
    }

    .main-content {
        margin-left: 250px;
        padding: 2rem;
    }
</style>
@endsection