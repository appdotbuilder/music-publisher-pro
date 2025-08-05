import AppLayout from '@/components/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

interface Props extends SharedData {
    dashboard_type: string;
    tenant?: {
        id: number;
        name: string;
        slug: string;
        subdomain: string;
    };
    artist?: {
        id: number;
        name: string;
        stage_name: string;
    };
    stats: {
        [key: string]: number;
    };
    recent_tenants?: Array<{
        id: number;
        name: string;
        email: string;
        created_at: string;
    }>;
    recent_tracks?: Array<{
        id: number;
        title: string;
        status: string;
        artists: Array<{ name: string }>;
    }>;
    top_artists?: Array<{
        id: number;
        name: string;
        tracks_count: number;
    }>;
    tracks?: Array<{
        id: number;
        title: string;
        play_count: number;
        revenue: number;
        album?: { title: string };
    }>;
    message?: string;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { dashboard_type, tenant, artist, stats, recent_tenants, recent_tracks, top_artists, tracks, message } = usePage<Props>().props;

    const renderSuperAdminDashboard = () => (
        <div className="space-y-8">
            <div className="grid md:grid-cols-4 gap-6">
                <div className="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-blue-100">Total Tenants</p>
                            <p className="text-3xl font-bold">{stats.total_tenants}</p>
                        </div>
                        <div className="text-4xl opacity-80">🏢</div>
                    </div>
                </div>
                <div className="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl p-6 text-white">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-emerald-100">Active Tenants</p>
                            <p className="text-3xl font-bold">{stats.active_tenants}</p>
                        </div>
                        <div className="text-4xl opacity-80">✅</div>
                    </div>
                </div>
                <div className="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-purple-100">Total Revenue</p>
                            <p className="text-3xl font-bold">${stats.total_revenue?.toFixed(0) || 0}</p>
                        </div>
                        <div className="text-4xl opacity-80">💰</div>
                    </div>
                </div>
                <div className="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-orange-100">Total Tracks</p>
                            <p className="text-3xl font-bold">{stats.total_tracks}</p>
                        </div>
                        <div className="text-4xl opacity-80">🎵</div>
                    </div>
                </div>
            </div>

            <div className="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div className="p-6">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Tenants</h3>
                    <div className="space-y-3">
                        {recent_tenants?.map((tenant) => (
                            <div key={tenant.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                                <div>
                                    <p className="font-medium text-gray-900 dark:text-white">{tenant.name}</p>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">{tenant.email}</p>
                                </div>
                                <span className="text-sm text-gray-500 dark:text-gray-400">
                                    {new Date(tenant.created_at).toLocaleDateString()}
                                </span>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderTenantAdminDashboard = () => (
        <div className="space-y-8">
            <div className="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl p-8 text-white">
                <h2 className="text-2xl font-bold mb-2">Welcome to {tenant?.name}</h2>
                <p className="text-purple-100">Manage your music catalog and artists from your dashboard</p>
            </div>

            <div className="grid md:grid-cols-4 gap-6">
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Artists</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_artists}</p>
                        </div>
                        <div className="text-4xl">👥</div>
                    </div>
                </div>
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Tracks</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_tracks}</p>
                        </div>
                        <div className="text-4xl">🎵</div>
                    </div>
                </div>
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Revenue</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">${stats.total_revenue?.toFixed(0) || 0}</p>
                        </div>
                        <div className="text-4xl">💰</div>
                    </div>
                </div>
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Total Plays</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_plays}</p>
                        </div>
                        <div className="text-4xl">📊</div>
                    </div>
                </div>
            </div>

            <div className="grid md:grid-cols-2 gap-8">
                <div className="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="p-6">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Tracks</h3>
                        <div className="space-y-3">
                            {recent_tracks?.map((track) => (
                                <div key={track.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                                    <div>
                                        <p className="font-medium text-gray-900 dark:text-white">{track.title}</p>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            by {track.artists.map(a => a.name).join(', ')}
                                        </p>
                                    </div>
                                    <span className={`px-2 py-1 text-xs rounded-full ${
                                        track.status === 'distributed' ? 'bg-green-100 text-green-800' :
                                        track.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                        'bg-gray-100 text-gray-800'
                                    }`}>
                                        {track.status}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                <div className="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="p-6">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">Top Artists</h3>
                        <div className="space-y-3">
                            {top_artists?.map((artist) => (
                                <div key={artist.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                                    <div>
                                        <p className="font-medium text-gray-900 dark:text-white">{artist.name}</p>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            {artist.tracks_count} tracks
                                        </p>
                                    </div>
                                    <div className="text-2xl">🎤</div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );

    const renderArtistDashboard = () => (
        <div className="space-y-8">
            <div className="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl p-8 text-white">
                <h2 className="text-2xl font-bold mb-2">Welcome, {artist?.stage_name || artist?.name}</h2>
                <p className="text-indigo-100">View your tracks, earnings, and performance</p>
            </div>

            <div className="grid md:grid-cols-3 gap-6">
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">My Tracks</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_tracks}</p>
                        </div>
                        <div className="text-4xl">🎵</div>
                    </div>
                </div>
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Total Plays</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_plays}</p>
                        </div>
                        <div className="text-4xl">📊</div>
                    </div>
                </div>
                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div className="flex items-center justify-between">
                        <div>
                            <p className="text-gray-600 dark:text-gray-400">Earnings</p>
                            <p className="text-3xl font-bold text-gray-900 dark:text-white">${stats.total_revenue?.toFixed(2) || '0.00'}</p>
                        </div>
                        <div className="text-4xl">💰</div>
                    </div>
                </div>
            </div>

            <div className="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div className="p-6">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">My Tracks</h3>
                    <div className="space-y-3">
                        {tracks?.map((track) => (
                            <div key={track.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                                <div>
                                    <p className="font-medium text-gray-900 dark:text-white">{track.title}</p>
                                    {track.album && (
                                        <p className="text-sm text-gray-600 dark:text-gray-400">from {track.album.title}</p>
                                    )}
                                </div>
                                <div className="text-right">
                                    <p className="text-sm font-medium text-gray-900 dark:text-white">{track.play_count} plays</p>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">${track.revenue.toFixed(2)}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderArtistNoProfile = () => (
        <div className="space-y-8">
            <div className="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center dark:bg-yellow-900/20 dark:border-yellow-800">
                <div className="text-6xl mb-4">🎤</div>
                <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-2">Artist Profile Not Set Up</h2>
                <p className="text-gray-600 dark:text-gray-300">{message}</p>
            </div>
        </div>
    );

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-x-auto">
                {dashboard_type === 'super_admin' && renderSuperAdminDashboard()}
                {dashboard_type === 'tenant_admin' && renderTenantAdminDashboard()}
                {dashboard_type === 'artist' && renderArtistDashboard()}
                {dashboard_type === 'artist_no_profile' && renderArtistNoProfile()}
            </div>
        </AppLayout>
    );
}