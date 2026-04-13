<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teknologi extends Model
{
    /**
     * Database table name
     */
    protected $table = 'teknologis';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'nama',
        'path_icon',
    ];

    /**
     * Type casting attributes
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ========== RELATIONSHIPS ==========

    /**
     * Many-to-many relationship dengan Proyek
     *
     * @return BelongsToMany
     */
    public function proyeks(): BelongsToMany
    {
        return $this->belongsToMany(
            Proyek::class,
            'proyek_teknologis',
            'id_teknologi',
            'id_proyek'
        );
    }

    // ========== QUERY SCOPES ==========

    /**
     * Scope untuk sorting by name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('nama', 'asc');
    }

    // ========== HELPER METHODS ==========

    /**
     * Get full URL for icon
     */
    public function getIconUrl(): string
    {
        return $this->path_icon
            ? asset("storage/{$this->path_icon}")
            : asset('storage/images/tech-icon-placeholder.svg');
    }

    /**
     * Check if icon exists
     */
    public function hasIcon(): bool
    {
        return !is_null($this->path_icon);
    }
}
