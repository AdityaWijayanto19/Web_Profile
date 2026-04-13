<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyek extends Model
{
    /**
     * Database table name
     */
    protected $table = 'proyeks';

    /**
     * Get the route key for implicit model binding
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'path_gambar',
        'link_demo',
        'link_repo',
        'urutan',
        'status',
    ];

    /**
     * Type casting attributes
     */
    protected $casts = [
        'urutan' => 'integer',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [
        'urutan' => 0,
        'status' => 'draft',
    ];

    // ========== RELATIONSHIPS ==========

    /**
     * Many-to-many relationship dengan Teknologi
     *
     * @return BelongsToMany
     */
    public function teknologis(): BelongsToMany
    {
        return $this->belongsToMany(
            Teknologi::class,
            'proyek_teknologis',
            'id_proyek',
            'id_teknologi'
        );
    }

    // ========== QUERY SCOPES ==========

    /**
     * Scope untuk filter status published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk filter status draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk sorting by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }

    // ========== HELPER METHODS ==========

    /**
     * Get full URL for main image
     */
    public function getImageUrl(): string
    {
        return $this->path_gambar
            ? asset("storage/{$this->path_gambar}")
            : asset('storage/images/placeholder.jpg');
    }

    /**
     * Get full URL for thumbnail image
     * For this project, thumbnail is the same as main image
     */
    public function getThumbnailUrl(): string
    {
        return $this->getImageUrl();
    }

    /**
     * Check if image exists
     */
    public function hasImage(): bool
    {
        return !is_null($this->path_gambar);
    }

    /**
     * Get teknologi names as comma-separated string
     */
    public function getTechnologiesString(): string
    {
        return $this->teknologis()->pluck('nama')->implode(', ');
    }
}
