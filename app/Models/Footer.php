<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Footer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_web',
        'deskripsi',
        'email',
        'no_hp',
        'logo_path',
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
     * Get media sosial untuk footer ini
     *
     * @return HasMany
     */
    public function mediaSozials(): HasMany
    {
        return $this->hasMany(FooterMediaSozial::class, 'footer_id')
            ->orderBy('urutan', 'asc');
    }

    // ========== SCOPES ==========

    /**
     * Get footer pertama (default)
     */
    public function scopeFirst($query)
    {
        return $query->orderBy('urutan', 'asc')->first();
    }
}
