<?php

namespace App\Services;

use App\Models\Proyek;
use App\Models\Sertifikat;
use App\Models\Pendidikan;
use App\Models\Visitor;

class DashboardService
{
    /**
     * Get dashboard statistics
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'projects_count' => $this->getProjectsCount(),
            'sertifikats_count' => $this->getSertifikatsCount(),
            'pendidikans_count' => $this->getPendidikansCount(),
        ];
    }

    /**
     * Get total projects
     */
    public function getProjectsCount(): int
    {
        return Proyek::count();
    }

    /**
     * Get total sertifikats
     */
    public function getSertifikatsCount(): int
    {
        return Sertifikat::count();
    }

    /**
     * Get total pendidikans
     */
    public function getPendidikansCount(): int
    {
        return Pendidikan::count();
    }

    /**
     * Get engagement statistics for last 30 days
     *
     * @return array
     */
    public function getEngagementStats(int $days = 30): array
    {
        return [
            'total_visitors' => Visitor::getTotalVisitors($days),
            'unique_visitors' => Visitor::getUniqueVisitors($days),
            'page_views' => Visitor::getPageViews($days),
            'return_visitors' => Visitor::getReturnVisitors($days),
        ];
    }

    /**
     * Get all dashboard data at once
     *
     * @return array
     */
    public function getAllDashboardData(): array
    {
        return [
            'statistics' => $this->getStatistics(),
            'engagement' => $this->getEngagementStats(),
        ];
    }

    /**
     * Calculate growth percentage (placeholder)
     *
     * @return float
     */
    public function calculateVisitorGrowth(int $days = 30): float
    {
        $currentPeriod = Visitor::getTotalVisitors($days);
        $previousPeriod = Visitor::whereBetween('visited_at', [
            now()->subDays($days * 2),
            now()->subDays($days),
        ])->count();

        if ($previousPeriod === 0) {
            return 0;
        }

        return round((($currentPeriod - $previousPeriod) / $previousPeriod) * 100, 2);
    }
}
