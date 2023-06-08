<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardServiceContract as DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index() {
        return view('dasboard.index', $this->dashboardService->getDataIndex());
    }
}
