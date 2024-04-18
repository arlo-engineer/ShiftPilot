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
        <tbody id="calendar-contents">
            @foreach ($employees as $employee)
            <tr>
                <td class="border-b-2 border-gray-200 px-4 py-3">{{ $employee->name }}</td>
                @foreach ($fullRequestedShifts as $fullRequestedShift)
                    @if ($fullRequestedShift['employee_id'] == $employee->id)
                        <td class="calendar-cell-day day-{{ $day->format('D') }} border-b-2 border-gray-200 px-4 py-3 cursor-pointer">
                            {{-- store_optionのvalueが1のときに保存する --}}
                            <input type="hidden" name="store_option[]" value="0" class="store_option">
                            <input type="hidden" name="company_membership_id[]" value="{{ $fullRequestedShift['employee_id'] }}">
                            <input type="hidden" name="work_date[]" value="{{ $fullRequestedShift['work_date'] }}" class="work-date">
                            <input type="text" name="start_time[]" value="{{ $fullRequestedShift['start_time'] }}" class="start-time w-20 p-0 text-center bg-gray-100 border-none cursor-pointer pointer-events-none">
                            <input type="text" name="end_time[]" value="{{ $fullRequestedShift['end_time'] }}" class="end-time w-20 p-0 text-center bg-gray-100 border-none cursor-pointer pointer-events-none ">
                        </td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
