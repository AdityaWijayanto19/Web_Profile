<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterMediaSozial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_media_sozials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'footer_id',
        'technology_id',
        'url',
        'urutan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'urutan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ========== RELATIONSHIPS ==========

    /**
     * Get footer yang memiliki media sosial ini
     *
     * @return BelongsTo
     */
    public function footer(): BelongsTo
    {
        return $this->belongsTo(Footer::class, 'footer_id');
    }

    /**
     * Get technology (icon) untuk media sosial
     *
     * @return BelongsTo
     */
    public function technology(): BelongsTo
    {
        return $this->belongsTo(Teknologi::class, 'technology_id');
    }
}
