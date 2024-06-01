<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('シフト提出期限') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("シフトの提出期限を設定できます") }}<br>
            {{ __("「0」の場合は15日や月末が締切となります") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.shift-interval.update') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center">
            <div class="flex items-center me-4">
                <input @if ($company->shift_interval == '1ヶ月毎') checked @endif id="radioOneMonth" type="radio" value="1ヶ月毎" name="shift_interval" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="radioOneMonth" class="ms-2 font-medium text-gray-900 dark:text-gray-300">1ヶ月毎（1日〜月末）</label>
            </div>
            <div class="flex items-center me-4">
                <input @if ($company->shift_interval == '半月毎') checked @endif id="radioHalfMonth" type="radio" value="半月毎" name="shift_interval" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="radioHalfMonth" class="ms-2 font-medium text-gray-900 dark:text-gray-300">半月毎（1日〜15日, 15日〜月末）</label>
            </div>
        </div>

        <div id="oneMonth">
            <select id="first_deadline_1" name="first_deadline_1" class="hidden border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-1" autofocus autocomplete="first_deadline_1">
                <option value="">-</option>
            </select>
            <div class="flex items-center">
                <p>提出期限</p>
                <p class="pl-5">月末から</p>
                <select id="second_deadline_1" name="second_deadline_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-1" autofocus autocomplete="second_deadline_1">
                    @for ($i = 0; $i < 6; $i++)
                        <option value="{{ $i }}" @if ($company->second_deadline == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
                <p>日前</p>
            </div>
        </div>

        <div id="halfMonth">
            <div class="flex items-center">
                <p>提出期限①</p>
                <p class="pl-5">15日から</p>
                <select id="first_deadline_2" name="first_deadline_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-1" autofocus autocomplete="first_deadline_2">
                    @for ($i = 0; $i < 6; $i++)
                        <option value="{{ $i }}" @if ($company->first_deadline == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
                <p>日前</p>
            </div>
            <div class="flex items-center pt-3">
                <p>提出期限②</p>
                <p class="pl-5">月末から</p>
                <select id="second_deadline_2" name="second_deadline_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-1" autofocus autocomplete="second_deadline_2">
                    @for ($i = 0; $i < 6; $i++)
                        <option value="{{ $i }}" @if ($company->second_deadline == $i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
                <p>日前</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-admin-primary-button>{{ __('Save') }}</x-admin-primary-button>

            @if (session('status') === 'shift-interval-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
