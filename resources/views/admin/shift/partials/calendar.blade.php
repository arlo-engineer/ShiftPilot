<h3 class="calender-title">{{ $calendarTitle }}</h3>
<div class="lg:w-2/3 w-full mx-auto overflow-auto">
    <table id="calendar" class="w-full text-left whitespace-no-wrap">
        <thead>
            <tr>
                <th class="border-b-2 px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                @foreach ($days as $day)
                <th class="day-{{ $day->format("D") }} border-b-2 px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-center">
                    <p class="date">{{ $day->format("j") }}</p>
                    <p class="day">{{ $day->locale('ja')->isoFormat("ddd") }}</p>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody id="calendar-contents">
            @foreach ($employees as $employee)
            <tr>
                <td class="border-b-2 border-gray-200 px-4 py-3">{{ $employee->name }}</td>
                @foreach ($fullRequestedShifts as $fullRequestedShift)
                    @if ($fullRequestedShift['employee_id'] == $employee->id)
                        <td class="calendar-cell-day day-{{ $day->format('D') }} border-b-2 border-gray-200 px-4 py-3 cursor-pointer text-center">
                            {{-- store_optionのvalueが1のときに保存する --}}
                            <input type="hidden" name="store_option[]" value="0" class="store_option">
                            <input type="hidden" name="company_membership_id[]" value="{{ $fullRequestedShift['employee_id'] }}">
                            <input type="hidden" name="work_date[]" value="{{ $fullRequestedShift['work_date'] }}" class="work-date">
                            <div class="input-time flex hidden pointer-events-none">
                                <input type="text" name="start_time[]" value="" class="input-start-time w-14 p-0 text-center bg-gray-100 border-none cursor-pointer">
                                <span>ー</span>
                                <input type="text" name="end_time[]" value="" class="input-end-time w-14 p-0 text-center bg-gray-100 border-none cursor-pointer">
                            </div>
                            <div class="flex justify-center pointer-events-none">
                                <p class="start-time w-14">{{ $fullRequestedShift['start_time'] }}</p>
                                @if (!empty($fullRequestedShift['start_time']))
                                <span>ー</span>
                                @endif
                                <p class="end-time w-14">{{ $fullRequestedShift['end_time'] }}</p>
                            </div>
                        </td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
