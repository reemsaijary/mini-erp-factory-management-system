<x-layouts.employee>

    <h1 class="text-2xl font-bold mb-6">Check In / Check Out</h1>

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <p class="text-lg font-medium">Current Date: {{ $currentDate }}</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-8 rounded-lg shadow text-center">

        @if (!$todayAttendance)
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-gray-700">Not Checked In Yet</h2>
            </div>

            <form method="POST" action="{{ route('employee.checkin') }}">
                @csrf
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-lg text-2xl font-semibold">
                    Check In
                </button>
            </form>

        @elseif ($todayAttendance && $todayAttendance->check_in && !$todayAttendance->check_out)
            <div class="mb-8 space-y-2">
                <h2 class="text-3xl font-semibold text-gray-700">
                    Checked in at {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('h:i A') }}
                </h2>

                @if($todayAttendance->status === 'late')
                    <p class="text-red-600 font-medium text-lg">Status: Late</p>
                @else
                    <p class="text-yellow-600 font-medium text-lg">Status: Present</p>
                @endif
            </div>

            <form method="POST" action="{{ route('employee.checkout') }}">
                @csrf
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-lg text-2xl font-semibold">
                    Check Out
                </button>
            </form>

        @elseif ($todayAttendance && $todayAttendance->check_in && $todayAttendance->check_out)
            <div class="mb-8 space-y-2">
                <h2 class="text-3xl font-semibold text-gray-700">
                    Checked in at {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('h:i A') }}
                </h2>
                <h2 class="text-3xl font-semibold text-gray-700">
                    Checked out at {{ \Carbon\Carbon::parse($todayAttendance->check_out)->format('h:i A') }}
                </h2>
                <h2 class="text-3xl font-semibold text-gray-700">
                    Total Hours: {{ $totalHours }}
                </h2>
            </div>

            <div class="bg-green-500 text-white px-10 py-4 rounded-lg text-2xl font-semibold inline-block">
                Attendance Completed For Today
            </div>
        @endif

    </div>

</x-layouts.employee>