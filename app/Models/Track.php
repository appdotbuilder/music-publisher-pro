<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Track
 *
 * @property int $id
 * @property int $tenant_id
 * @property int|null $album_id
 * @property string $title
 * @property string|null $isrc
 * @property int|null $duration_seconds
 * @property int|null $track_number
 * @property string|null $genre
 * @property string|null $audio_file_url
 * @property string|null $lyrics
 * @property array|null $metadata
 * @property string $status
 * @property int $play_count
 * @property float $revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Album|null $album
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Artist> $artists
 * @property-read int|null $artists_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RoyaltySplit> $royaltySplits
 * @property-read int|null $royalty_splits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RoyaltyPayment> $royaltyPayments
 * @property-read int|null $royalty_payments_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Track newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track query()
 * @method static \Illuminate\Database\Eloquent\Builder|Track distributed()
 * @method static \Database\Factories\TrackFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Track extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'album_id',
        'title',
        'isrc',
        'duration_seconds',
        'track_number',
        'genre',
        'audio_file_url',
        'lyrics',
        'metadata',
        'status',
        'play_count',
        'revenue',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration_seconds' => 'integer',
        'track_number' => 'integer',
        'metadata' => 'array',
        'play_count' => 'integer',
        'revenue' => 'decimal:4',
    ];

    /**
     * Get the tenant that owns this track.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the album this track belongs to.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Get the artists associated with this track.
     */
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->withPivot('role', 'royalty_percentage')->withTimestamps();
    }

    /**
     * Get the royalty splits for this track.
     */
    public function royaltySplits(): HasMany
    {
        return $this->hasMany(RoyaltySplit::class);
    }

    /**
     * Get the royalty payments for this track.
     */
    public function royaltyPayments(): HasMany
    {
        return $this->hasMany(RoyaltyPayment::class);
    }

    /**
     * Scope a query to only include distributed tracks.
     */
    public function scopeDistributed($query)
    {
        return $query->where('status', 'distributed');
    }
}