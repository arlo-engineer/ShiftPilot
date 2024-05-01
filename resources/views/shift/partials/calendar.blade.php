<!-- カレンダー -->
<table class="w-full text-left whitespace-no-wrap border border-gray-400 text-sm">
    <thead>
        <tr class="text-center bg-gray-100 font-bold">
            <td class="border border-gray-400 day-Sun">日</td>
            <td class="border border-gray-400 day-Mon">月</td>
            <td class="border border-gray-400 day-Tue">火</td>
            <td class="border border-gray-400 day-Wed">水</td>
            <td class="border border-gray-400 day-The">木</td>
            <td class="border border-gray-400 day-Fri">金</td>
            <td class="border border-gray-400 day-Sat">土</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($fullRequestedShiftsPerEmployee as $fullRequestedShiftPerEmployee)
            <tr>
                @for ($i = 0; $i < 7; $i++)
                    <td class="border border-gray-400 p-1 sm:p-3 sm:pt-1 day-{{ $fullRequestedShiftPerEmployee[$i]['day']->format('D') }} @if ($fullRequestedShiftPerEmployee[$i]['requested'] && $fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m')) bg-my-accent-color-lighter @elseif($fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m')) bg-white cursor-pointer  @else bg-gray-200 opacity-70 pointer-events-none @endif">
                        <p>{{ $fullRequestedShiftPerEmployee[$i]['day']->format('j') }}</p>
                        <input type="hidden" name="store_option[]" value="0" class="store_option">
                        <input type="hidden" name="company_membership_id[]" value="{{ $companyMembership->getCompanyMembershipIdByUserId() }}">
                        <input type="hidden" name="work_date[]" value="{{ $fullRequestedShiftPerEmployee[$i]['day']->format('Y-m-d') }}" class="work-date">
                        <input type="hidden" name="notes[]" value="" class="notes">
                        @if ($fullRequestedShiftPerEmployee[$i]['requested'] && $fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m'))
                            <div class="flex flex-col items-center justify-center text-sm">
                                <input type="time" name="start_time[]" value="{{ $fullRequestedShiftPerEmployee[$i]['requested']['start_time'] }}" class="calendar-time p-0 border-none bg-my-accent-color-lighter">
                                <p class="h-1 border-l border-my-text-color"></p>
                                <input type="time" name="end_time[]" value="{{ $fullRequestedShiftPerEmployee[$i]['requested']['end_time'] }}" class="calendar-time p-0 border-none bg-my-accent-color-lighter">
                            </div>
                        @else
                            <div class="invisible flex flex-col items-center justify-center text-sm">
                                <input type="time" name="start_time[]" value="" class="calendar-time p-0 border-none">
                                <p class="h-1 border-l border-my-text-color"></p>
                                <input type="time" name="end_time[]" value="" class="calendar-time p-0 border-none">
                            </div>
                        @endif

                    </td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
