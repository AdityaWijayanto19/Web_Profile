<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gelar',
        'instansi',
        'periode',
        'keterangan',
        'urutan',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendidikans';

    /**
     * Scope to get ordered pendidikan
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
