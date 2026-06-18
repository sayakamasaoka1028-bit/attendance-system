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
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
