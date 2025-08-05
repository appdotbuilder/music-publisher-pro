<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Artist
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $stage_name
 * @property string|null $bio
 * @property string|null $country
 * @property string|null $genre
 * @property string|null $avatar_url
 * @property array|null $social_links
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Track> $tracks
 * @property-read int|null $tracks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RoyaltySplit> $royaltySplits
 * @property-read int|null $royalty_splits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contract> $contracts
 * @property-read int|null $contracts_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Artist active()
 * @method static \Database\Factories\ArtistFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Artist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'user_id',
        'name',
        'stage_name',
        'bio',
        'country',
        'genre',
        'avatar_url',
        'social_links',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the tenant that owns this artist.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the user associated with this artist.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tracks this artist is associated with.
     */
    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class)->withPivot('role', 'royalty_percentage')->withTimestamps();
    }

    /**
     * Get the royalty splits for this artist.
     */
    public function royaltySplits(): HasMany
    {
        return $this->hasMany(RoyaltySplit::class);
    }

    /**
     * Get the contracts for this artist.
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * Scope a query to only include active artists.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}