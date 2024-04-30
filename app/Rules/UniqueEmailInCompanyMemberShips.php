<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
use App\Models\CompanyMembership;

class UniqueEmailInCompanyMemberShips implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // inputされたemailからusers_tableのidを取得する
        $userId = User::where('email', $value)->pluck('id')->first();
        if (CompanyMembership::where('user_id', $userId)->exists()) {
            $fail('既に登録されています。');
        }
    }
}
