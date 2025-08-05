import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

interface Props extends SharedData {
    stats: {
        total_tenants: number;
        total_tracks: number;
        total_artists: number;
        total_revenue: number;
    };
    subscription_plans: Array<{
        id: number;
        name: string;
        slug: string;
        description: string;
        price_monthly: number;
        price_yearly: number;
        features: string[];
        max_artists: number;
        max_tracks: number;
    }>;
    [key: string]: unknown;
}

export default function Welcome() {
    const { auth, stats, subscription_plans } = usePage<Props>().props;

    return (
        <>
            <Head title="🎵 MusicHub - Multi-Tenant Music Aggregation & Publishing Platform">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-purple-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-purple-900">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-md border-b border-gray-200/50 sticky top-0 z-50 dark:bg-gray-900/80 dark:border-gray-700/50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center space-x-3">
                                <div className="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center">
                                    <span className="text-2xl">🎵</span>
                                </div>
                                <div>
                                    <h1 className="text-xl font-bold text-gray-900 dark:text-white">MusicHub</h1>
                                    <p className="text-xs text-gray-600 dark:text-gray-400">Music Aggregation Platform</p>
                                </div>
                            </div>
                            <nav className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-full hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-lg hover:bg-purple-50 transition-colors dark:text-gray-300 dark:hover:text-purple-400 dark:hover:bg-purple-900/20"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-full hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl"
                                        >
                                            Start Free Trial
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="py-20 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <span className="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                🚀 Multi-Tenant SaaS Platform
                            </span>
                        </div>
                        <h1 className="text-5xl md:text-7xl font-bold text-gray-900 dark:text-white mb-6">
                            <span className="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                                Music Aggregation
                            </span>
                            <br />
                            Made Simple
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                            🎼 Distribute your music to all major streaming platforms • 💰 Automatic royalty splits • 📊 Real-time analytics • 📝 Digital contract management
                        </p>
                        
                        {/* Live Stats */}
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                            <div className="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg dark:bg-gray-800/60 dark:border-gray-700/20">
                                <div className="text-3xl font-bold text-purple-600 dark:text-purple-400">{stats.total_tenants}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400">Active Labels</div>
                            </div>
                            <div className="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg dark:bg-gray-800/60 dark:border-gray-700/20">
                                <div className="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{stats.total_artists}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400">Artists</div>
                            </div>
                            <div className="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg dark:bg-gray-800/60 dark:border-gray-700/20">
                                <div className="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{stats.total_tracks}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400">Tracks</div>
                            </div>
                            <div className="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg dark:bg-gray-800/60 dark:border-gray-700/20">
                                <div className="text-3xl font-bold text-orange-600 dark:text-orange-400">${stats.total_revenue.toFixed(0)}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400">Revenue</div>
                            </div>
                        </div>

                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-4 rounded-full hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                                    >
                                        🎯 Start Free Trial
                                    </Link>
                                    <button className="bg-white/80 backdrop-blur-sm text-gray-900 px-8 py-4 rounded-full hover:bg-white transition-all duration-200 font-semibold text-lg border border-gray-200 shadow-lg hover:shadow-xl dark:bg-gray-800/80 dark:text-white dark:border-gray-600 dark:hover:bg-gray-800">
                                        📹 Watch Demo
                                    </button>
                                </>
                            )}
                        </div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 backdrop-blur-sm dark:bg-gray-800/50">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-16">
                            <h2 className="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                                🌟 Everything Your Label Needs
                            </h2>
                            <p className="text-xl text-gray-600 dark:text-gray-300">
                                Powerful tools to manage your music business from one dashboard
                            </p>
                        </div>

                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <div className="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 p-8 rounded-2xl border border-purple-100 dark:border-purple-800/30">
                                <div className="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">🎵</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Music Distribution</h3>
                                <p className="text-gray-600 dark:text-gray-300">Distribute to Spotify, Apple Music, and 100+ platforms with automated metadata management.</p>
                            </div>

                            <div className="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 p-8 rounded-2xl border border-emerald-100 dark:border-emerald-800/30">
                                <div className="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">💰</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Automatic Royalty Splits</h3>
                                <p className="text-gray-600 dark:text-gray-300">Set up transparent royalty splits between artists, writers, and collaborators automatically.</p>
                            </div>

                            <div className="bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 p-8 rounded-2xl border border-orange-100 dark:border-orange-800/30">
                                <div className="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">📊</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Real-time Analytics</h3>
                                <p className="text-gray-600 dark:text-gray-300">Track streams, revenue, and performance across all platforms with detailed reporting.</p>
                            </div>

                            <div className="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-8 rounded-2xl border border-blue-100 dark:border-blue-800/30">
                                <div className="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">🏢</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Multi-Tenant Architecture</h3>
                                <p className="text-gray-600 dark:text-gray-300">Each label gets their own isolated workspace with custom branding and subdomain.</p>
                            </div>

                            <div className="bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 p-8 rounded-2xl border border-pink-100 dark:border-pink-800/30">
                                <div className="w-12 h-12 bg-pink-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">📝</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Digital Contracts</h3>
                                <p className="text-gray-600 dark:text-gray-300">Send and manage contracts with click-to-accept digital signatures for artists.</p>
                            </div>

                            <div className="bg-gradient-to-br from-violet-50 to-purple-50 dark:from-violet-900/20 dark:to-purple-900/20 p-8 rounded-2xl border border-violet-100 dark:border-violet-800/30">
                                <div className="w-12 h-12 bg-violet-600 rounded-xl flex items-center justify-center mb-4">
                                    <span className="text-2xl">👥</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Artist Management</h3>
                                <p className="text-gray-600 dark:text-gray-300">Invite artists, manage profiles, and give them access to their own data and earnings.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Pricing Section */}
                {subscription_plans && subscription_plans.length > 0 && (
                    <section className="py-20 px-4 sm:px-6 lg:px-8">
                        <div className="max-w-7xl mx-auto">
                            <div className="text-center mb-16">
                                <h2 className="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                                    💎 Choose Your Plan
                                </h2>
                                <p className="text-xl text-gray-600 dark:text-gray-300">
                                    Start with a free trial, upgrade as you grow
                                </p>
                            </div>

                            <div className="grid md:grid-cols-3 gap-8">
                                {subscription_plans.map((plan) => (
                                    <div key={plan.id} className={`bg-white/80 backdrop-blur-sm rounded-2xl p-8 border shadow-lg hover:shadow-xl transition-all duration-200 dark:bg-gray-800/80 ${plan.slug === 'pro' ? 'border-purple-300 ring-2 ring-purple-200 scale-105 dark:border-purple-600 dark:ring-purple-700' : 'border-gray-200 dark:border-gray-600'}`}>
                                        {plan.slug === 'pro' && (
                                            <div className="bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-full text-center mb-4">
                                                ⭐ Most Popular
                                            </div>
                                        )}
                                        <div className="text-center">
                                            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-2">{plan.name}</h3>
                                            <div className="text-4xl font-bold text-purple-600 dark:text-purple-400 mb-2">
                                                ${plan.price_monthly}
                                                <span className="text-lg text-gray-600 dark:text-gray-400">/month</span>
                                            </div>
                                            <p className="text-gray-600 dark:text-gray-300 mb-6">{plan.description}</p>
                                        </div>

                                        <div className="space-y-3 mb-8">
                                            <div className="flex items-center text-gray-700 dark:text-gray-300">
                                                <span className="text-green-500 mr-3">✅</span>
                                                <span>Up to {plan.max_artists} artists</span>
                                            </div>
                                            <div className="flex items-center text-gray-700 dark:text-gray-300">
                                                <span className="text-green-500 mr-3">✅</span>
                                                <span>Up to {plan.max_tracks} tracks</span>
                                            </div>
                                            {plan.features && plan.features.map((feature, index) => (
                                                <div key={index} className="flex items-center text-gray-700 dark:text-gray-300">
                                                    <span className="text-green-500 mr-3">✅</span>
                                                    <span>{feature}</span>
                                                </div>
                                            ))}
                                        </div>

                                        <Link
                                            href={route('register')}
                                            className={`block w-full text-center py-3 px-6 rounded-full font-semibold transition-all duration-200 ${
                                                plan.slug === 'pro'
                                                    ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white hover:from-purple-700 hover:to-indigo-700 shadow-lg hover:shadow-xl'
                                                    : 'bg-gray-100 text-gray-900 hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600'
                                            }`}
                                        >
                                            Start Free Trial
                                        </Link>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </section>
                )}

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="grid md:grid-cols-4 gap-8">
                            <div>
                                <div className="flex items-center space-x-3 mb-4">
                                    <div className="w-8 h-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                        <span className="text-xl">🎵</span>
                                    </div>
                                    <span className="text-xl font-bold">MusicHub</span>
                                </div>
                                <p className="text-gray-400">
                                    The all-in-one platform for music labels and producers to distribute, manage, and monetize their catalog.
                                </p>
                            </div>
                            <div>
                                <h4 className="font-semibold mb-4">Platform</h4>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Distribution</li>
                                    <li>Analytics</li>
                                    <li>Royalty Management</li>
                                    <li>Contract Management</li>
                                </ul>
                            </div>
                            <div>
                                <h4 className="font-semibold mb-4">Support</h4>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Help Center</li>
                                    <li>API Documentation</li>
                                    <li>Contact Us</li>
                                    <li>System Status</li>
                                </ul>
                            </div>
                            <div>
                                <h4 className="font-semibold mb-4">Connect</h4>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Twitter</li>
                                    <li>LinkedIn</li>
                                    <li>Instagram</li>
                                    <li>Blog</li>
                                </ul>
                            </div>
                        </div>
                        <div className="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                            <p>&copy; 2024 MusicHub. Built with ❤️ for the music industry.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}