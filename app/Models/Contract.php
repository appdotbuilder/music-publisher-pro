<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $artist_id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property \Illuminate\Support\Carbon|null $signed_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string|null $signature_ip
 * @property array|null $terms
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Tenant $tenant
 * @property-read \App\Models\Artist $artist
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract signed()

 * 
 * @mixin \Eloquent
 */
class Contract extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tenant_id',
        'artist_id',
        'title',
        'content',
        'type',
        'status',
        'sent_at',
        'signed_at',
        'expires_at',
        'signature_ip',
        'terms',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sent_at' => 'datetime',
        'signed_at' => 'datetime',
        'expires_at' => 'datetime',
        'terms' => 'array',
    ];

    /**
     * Get the tenant this contract belongs to.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the artist this contract is for.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Scope a query to only include signed contracts.
     */
    public function scopeSigned($query)
    {
        return $query->where('status', 'signed');
    }
}