<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('デフォルト時間') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('デフォルトとなる希望出退勤時間を設定できます') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('default-time.update') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="default_start_time" :value="__('出勤時間')" />
            <x-text-input id="default_start_time" name="default_start_time" type="time" class="mt-1 block w-full" :value="old('default_start_time', $default_time->default_start_time)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="default_end_time" :value="__('退勤時間')" />
            <x-text-input id="default_end_time" name="default_end_time" type="time" class="mt-1 block w-full" :value="old('default_end_time', $default_time->default_end_time)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'default-time-updated')
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
