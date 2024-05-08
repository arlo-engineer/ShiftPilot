<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Str;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $currentUrl = url()->current();
        if (Str::contains($currentUrl, '/admin/')) {
            $bgColor = "bg-admin-sub-color-lighter";
        } else {
            $bgColor = "bg-user-sub-color-lighter";
        }

        return view('layouts.guest', compact('bgColor'));
    }
}
