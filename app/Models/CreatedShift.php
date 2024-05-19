<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatedShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_membership_id',
        'work_date',
        'start_time',
        'end_time',
    ];

    public function companyMembership()
    {
        return $this->belongsTo(CompanyMembership::class);
    }

    /**
     * 遷移前のページのクエリーパラメーターの値を取得する
     *
     * @param string $key クエリーパラメーターのキー
     * @return string|null キーに対応するクエリーパラメーターの値。キーが存在しない場合はnullを返す
     */
    public static function getPreviousPageQueryValue($key)
    {
        $previousUrl = url()->previous();
        $queryKey = '?' . $key . '=';
        if (strpos($previousUrl, $queryKey)) {
            $queryValue = substr($previousUrl, strpos($previousUrl, $queryKey) + mb_strlen($queryKey));
        } else {
            $queryValue = '';
        }

        return $queryValue;
    }
}
