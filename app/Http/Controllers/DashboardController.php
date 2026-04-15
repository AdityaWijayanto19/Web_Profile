<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard Service instance
     */
    private DashboardService $dashboardService;

    /**
     * Inject DashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Show dashboard page
     *
     * @return View
     */
    public function index(): View
    {
        $data = $this->dashboardService->getAllDashboardData();

        return view('admin.dashboard', [
            'statistics' => $data['statistics'],
            'engagement' => $data['engagement'],
            'visitorGrowth' => $this->dashboardService->calculateVisitorGrowth(),
        ]);
    }
}
