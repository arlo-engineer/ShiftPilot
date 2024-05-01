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
        {{-- <div>{{ $calendar->getCalendarTitle() }} シフト提出</div> --}}
        <div class="w-6"><a href="{{ url('/submit-shift?date=' . $calendar->getNextMonth()) }}"><img src="{{ asset('img/calendar-right-arrow.png') }}" alt=""></a></div>
    </div>
</h2>
