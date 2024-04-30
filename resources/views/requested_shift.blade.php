<x-app-layout>
    <div class="pt-8">
        <div class="max-w-5xl mx-auto px-2">
            <!-- ページネーション -->
            <h2 class="calender-title tracking-wider flex justify-center">
                <div class="inline-flex items-center border border-gray-400 rounded-full px-2 py-1">
                    <div class="w-6"><a href="{{ url('/submit-shift?date=' . $calendar->getPreviousMonth()) }}"><img src="{{ asset('img/calendar-left-arrow.png') }}" alt=""></a></div>
                    <div class="px-8">
                        <p class="text-xs">{{ $days[0]->format('Y年') }}</p>
                        <p class="font-bold">{{ $days[0]->format('n月j日') }}</p>
                    </div>
                    <span>-</span>
                    <div class="px-8">
                        <p class="text-xs">{{ end($days)->format('Y年') }}</p>
                        <p class="font-bold">{{ end($days)->format('n月j日') }}</p>
                    </div>
                    <div class="w-6"><a href="{{ url('/submit-shift?date=' . $calendar->getNextMonth()) }}"><img src="{{ asset('img/calendar-right-arrow.png') }}" alt=""></a></div>
                </div>
            </h2>
            <h2>{{ $calendar->getCalendarTitle() }} シフト提出</h2>

            <div class="pt-6 w-full mx-auto text-my-text-color">
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
                        @foreach ($weeks as $week)
                            <tr>
                                @for ($i = 0; $i < 7; $i++)
                                    <td class="border border-gray-400 p-1 sm:p-3 sm:pt-1 day-{{ $week[$i]->format('D') }} @if($week[$i]->format('m') == $days[0]->format('m')) bg-white cursor-pointer  @else bg-gray-200 opacity-70 pointer-events-none @endif">
                                        <p>{{ $week[$i]->format('j') }}</p>
                                        <div class="flex flex-col items-center justify-center text-base">
                                            <p>17:00</p>
                                            <p class="h-1 border-l border-my-text-color"></p>
                                            <p>23:00</p>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-app-layout>
