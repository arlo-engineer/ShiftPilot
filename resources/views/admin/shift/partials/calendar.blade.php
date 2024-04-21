{{-- <h2 class="calender-title text-center">{{ $calendarTitle }}</h2> --}}
<h2 class="calender-title tracking-wider flex justify-center">
    <div class="inline-flex items-center border rounded-full px-2 py-1">
        <div class="w-6"><img src="{{ asset('img/calendar-left-arrow.png') }}" alt=""></div>
        <div class="px-8">
            {{-- 表示されているシフトの年月日を動的に表示 --}}
            <p class="text-xs">2024年</p>
            <p class="font-bold">5月1日(水)</p>
        </div>
        <span>-</span>
        <div class="px-8">
            <p class="text-xs">2024年</p>
            <p class="font-bold">5月31日(金)</p>
        </div>
        <div class="w-6"><img src="{{ asset('img/calendar-right-arrow.png') }}" alt=""></div>
    </div>
</h2>

<div class="pt-8 flex text-xs items-center justify-end">
    <p>凡例</p>
    <div class="flex items-center pl-4">
        <div class="h-4 w-7 rounded bg-my-main-color"></div>
        <p class="pl-1.5">確定シフト</p>
    </div>
    <div class="flex items-center pl-4">
        <div class="h-4 w-7 rounded bg-my-sub-color"></div>
        <p class="pl-1.5">下書きシフト</p>
    </div>
    <div class="flex items-center pl-4">
        <div border-my-sub-colorv class="h-4 w-7 border-b-4 border-my-sub-color"></div>
        <p class="pl-1.5">希望シフト</p>
    </div>
</div>

<div class="pt-6 w-full mx-auto overflow-auto text-my-text-color">
    <table id="calendar" class="w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="border border-gray-200 px-4 py-3 tracking-wider font-medium text-sm bg-gray-100 whitespace-nowrap min-w-48">名前</th>
                @foreach ($days as $day)
                <th class="day-{{ $day->format("D") }} border border-gray-200 px-4 py-3 tracking-wider font-bold text-sm bg-gray-100 text-center">
                    <p class="day">{{ $day->format("j") }} ({{ $day->locale('ja')->isoFormat("ddd") }})</p>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody id="calendar-contents">
            @foreach ($employees as $employee)
            <tr>
                <td class="px-4 py-3 border border-gray-200 whitespace-nowrap min-w-48">{{ $employee->name }}</td>
                @foreach ($fullRequestedShifts as $fullRequestedShift)
                    @if ($fullRequestedShift['employee_id'] == $employee->id)
                        <td class="calendar-cell-day day-{{ $day->format('D') }} border border-gray-200 px-1 py-2 cursor-pointer text-center text-sm">
                            {{-- store_optionのvalueが1のときに保存する --}}
                            <input type="hidden" name="store_option[]" value="0" class="store_option">
                            <input type="hidden" name="company_membership_id[]" value="{{ $fullRequestedShift['employee_id'] }}">
                            <input type="hidden" name="work_date[]" value="{{ $fullRequestedShift['work_date'] }}" class="work-date">
                            <div class="invisible input-time flex pointer-events-none">
                                <input type="text" name="start_time[]" value="" class="input-start-time w-11 p-0 text-center text-sm text-white bg-my-main-color rounded-l-sm border-none cursor-pointer">
                                <span class="bg-my-main-color text-white">-</span>
                                <input type="text" name="end_time[]" value="" class="input-end-time w-11 p-0 text-center text-sm text-white bg-my-main-color rounded-r-sm border-none cursor-pointer">
                            </div>
                            @if (!empty($fullRequestedShift['start_time']) || !empty($fullRequestedShift['end_time']))
                            <div class="flex justify-center text-my-main-color border-b-4 border-my-sub-color pointer-events-none pt-2">
                                <p class="start-time w-11">{{ $fullRequestedShift['start_time'] }}</p>
                                <span>-</span>
                                <p class="end-time w-11">{{ $fullRequestedShift['end_time'] }}</p>
                            </div>
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
