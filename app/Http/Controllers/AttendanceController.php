<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // runs when user opens /attendance
    public function index(Request $request)
    {
        //start query from attendance table and load employee data
        $query = Attendance::with('employee');

        if ($request->filled('search')) {
            $search = $request->search;
        //Filter attendance based on employee relation
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
    $status = $request->status;

    if ($status === 'completed') {
        $query->whereNotNull('check_in')
              ->whereNotNull('check_out');
    } elseif ($status === 'present') {
        $query->where('status', 'present')
              ->whereNotNull('check_in')
              ->whereNull('check_out');
    } elseif ($status === 'late') {
        $query->where('status', 'late')
              ->whereNotNull('check_in')
              ->whereNull('check_out');
    } else {
        $query->where('status', $status);
    }
}

        if ($request->filled('attendance_date')) {
            $query->whereDate('attendance_date', $request->attendance_date);
        }

        $attendanceRecords = $query->orderBy('attendance_date', 'desc')
                                   ->paginate(10)
                                   ->appends($request->query());
        // send to view
        return view('admin.attendance.index', compact('attendanceRecords'));
    }
}