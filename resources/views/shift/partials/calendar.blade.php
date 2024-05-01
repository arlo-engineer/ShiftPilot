<!-- カレンダー -->
<table id="calendar" class="w-full text-left whitespace-no-wrap border border-gray-400 text-sm">
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
    <tbody id="required-shift-contents">
        @foreach ($fullRequestedShiftsPerEmployee as $fullRequestedShiftPerEmployee)
            <tr>
                @for ($i = 0; $i < 7; $i++)
                    <td class="required-shift-cell border border-gray-400 p-1 sm:p-3 sm:pt-1 day-{{ $fullRequestedShiftPerEmployee[$i]['day']->format('D') }} @if ($fullRequestedShiftPerEmployee[$i]['requested'] && $fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m')) bg-my-accent-color-lighter cursor-pointer register @elseif($fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m')) bg-white cursor-pointer  @else bg-gray-200  pointer-events-none @endif">
                        <p class="sm:text-sm text-xs">{{ $fullRequestedShiftPerEmployee[$i]['day']->format('j') }}</p>
                        <input type="hidden" name="store_option[]" value="0" class="store_option">
                        <input type="hidden" name="company_membership_id[]" value="{{ $companyMembership->getCompanyMembershipIdByUserId() }}">
                        <input type="hidden" name="work_date[]" value="{{ $fullRequestedShiftPerEmployee[$i]['day']->format('Y-n-j') }}" class="work-date">
                        {{-- 備考欄は後ほど実装予定 --}}
                        {{-- <input type="hidden" name="notes[]" value="" class="notes"> --}}
                        @if ($fullRequestedShiftPerEmployee[$i]['requested'] && $fullRequestedShiftPerEmployee[$i]['day']->format('m') == $days[0]->format('m'))
                            <div class="required-shift flex flex-col items-center justify-center text-sm pointer-events-none">
                                <input type="time" name="start_time[]" value="{{ $fullRequestedShiftPerEmployee[$i]['requested']['start_time'] }}" class="calendar-time input-start-time p-0 border-none bg-transparent text-sm sm:text-base">
                                <p class="h-1 border-l border-my-text-color"></p>
                                <input type="time" name="end_time[]" value="{{ $fullRequestedShiftPerEmployee[$i]['requested']['end_time'] }}" class="calendar-time input-end-time p-0 border-none bg-transparent text-sm sm:text-base">
                            </div>
                        @else
                            <div class="invisible tmp-shift flex flex-col items-center justify-center text-sm pointer-events-none">
                                {{-- 設定でvalueの値を設定する？(要検討) --}}
                                <input type="time" name="start_time[]" value="" class="input-start-time calendar-time p-0 border-none text-sm sm:text-base bg-transparent">
                                <p class="h-1 border-l border-my-text-color"></p>
                                {{-- 設定でvalueの値を設定する？(要検討) --}}
                                <input type="time" name="end_time[]" value="" class="input-end-time calendar-time p-0 border-none text-sm sm:text-base bg-transparent">
                            </div>
                        @endif
                    </td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
