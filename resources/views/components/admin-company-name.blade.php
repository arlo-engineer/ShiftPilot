@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Company;

    $adminId = Auth::id();
    $companyName = Company::where('admin_id', $adminId)->first()->name;
@endphp


<div>{{ $companyName }}</div>
