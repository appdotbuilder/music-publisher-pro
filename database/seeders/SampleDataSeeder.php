<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use App\Models\RoyaltySplit;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Tenant;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample tenant (record label)
        $tenant = Tenant::create([
            'name' => 'Sonic Wave Records',
            'slug' => 'sonic-wave-records',
            'subdomain' => 'sonicwave',
            'email' => 'admin@sonicwaverecords.com',
            'description' => 'Independent record label specializing in electronic and pop music',
            'status' => 'active',
        ]);

        // Create subscription for the tenant
        $proPlan = SubscriptionPlan::where('slug', 'pro')->first();
        Subscription::create([
            'tenant_id' => $tenant->id,
            'subscription_plan_id' => $proPlan->id,
            'status' => 'active',
            'trial_ends_at' => now()->addDays(30),
            'ends_at' => now()->addYear(),
        ]);

        // Create tenant admin
        $tenantAdmin = User::create([
            'name' => 'Alex Rodriguez',
            'email' => 'alex@sonicwaverecords.com',
            'password' => Hash::make('password'),
            'tenant_id' => $tenant->id,
            'role' => 'tenant_admin',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // Create 5 sample artists
        $artistsData = [
            [
                'name' => 'Maya Chen',
                'stage_name' => 'Neon Dreams',
                'bio' => 'Electronic music producer and DJ known for atmospheric soundscapes',
                'genre' => 'Electronic',
                'country' => 'US',
            ],
            [
                'name' => 'Carlos Santos',
                'stage_name' => 'Santos',
                'bio' => 'Latin pop singer-songwriter with a modern twist',
                'genre' => 'Latin Pop',
                'country' => 'MX',
            ],
            [
                'name' => 'Emma Thompson',
                'stage_name' => 'Echo Valley',
                'bio' => 'Indie folk artist with haunting vocals and intricate melodies',
                'genre' => 'Indie Folk',
                'country' => 'UK',
            ],
            [
                'name' => 'David Kim',
                'stage_name' => 'Synth King',
                'bio' => 'Synthwave and retrowave music producer',
                'genre' => 'Synthwave',
                'country' => 'KR',
            ],
            [
                'name' => 'Sophie Laurent',
                'stage_name' => 'Luna Rose',
                'bio' => 'Pop artist with ethereal vocals and dreamy productions',
                'genre' => 'Dream Pop',
                'country' => 'FR',
            ],
        ];

        $artists = [];
        foreach ($artistsData as $artistData) {
            // Create user account for artist
            $user = User::create([
                'name' => $artistData['name'],
                'email' => strtolower(str_replace(' ', '.', $artistData['name'])) . '@example.com',
                'password' => Hash::make('password'),
                'tenant_id' => $tenant->id,
                'role' => 'artist',
                'email_verified_at' => now(),
                'is_active' => true,
            ]);

            // Create artist profile
            $artist = Artist::create([
                'tenant_id' => $tenant->id,
                'user_id' => $user->id,
                'name' => $artistData['name'],
                'stage_name' => $artistData['stage_name'],
                'bio' => $artistData['bio'],
                'genre' => $artistData['genre'],
                'country' => $artistData['country'],
                'social_links' => [
                    'instagram' => '@' . strtolower(str_replace(' ', '', $artistData['stage_name'])),
                    'twitter' => '@' . strtolower(str_replace(' ', '', $artistData['stage_name'])),
                ],
                'is_active' => true,
            ]);

            $artists[] = $artist;
        }

        // Create albums and tracks for each artist
        foreach ($artists as $artist) {
            // Create an album
            $album = Album::create([
                'tenant_id' => $tenant->id,
                'title' => $artist->stage_name . ' - EP',
                'description' => 'Debut EP from ' . $artist->stage_name,
                'release_date' => now()->subDays(random_int(30, 365)),
                'genre' => $artist->genre,
                'label' => $tenant->name,
                'status' => 'distributed',
            ]);

            // Create 3 tracks for each artist
            for ($i = 1; $i <= 3; $i++) {
                $track = Track::create([
                    'tenant_id' => $tenant->id,
                    'album_id' => $album->id,
                    'title' => 'Track ' . $i . ' - ' . $artist->stage_name,
                    'duration_seconds' => random_int(180, 300),
                    'track_number' => $i,
                    'genre' => $artist->genre,
                    'status' => 'distributed',
                    'play_count' => random_int(1000, 50000),
                    'revenue' => random_int(100, 5000) / 100,
                ]);

                // Associate artist with track
                $track->artists()->attach($artist->id, [
                    'role' => 'primary_artist',
                    'royalty_percentage' => 80.00,
                ]);

                // Create royalty split
                RoyaltySplit::create([
                    'track_id' => $track->id,
                    'artist_id' => $artist->id,
                    'split_type' => 'mechanical',
                    'percentage' => 80.00,
                    'notes' => 'Primary artist royalty split',
                ]);

                // Label gets 20%
                RoyaltySplit::create([
                    'track_id' => $track->id,
                    'artist_id' => $artist->id,
                    'split_type' => 'master',
                    'percentage' => 20.00,
                    'notes' => 'Label royalty split',
                ]);
            }
        }
    }
}