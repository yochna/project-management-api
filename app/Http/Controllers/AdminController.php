<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers'    => User::count(),
            'totalProjects' => Project::count(),
            'totalTasks'    => Task::count(),
            'pendingTasks'  => Task::where('status', 'pending')->count(),
            'inProgressTasks' => Task::where('status', 'in-progress')->count(),
            'completedTasks'  => Task::where('status', 'completed')->count(),
        ]);
    }

    public function projects()
    {
        $projects = Project::with(['owner', 'tasks'])->latest()->get();
        return view('admin.projects', compact('projects'));
    }

    public function tasks(Request $request)
    {
        $query = Task::with(['project', 'assignee']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->assigned_to) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $tasks = $query->latest()->get();
        $users = User::all();
        return view('admin.tasks', compact('tasks', 'users'));
    }

    public function users()
    {
        $users = User::withCount(['projects', 'assignedTasks'])->latest()->get();
        return view('admin.users', compact('users'));
    }
}