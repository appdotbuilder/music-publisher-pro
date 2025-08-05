<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request, DashboardService $dashboardService)
    {
        $user = $request->user();
        
        if ($user->isSuperAdmin()) {
            $data = $dashboardService->getSuperAdminData();
        } elseif ($user->isTenantAdmin()) {
            $data = $dashboardService->getTenantAdminData($user);
        } else {
            $data = $dashboardService->getArtistData($user);
        }

        return Inertia::render('dashboard', $data);
    }
}