<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon; //date & time library
use App\Models\Employee;
class EmployeeDashboardController extends Controller
{
    //When user goes to /employee/dashboard, Laravel loads: employee/dashboard.blade.php
   public function employeeDashboard()
{
    $employeeId = auth()->user()->employee_id;

    $todayAttendance = Attendance::where('employee_id', $employeeId)
        ->where('attendance_date', Carbon::today()->toDateString())
        ->first();

    $todayStatus = 'Not Checked In Yet';
    $checkInTime = null;
    $checkOutTime = null;
    $totalHours = null;

    if ($todayAttendance) {
        if ($todayAttendance->check_in) {
            $checkInTime = Carbon::parse($todayAttendance->check_in)->format('h:i A');

            if ($todayAttendance->status === 'late') {
                $todayStatus = 'Late';
            } else {
                $todayStatus = 'Present';
            }
        }

        if ($todayAttendance->check_out) {
            $checkOutTime = Carbon::parse($todayAttendance->check_out)->format('h:i A');
            $todayStatus = 'Completed';

            $checkIn = Carbon::parse($todayAttendance->check_in);
            $checkOut = Carbon::parse($todayAttendance->check_out);

            $totalMinutes = $checkIn->diffInMinutes($checkOut);
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;

            $totalHours = $hours . 'h ' . $minutes . 'm';
        }
    }

    return view('employee.dashboard', compact(
        'todayStatus',
        'checkInTime',
        'checkOutTime',
        'totalHours'
    ));
}
    //prepares data for the check page
    public function check()
    {
        $employeeId = auth()->user()->employee_id;//get logged-in user
        //get today’s attendance
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->where('attendance_date', Carbon::today()->toDateString())
            ->first();

        $totalHours = null;
      //if record exists,and check_in exists, and check_out exists
        if ($todayAttendance && $todayAttendance->check_in && $todayAttendance->check_out) {
           //convert time because DB stores time as string -->
           //We convert it into Carbon objects to do calculations.
            $checkIn = Carbon::parse($todayAttendance->check_in);
            $checkOut = Carbon::parse($todayAttendance->check_out);
        //calculate difference
            $totalMinutes = $checkIn->diffInMinutes($checkOut);
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;

            $totalHours = $hours . 'h ' . $minutes . 'm';
        }
        //send data to view
        return view('employee.check', [
            'todayAttendance' => $todayAttendance,
            'currentDate' => Carbon::today()->format('d F Y'),
            'totalHours' => $totalHours,
        ]);
    }
    //runs when user clicks Check In button
    public function checkIn()
{
    $employeeId = auth()->user()->employee_id;//get employee

    //check if already checked in
    $todayAttendance = Attendance::where('employee_id', $employeeId)
        ->where('attendance_date', Carbon::today()->toDateString())
        ->first();

    //prevent duplicate
    if ($todayAttendance) {
        return back()->with('error', 'You have already checked in today.');
    }

    //get current time
    $now = Carbon::now();

    //set late limit to 8:10 AM
    $lateTime = Carbon::today()->setTime(8, 10, 0);

    //decide status
    $status = $now->gt($lateTime) ? 'late' : 'present';

    //create new attendance
    Attendance::create([
        'employee_id' => $employeeId,
        'attendance_date' => Carbon::today()->toDateString(),
        'check_in' => $now->format('H:i:s'),
        'status' => $status,
    ]);

    return back()->with('success', 'Checked in successfully.');
}
    //runs when user clicks Check Out
    public function checkOut()
    {
        $employeeId = auth()->user()->employee_id;
        //get attendance
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->where('attendance_date', Carbon::today()->toDateString())
            ->first();
        //must check in first
        if (!$todayAttendance) {
            return back()->with('error', 'You must check in first.');
        }
        //prevent double checkout
        if ($todayAttendance->check_out) {
            return back()->with('error', 'You have already checked out today.');
        }
        //update record
        $todayAttendance->update([
            'check_out' => Carbon::now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Checked out successfully.');
    }

   public function attendance(Request $request)
{
    $employeeId = auth()->user()->employee_id;

    $query = Attendance::where('employee_id', $employeeId);

    // Search by date
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('attendance_date', 'like', '%' . $search . '%');
    }

    // Filter by status
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

    // Filter by specific date
    if ($request->filled('date')) {
        $query->whereDate('attendance_date', $request->date);
    }

    $attendanceRecords = $query->orderBy('attendance_date', 'desc')->get();

    return view('employee.attendance', compact('attendanceRecords'));
}

    public function profile()
{
    $user = auth()->user();

    $employee = Employee::where('employee_id', $user->employee_id)->first();

    return view('employee.profile', compact('user', 'employee'));
}
}