<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'referer',
        'page_path',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Scope: Get unique visitors in last N days
     */
    public function scopeLastDays(
        $query,
        int $days = 30
    ) {
        return $query->where('visited_at', '>=', now()->subDays($days));
    }

    /**
     * Scope: Get unique visitor IPs
     */
    public function scopeUnique($query)
    {
        return $query->distinct('ip_address');
    }

    /**
     * Get total visitors last 30 days
     */
    public static function getTotalVisitors(int $days = 30): int
    {
        return self::lastDays($days)->count();
    }

    /**
     * Get unique visitors last 30 days
     */
    public static function getUniqueVisitors(int $days = 30): int
    {
        return self::lastDays($days)->distinct('ip_address')->count();
    }

    /**
     * Get page views last 30 days
     */
    public static function getPageViews(int $days = 30): int
    {
        return self::lastDays($days)->count();
    }

    /**
     * Get return visitors last 30 days
     */
    public static function getReturnVisitors(int $days = 30): int
    {
        $ipAddresses = self::lastDays($days)
            ->pluck('ip_address')
            ->toArray();

        $uniqueIps = array_unique($ipAddresses);
        $counts = array_count_values($ipAddresses);

        return count(array_filter($counts, fn($count) => $count > 1));
    }
}
