<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">
            勤怠管理者画面
        </h1>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">名前</th>
                    <th class="border p-2">メール</th>
<th class="border p-2">勤務日数</th>
<th class="border p-2">勤務時間</th>

                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)

<tr>
<td class="border p-2">
    <a href="{{ route('attendance.adminUser', $user) }}" class="text-blue-600 underline">
        {{ $user->name }}
    </a>
</td>

    <td class="border p-2">{{ $user->email }}</td>

    <td class="border p-2">
        {{ $user->attendances->count() }}日
    </td>

    <td class="border p-2">
        {{ floor($user->attendances->sum('work_minutes') / 60) }}時間
        {{ $user->attendances->sum('work_minutes') % 60 }}分
    </td>
</tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
