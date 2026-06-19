<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">勤怠編集</h1>

        <form method="POST" action="{{ route('attendance.update', $attendance) }}">
            @csrf

            <div class="mb-4">
                <label>出勤時刻</label>
                <input type="datetime-local" name="clock_in"
                    value="{{ \Carbon\Carbon::parse($attendance->clock_in)->format('Y-m-d\TH:i') }}"
                    class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>退勤時刻</label>
                <input type="datetime-local" name="clock_out"
                    value="{{ \Carbon\Carbon::parse($attendance->clock_out)->format('Y-m-d\TH:i') }}"
                    class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>休憩時間(分)</label>
                <input type="number" name="break_minutes"
                    value="{{ $attendance->break_minutes }}"
                    class="border p-2 w-full">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                保存
            </button>
        </form>
    </div>
</x-app-layout>
