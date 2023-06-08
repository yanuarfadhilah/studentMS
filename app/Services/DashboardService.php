<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Students;
use App\Models\User;

class DashboardService implements DashboardServiceContract
{
    public function getDataIndex(){
        return ([
            'userCount' => User::count(),
            'classCount' => Classes::count(),
            'studentCount' => Students::count() ,
        ]);
    }
}
