<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'text_singkat',
        'deskripsi',
        'path_foto',
        'link_cv',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hero_sections';

    /**
     * Get full name attribute
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->nama_depan} {$this->nama_belakang}";
    }

    /**
     * Scope to get single hero (there should be only one)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHero($query)
    {
        return $query->first();
    }
}
