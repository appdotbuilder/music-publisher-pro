<?php

namespace App\Services;

use App\Models\Artist;
use App\Models\Tenant;
use App\Models\Track;
use App\Models\User;

class DashboardService
{
    /**
     * Get super admin dashboard data.
     */
    public function getSuperAdminData(): array
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::active()->count(),
            'total_revenue' => Track::sum('revenue'),
            'total_tracks' => Track::count(),
        ];

        $recent_tenants = Tenant::latest()->take(5)->get();

        return [
            'dashboard_type' => 'super_admin',
            'stats' => $stats,
            'recent_tenants' => $recent_tenants,
        ];
    }

    /**
     * Get tenant admin dashboard data.
     */
    public function getTenantAdminData(User $user): array
    {
        $tenant = $user->tenant;
        
        $stats = [
            'total_artists' => $tenant->artists()->count(),
            'total_tracks' => $tenant->tracks()->count(),
            'total_revenue' => $tenant->tracks()->sum('revenue'),
            'total_plays' => $tenant->tracks()->sum('play_count'),
        ];

        $recent_tracks = $tenant->tracks()->with('artists')->latest()->take(5)->get();
        $top_artists = $tenant->artists()->withCount('tracks')->orderBy('tracks_count', 'desc')->take(5)->get();

        return [
            'dashboard_type' => 'tenant_admin',
            'tenant' => $tenant,
            'stats' => $stats,
            'recent_tracks' => $recent_tracks,
            'top_artists' => $top_artists,
        ];
    }

    /**
     * Get artist dashboard data.
     */
    public function getArtistData(User $user): array
    {
        $artist = $user->artist;
        
        if (!$artist) {
            return [
                'dashboard_type' => 'artist_no_profile',
                'message' => 'Please contact your label to set up your artist profile.',
            ];
        }

        $tracks = $artist->tracks()->with('album')->get();
        $total_revenue = $tracks->sum('revenue');
        $total_plays = $tracks->sum('play_count');

        return [
            'dashboard_type' => 'artist',
            'artist' => $artist,
            'tracks' => $tracks,
            'stats' => [
                'total_tracks' => $tracks->count(),
                'total_revenue' => $total_revenue,
                'total_plays' => $total_plays,
            ],
        ];
    }
}