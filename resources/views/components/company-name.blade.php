@php
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Support\Facades\Auth;
    use App\Models\CompanyMembership;
    use App\Models\Company;

    $userId = Auth::id();
    $companyMemberships = CompanyMembership::where('user_id', $userId)->get();
    foreach ($companyMemberships as $companyMembership) {
        $companyNames[] = Company::where('id', $companyMembership->company_id)->first();
    }
@endphp

@if (!empty($companyNames))
<x-dropdown align="right" width="auto">
    <x-slot name="trigger">
        <button class="bg-my-main-color inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-white">
            <div class="font-bold text-white text-sm flex items-center">
                <div class="w-4"><img src="{{ asset('img/nav-building-icon.png') }}" alt="ビルのアイコン"></div>
                <div>{{ $companyNames[0]->name }}</div>
            </div>
        </button>
    </x-slot>

    <!-- 会社名/店舗名をクリックしたときにモーダルを表示し、切り替えができるよう実装予定 -->
    <x-slot name="content">
        {{-- @foreach ($companyNames as $companyName)
            <x-dropdown-link class="cursor-pointer">
                {{ $companyName->name }}
            </x-dropdown-link>
        @endforeach --}}
    </x-slot>
</x-dropdown>
@endif

