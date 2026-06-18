<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">
            {{ $user->name }} さんの勤怠詳細
        </h1>

        <a href="{{ route('attendance.admin') }}" class="text-blue-600">
            管理者画面へ戻る
        </a>

        <table class="w-full border mt-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">日付</th>
                    <th class="border p-2">出勤</th>
                    <th class="border p-2">退勤</th>
                    <th class="border p-2">休憩</th>
                    <th class="border p-2">勤務</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td class="border p-2">{{ $attendance->work_date }}</td>
                        <td class="border p-2">{{ $attendance->clock_in }}</td>
                        <td class="border p-2">{{ $attendance->clock_out }}</td>
                        <td class="border p-2">{{ $attendance->break_minutes }}分</td>
                        <td class="border p-2">
                            {{ floor($attendance->work_minutes / 60) }}時間
                            {{ $attendance->work_minutes % 60 }}分
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
