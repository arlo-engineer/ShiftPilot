<h3 class="calender-title">{{ $calendarTitle }}</h3>
<div class="lg:w-2/3 w-full mx-auto overflow-auto">
    <table id="calendar" class="w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="border-b-2 px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl" style="width: 200px !import">名前</th>
                @foreach ($days as $day)
                <th class="day-{{ $day->format("D") }} border-b-2 px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">
                    <p class="date">{{ $day->format("j") }}</p>
                    <p class="day">{{ $day->locale('ja')->isoFormat("ddd") }}</p>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td class="border-b-2 border-gray-200 px-4 py-3">{{ $employee->name }}</td>
                {{-- 現在はからテーブルの表示だが、最終的にはrequested_shiftsテーブルから取得した出退勤時間をモーダルに表示し、
                モーダル内の出退勤時間をカレンダー上に表示する。DBから取得したデータを直接出力するわけではない点に注意する。 --}}
                @foreach ($days as $day)
                <td class="modal-user-{{ $employee->id }}-date-{{ $day->format('Y-m-d') }} day-{{ $day->format('D') }} border-b-2 border-gray-200 px-4 py-3 cursor-pointer calendar-cell">
                    {{-- 出勤時間(モーダルから取得する)＝input側 --}}
                    <p class="start-time-user-{{ $employee->id }}-date-{{ $day->format('Y-m-d') }}"></p>
                    {{-- 退勤時間(モーダルから取得する)＝input側 --}}
                    <p class="end-time-user-{{ $employee->id }}-date-{{ $day->format('Y-m-d') }}"></p>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
