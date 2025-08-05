<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RoyaltySplit
 *
 * @property int $id
 * @property int $track_id
 * @property int $artist_id
 * @property string $split_type
 * @property float $percentage
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Track $track
 * @property-read \App\Models\Artist $artist
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltySplit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltySplit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltySplit query()

 * 
 * @mixin \Eloquent
 */
class RoyaltySplit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'track_id',
        'artist_id',
        'split_type',
        'percentage',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'percentage' => 'decimal:2',
    ];

    /**
     * Get the track this split belongs to.
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * Get the artist this split belongs to.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}