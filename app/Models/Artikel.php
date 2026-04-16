<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artikel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'meta_description',
        'isi_konten',
        'path_gambar',
        'menit_baca',
        'status',
        'tanggal_rilis',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_rilis' => 'datetime',
    ];

    /**
     * Get the user that owns this article.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter status draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk filter status publish
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    /**
     * Scope untuk order by created_at descending
     */
    public function scopeOrdered($query)
    {
        return $query->orderByDesc('created_at');
    }
}
