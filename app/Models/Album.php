<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $title
 * @property string|null $upc
 * @property string|null $description
 * @property string|null $cover_art_url
 * @property \Illuminate\Support\Carbon|null $release_date
 * @property string|null $genre
 * @property string|null $label
 * @property string $status
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tenant $tenant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Track> $tracks
 * @property-read int|null $tracks_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album distributed()
 * @method static \Database\Factories\AlbumFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'title',
        'upc',
        'description',
        'cover_art_url',
        'release_date',
        'genre',
        'label',
        'status',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'metadata' => 'array',
    ];

    /**
     * Get the tenant that owns this album.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the tracks for this album.
     */
    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }

    /**
     * Scope a query to only include distributed albums.
     */
    public function scopeDistributed($query)
    {
        return $query->where('status', 'distributed');
    }
}