<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        abort(403, 'Unauthorized role');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function employeeDashboard()
    {
        return view('employee.dashboard');
    }
}