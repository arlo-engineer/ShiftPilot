<x-app-layout>
    <div class="pt-8">
        <div class="max-w-7xl mx-auto px-2">
            <!-- ページネーション -->
            <h2 class="calender-title tracking-wider flex justify-center">
                <div class="inline-flex items-center border border-gray-400 rounded-full px-2 py-1">
                    <div class="w-6"><a href="{{ url('/shift?date=' . $calendar->getPreviousMonth()) }}"><img src="{{ asset('img/calendar-left-arrow.png') }}" alt=""></a></div>
                    <div class="px-8">
                        <p class="text-xs">{{ $days[0]->format('Y年') }}</p>
                        <p class="font-bold">{{ $days[0]->format('n月j日') }}</p>
                    </div>
                    <span>-</span>
                    <div class="px-8">
                        <p class="text-xs">{{ end($days)->format('Y年') }}</p>
                        <p class="font-bold">{{ end($days)->format('n月j日') }}</p>
                    </div>
                    <div class="w-6"><a href="{{ url('/shift?date=' . $calendar->getNextMonth()) }}"><img src="{{ asset('img/calendar-right-arrow.png') }}" alt=""></a></div>
                </div>
            </h2>

            <div class="pt-6 w-full mx-auto overflow-auto text-my-text-color">
                <table id="calendar" class="w-full text-left whitespace-no-wrap border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <th class="nameColumn sticky top-0 -left-0 border border-gray-400 px-4 py-3 tracking-wider font-medium text-sm bg-gray-100 whitespace-nowrap sm:min-w-48">名前</th>
                            @foreach ($days as $day)
                            <th class="day-{{ $day->format("D") }} border-t border-r border-b border-gray-400 px-4 py-3 tracking-wider font-bold text-sm bg-gray-100 text-center">
                                <p class="day">{{ $day->format("j") }} ({{ $day->locale('ja')->isoFormat("ddd") }})</p>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="calendar-contents">
                        @foreach ($employees as $employee)
                        <tr>
                            <td class="nameColumn sticky top-0 -left-0 px-4 py-3 border-l border-b border-r border-gray-400 whitespace-nowrap sm:min-w-48 @if($employee->id === $userId) bg-user-sub-color-lighter @else bg-white @endif">
                                <p class="font-bold">{{ $employee->name }}</p>
                            </td>
                            @foreach ($fullShifts as $fullShift)
                                @if ($fullShift['employee_id'] == $employee->id)
                                    <td class="calendar-cell-day day-{{ $day->format("D") }} border-r border-b border-gray-400 px-1 py-2 text-center text-sm @if($employee->id === $userId) bg-user-sub-color-lighter @else bg-white @endif">
                                        @if (!empty($fullShift['created']['start_time']) || !empty($fullShift['created']['end_time']))
                                            <div class="created-shift bg-user-main-color rounded py-1 text-white flex flex-col items-center justify-center">
                                                <p class="start-time">{{ $fullShift['created']['start_time'] }}</p>
                                                <p class="h-1 border-l"></p>
                                                <p class="end-time">{{ $fullShift['created']['end_time'] }}</p>
                                            </div>
                                        @else
                                            <div class="h-[52px]"></div>
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
