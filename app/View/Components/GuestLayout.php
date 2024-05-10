<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Guest;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $currentUrl = url()->current();
        $guest = new Guest($currentUrl);

        return view('layouts.guest', compact('guest'));
    }
}
