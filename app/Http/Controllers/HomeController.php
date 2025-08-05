<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\Tenant;
use App\Models\Track;
use App\Models\Artist;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'total_tracks' => Track::count(),
            'total_artists' => Artist::count(),
            'total_revenue' => Track::sum('revenue'),
        ];

        $subscription_plans = SubscriptionPlan::active()->orderBy('price_monthly')->get();

        return Inertia::render('welcome', [
            'stats' => $stats,
            'subscription_plans' => $subscription_plans,
        ]);
    }
}