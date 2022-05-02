<?php

namespace App\Ship\Parents\Controllers;

use Illuminate\Support\Collection;

class DashboardController
{
    protected function menuBuilder(): Collection
    {
        $menuList = callAction('Dashboard@Content::GetMenuListActionInterface');
        
        return collect(['menu' => $menuList]);
    }
}