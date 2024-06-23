<!-- ページネーション -->
<h2 class="calender-title tracking-wider flex justify-center">
    <div class="inline-flex items-center border border-gray-400 rounded-full px-2 py-1">
        <div class="w-6"><a href="{{ url('/admin/shift?date=' . $calendar->getPreviousMonth()) }}"><img src="{{ asset('img/calendar-left-arrow.png') }}" alt=""></a></div>
        <div class="px-8">
            <p class="text-xs">{{ $days[0]->format('Y年') }}</p>
            <p class="font-bold">{{ $days[0]->format('n月j日') }}</p>
        </div>
        <span>-</span>
        <div class="px-8">
            <p class="text-xs">{{ end($days)->format('Y年') }}</p>
            <p class="font-bold">{{ end($days)->format('n月j日') }}</p>
        </div>
        <div class="w-6"><a href="{{ url('/admin/shift?date=' . $calendar->getNextMonth()) }}"><img src="{{ asset('img/calendar-right-arrow.png') }}" alt=""></a></div>
    </div>
</h2>

<div class="pt-8 flex text-xs items-center justify-end">
    <p>凡例</p>
    <div class="flex items-center pl-4">
        <div class="h-4 w-7 rounded bg-admin-main-color"></div>
        <p class="pl-1.5">確定シフト</p>
    </div>
    <div class="flex items-center pl-4">
        <div class="h-4 w-7 rounded bg-admin-sub-color-lighter border border-admin-main-color"></div>
        <p class="pl-1.5">下書きシフト</p>
    </div>
    <div class="flex items-center pl-4">
        <div border-admin-sub-colorv class="h-4 w-7 border-b-4 border-admin-sub-color"></div>
        <p class="pl-1.5">希望シフト</p>
    </div>
</div>

<div class="pt-6 w-full mx-auto overflow-auto text-my-text-color">
    <table id="calendar" class="w-full text-left whitespace-no-wrap border-separate border-spacing-0">
        <thead>
            <tr>
                <th class="nameColumn sticky top-0 -left-0 border border-gray-400 px-4 py-3 tracking-wider font-medium text-sm bg-gray-100 whitespace-nowrap sm:min-w-48">名前</th>
                @foreach ($days as $day)
                <th class="day-{{ $day->format("D") }} border-t border-r border-b border-gray-400 px-4 py-3 tracking-wider font-bold text-sm bg-gray-100 text-center sm:min-w-28">
                    <p class="day">{{ $day->format("j") }} ({{ $day->locale('ja')->isoFormat("ddd") }})</p>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody id="calendar-contents">
            @php
                $i = 0;
            @endphp
            @foreach ($employees as $employee)
            <tr>
                <td class="nameColumn sticky top-0 -left-0 px-4 py-3 bg-white border-l border-b border-r border-gray-400 whitespace-nowrap sm:min-w-48">
                    <p class="font-bold">{{ $employee->name }}</p>
                    {{-- 確定シフトと下書きシフトの出退勤時間の和を動的に表示(実装予定) --}}
                    <p class="text-xs">13時間20分</p>
                </td>
                @foreach ($fullShifts as $fullShift)
                    @if ($fullShift['employee_id'] == $employee->id)
                        <td class="calendar-cell-day day-{{ $fullShift['work_date']->format("D") }} border-r border-b border-gray-400 px-1 py-2 cursor-pointer text-center text-sm hover:bg-gray-100 @if(!empty($fullShift['created']['start_time']) || !empty($fullShift['created']['end_time'])) register @endif">
                            {{-- store_optionのvalueが1のときに保存する --}}
                            <input type="hidden" name="data[{{ $i }}][store_option]" value="0" class="store_option">
                            <input type="hidden" name="data[{{ $i }}][company_membership_id]" value="{{ $fullShift['company_membership_id'] }}">
                            <input type="hidden" name="data[{{ $i }}][work_date]" value="{{ $fullShift['work_date']->format('Y-n-j') }}" class="work-date">
                            @if (!empty($fullShift['created']['start_time']) || !empty($fullShift['created']['end_time']))
                                <div class="hidden tmp-shift bg-admin-sub-color-lighter rounded py-1 border border-admin-main-color flex pointer-events-none justify-center">
                                    <input type="time" name="data[{{ $i }}][start_time]" value="" class="calendar-time input-start-time w-11 p-0 text-center text-sm bg-admin-sub-color-lighter rounded-l-sm border-none cursor-pointer">
                                    <span class="bg-admin-sub-color-lighter">-</span>
                                    <input type="time" name="data[{{ $i }}][end_time]" value="" class="calendar-time input-end-time w-11 p-0 text-center text-sm bg-admin-sub-color-lighter rounded-r-sm border-none cursor-pointer">
                                </div>
                                <div class="created-shift bg-admin-main-color rounded py-1 pointer-events-none text-white flex justify-center">
                                    <p class="start-time w-11">{{ $fullShift['created']['start_time'] }}</p>
                                    <span>-</span>
                                    <p class="end-time w-11">{{ $fullShift['created']['end_time'] }}</p>
                                </div>
                                @php $i++; @endphp
                            @else
                                <div class="invisible tmp-shift bg-admin-sub-color-lighter rounded py-1 border border-admin-main-color flex pointer-events-none justify-center">
                                    <input type="time" name="data[{{ $i }}][start_time]" value="" class="calendar-time input-start-time w-11 p-0 text-center text-sm bg-admin-sub-color-lighter rounded-l-sm border-none cursor-pointer">
                                    <span class="bg-admin-sub-color-lighter">-</span>
                                    <input type="time" name="data[{{ $i }}][end_time]" value="" class="calendar-time input-end-time w-11 p-0 text-center text-sm bg-admin-sub-color-lighter rounded-r-sm border-none cursor-pointer">
                                </div>
                                @php $i++; @endphp
                            @endif
                            @if (!empty($fullShift['requested']['start_time']) || !empty($fullShift['requested']['end_time']))
                            <div class="flex justify-center text-admin-main-color border-b-4 border-admin-sub-color pt-2 pointer-events-none">
                                <p class="start-time w-11">{{ $fullShift['requested']['start_time'] }}</p>
                                <span>-</span>
                                <p class="end-time w-11">{{ $fullShift['requested']['end_time'] }}</p>
                            </div>
                            @else
                            <div class="flex justify-center text-admin-main-color border-b-4 border-transparent pt-2 pointer-events-none invisible">
                                <p class="start-time w-11"></p>
                                <span>-</span>
                                <p class="end-time w-11"></p>
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
