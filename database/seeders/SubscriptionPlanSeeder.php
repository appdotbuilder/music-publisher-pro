<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free Trial',
                'slug' => 'free-trial',
                'description' => 'Perfect for getting started with music distribution',
                'price_monthly' => 0,
                'price_yearly' => 0,
                'max_artists' => 3,
                'max_tracks' => 10,
                'features' => [
                    'Basic distribution to major platforms',
                    'Simple royalty tracking',
                    'Email support',
                    '7-day free trial'
                ],
            ],
            [
                'name' => 'Standard',
                'slug' => 'standard',
                'description' => 'Great for small labels and independent artists',
                'price_monthly' => 29,
                'price_yearly' => 290,
                'max_artists' => 10,
                'max_tracks' => 100,
                'features' => [
                    'Full distribution network',
                    'Advanced royalty splits',
                    'Basic analytics',
                    'Contract management',
                    'Priority support'
                ],
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'Ideal for growing labels with multiple artists',
                'price_monthly' => 99,
                'price_yearly' => 990,
                'max_artists' => 50,
                'max_tracks' => 1000,
                'features' => [
                    'Everything in Standard',
                    'Advanced analytics & reporting',
                    'Custom branding',
                    'API access',
                    'Dedicated account manager',
                    'Custom contracts'
                ],
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'For large labels with complex needs',
                'price_monthly' => 299,
                'price_yearly' => 2990,
                'max_artists' => 0, // Unlimited
                'max_tracks' => 0, // Unlimited
                'features' => [
                    'Everything in Pro',
                    'Unlimited artists & tracks',
                    'White-label solution',
                    'Custom integrations',
                    'SLA guarantee',
                    'On-site training'
                ],
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}