<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jabatan',
        'keterangan',
        'urutan',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengalamans';

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
     * Get full position label
     *
     * @return string
     */
    public function getFullPositionAttribute(): string
    {
        return $this->jabatan . ($this->perusahaan ? " @ {$this->perusahaan}" : '');
    }

    /**
     * Scope to order by urutan
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
