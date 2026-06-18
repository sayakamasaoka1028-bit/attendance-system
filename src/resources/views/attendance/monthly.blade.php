<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow-lg p-8">

                <h1 class="text-3xl font-bold mb-6">
                    勤怠一覧
                </h1>

<div class="mb-6 text-right">
    <a href="{{ route('attendance.index') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        今日の勤怠へ
    </a>
</div>

<a href="{{ route('attendance.exportCsv') }}"
   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
    CSV出力
</a>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    <div class="bg-blue-50 rounded-xl p-4">
        <p class="text-sm text-blue-600">勤務日数</p>
        <p class="text-2xl font-bold">
            {{ $workDays }}日
        </p>
    </div>

    <div class="bg-green-50 rounded-xl p-4">
        <p class="text-sm text-green-600">総勤務時間</p>
        <p class="text-2xl font-bold">
            {{ floor($totalWorkMinutes / 60) }}時間
            {{ $totalWorkMinutes % 60 }}分
        </p>
    </div>

    <div class="bg-yellow-50 rounded-xl p-4">
        <p class="text-sm text-yellow-600">総休憩時間</p>
        <p class="text-2xl font-bold">
            {{ $totalBreakMinutes }}分
        </p>
    </div>

</div>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3">日付</th>
                            <th class="text-left p-3">出勤</th>
                            <th class="text-left p-3">退勤</th>
                            <th class="text-left p-3">休憩</th>
                            <th class="text-left p-3">勤務</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($attendances as $attendance)
                        <tr class="border-b">
                            <td class="p-3">
                                {{ $attendance->work_date }}
                            </td>

                            <td class="p-3">
                                {{ $attendance->clock_in }}
                            </td>

                            <td class="p-3">
                                {{ $attendance->clock_out }}
                            </td>

                            <td class="p-3">
                                {{ $attendance->break_minutes }}分
                            </td>

                            <td class="p-3">
                                {{ floor($attendance->work_minutes / 60) }}時間
                                {{ $attendance->work_minutes % 60 }}分
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
