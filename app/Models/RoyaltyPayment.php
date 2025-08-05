<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RoyaltyPayment
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $track_id
 * @property int $artist_id
 * @property float $amount
 * @property int $plays
 * @property \Illuminate\Support\Carbon $period_start
 * @property \Illuminate\Support\Carbon $period_end
 * @property string|null $platform
 * @property string $status
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Track $track
 * @property-read \App\Models\Artist $artist
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltyPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltyPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltyPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoyaltyPayment pending()

 * 
 * @mixin \Eloquent
 */
class RoyaltyPayment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'track_id',
        'artist_id',
        'amount',
        'plays',
        'period_start',
        'period_end',
        'platform',
        'status',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:4',
        'plays' => 'integer',
        'period_start' => 'date',
        'period_end' => 'date',
        'metadata' => 'array',
    ];

    /**
     * Get the tenant this payment belongs to.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the track this payment is for.
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * Get the artist this payment goes to.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}