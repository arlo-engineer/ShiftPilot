<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    private $url;

    function __construct($url) {
		return $this->url = $url;
	}

    /**
    * ゲストページにおける背景色の切り替え
    *
    * @param string $url ページのurl
    * @return string 背景色を表すクラス名
    */
    public function getBgColor()
    {
        if (Str::contains($this->url, '/admin/')) {
            $bgColor = "bg-admin-sub-color-lighter";
        } else {
            $bgColor = "bg-user-sub-color-lighter";
        }
        return $bgColor;
    }

    /**
    * ゲストページにおける文言(ログインはこちら、新しくアカウントを作るなど)の切り替え
    *
    * @param string $url ページのurl
    * @return string ゲストページに表示する文言。URLに/registerが含まれるときは「ログインはこちら」、URLに/loginが含まれる時は「新しくアカウントを作る」を返す。
    */
    public function switchGuestPagePhrase()
    {
        switch (true) {
            case Str::contains($this->url, '/admin/') && Str::contains($this->url, '/register'):
                $html[] = '<div class="text-admin-main-color my-6 text-sm hover:underline">';
                $html[] = '<a href="' . route('admin.login') . '">ログインはこちら</a>';
                $html[] = '</div>';
                break;
            case Str::contains($this->url, '/admin/') && Str::contains($this->url, '/login'):
                $html[] = '<div class="text-admin-main-color my-6 text-sm hover:underline">';
                $html[] = '<a href="' . route('admin.register') . '">新しくアカウントを作る</a>';
                $html[] = '</div>';
                break;
            case Str::contains($this->url, '/register'):
                $html[] = '<div class="text-user-main-color my-6 text-sm hover:underline">';
                $html[] = '<a href="' . route('login') . '">ログインはこちら</a>';
                $html[] = '</div>';
                break;
            case Str::contains($this->url, '/login'):
                $html[] = '<div class="text-user-main-color my-6 text-sm hover:underline">';
                $html[] = '<a href="' . route('register') . '">新しくアカウントを作る</a>';
                $html[] = '</div>';
                break;
            default:
                $html[] = '';
                break;
        }
        return implode("", $html);
    }
}
