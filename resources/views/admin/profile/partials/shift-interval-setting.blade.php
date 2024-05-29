<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('シフト間隔') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("シフト提出期間の間隔を設定できます") }}<br>
            {{ __("1ヶ月ごとまたは半月ごとから選択してください") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.company-name.update') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center">
            <div class="flex items-center me-4">
                <input checked id="inline-checked-radio" type="radio" value="1ヶ月毎" name="shift_interval" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-checked-radio" class="ms-2 font-medium text-gray-900 dark:text-gray-300">1ヶ月毎（1日〜月末）</label>
            </div>
            <div class="flex items-center me-4">
                <input id="inline-radio" type="radio" value="半月毎" name="shift_interval" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-radio" class="ms-2 font-medium text-gray-900 dark:text-gray-300">半月毎（1日〜15日, 15日〜月末）</label>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-admin-primary-button>{{ __('Save') }}</x-admin-primary-button>

            @if (session('status') === 'company-name-updated')
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
