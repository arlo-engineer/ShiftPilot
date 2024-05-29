<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('リマインド通知') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("シフト提出期限直前でのリマインドメールをスタッフへ自動送信できます") }}<br>
            {{ __("「-」の場合はリマインドメールは送信されません") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.notification-deadline.update') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center">
            <p>提出期限の</p>
            <select id="notification_days" name="notification_days" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mx-1" autofocus autocomplete="notification_days">
                <option value="">-</option>
                <option value="1" @if ($company->notification_days == '1') selected @endif>1</option>
                <option value="2" @if ($company->notification_days == '2') selected @endif>2</option>
                <option value="3" @if ($company->notification_days == '3') selected @endif>3</option>
                <option value="4" @if ($company->notification_days == '4') selected @endif>4</option>
                <option value="5" @if ($company->notification_days == '5') selected @endif>5</option>
            </select>
            <p>日前に通知</p>
        </div>

        <div class="flex items-center gap-4">
            <x-admin-primary-button>{{ __('Save') }}</x-admin-primary-button>

            @if (session('status') === 'notification-deadline-updated')
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
