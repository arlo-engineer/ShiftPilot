<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('会社情報') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("会社名を変更できます。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.company-name.update') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="company_name" :value="__('会社名')" />
            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $company->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
