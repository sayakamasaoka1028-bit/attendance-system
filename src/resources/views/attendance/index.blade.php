
<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                    勤怠管理
                </h1>

<div class="mb-6 text-right">
    <a href="{{ route('attendance.monthly') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
        勤怠一覧を見る
    </a>
</div>

                @if(!$attendance)
                    <div class="text-center">
                        <p class="text-gray-600 mb-6">本日の出勤打刻をしてください</p>

                        <form method="POST" action="{{ route('attendance.clockin') }}">
                            @csrf
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-xl shadow">
                                出勤する
                            </button>
                        </form>
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">出勤時刻</p>
                            <p class="text-xl font-semibold text-gray-800">{{ $attendance->clock_in }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500">休憩時間</p>
                            <p class="text-xl font-semibold text-gray-800">{{ $attendance->break_minutes }} 分</p>
                        </div>

                        @if(!$attendance->clock_out)
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4">
                                <form method="POST" action="{{ route('attendance.breakStart') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-xl">
                                        休憩開始
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('attendance.breakEnd') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl">
                                        休憩終了
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('attendance.clockout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl">
                                        退勤する
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-sm text-gray-500">退勤時刻</p>
                                <p class="text-xl font-semibold text-gray-800">{{ $attendance->clock_out }}</p>
                            </div>

                            <div class="bg-blue-50 rounded-xl p-4">
                                <p class="text-sm text-blue-600">勤務時間</p>
<p class="text-2xl font-bold text-blue-800">
    {{ floor($attendance->work_minutes / 60) }}時間
    {{ $attendance->work_minutes % 60 }}分
</p>

                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>


