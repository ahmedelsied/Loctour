<?php

namespace App\Support\Dashboard;

use Illuminate\Support\Facades\App;

class ChangeLocalizationAction
{
    public function __invoke($locale)
    {
        session()->put('dashboard-locale', $locale);
        App::setLocale($locale);
        return redirect()->back();
    }
}
