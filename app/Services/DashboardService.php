<?php

namespace App\Services;

use App\Models\Proyek;
use App\Models\Sertifikat;
use App\Models\Pendidikan;
use App\Models\Visitor;

class DashboardService
{

    public function getStatistics(): array
    {
        return [
            'projects_count' => $this->getProjectsCount(),
            'sertifikats_count' => $this->getSertifikatsCount(),
            'pendidikans_count' => $this->getPendidikansCount(),
        ];
    }

    public function getProjectsCount(): int
    {
        return Proyek::count();
    }

    public function getSertifikatsCount(): int
    {
        return Sertifikat::count();
    }

    public function getPendidikansCount(): int
    {
        return Pendidikan::count();
    }

    public function getEngagementStats(int $days = 30): array
    {
        return [
            'total_visitors' => Visitor::getTotalVisitors($days),
            'unique_visitors' => Visitor::getUniqueVisitors($days),
            'page_views' => Visitor::getPageViews($days),
            'return_visitors' => Visitor::getReturnVisitors($days),
        ];
    }

    public function getAllDashboardData(): array
    {
        return [
            'statistics' => $this->getStatistics(),
            'engagement' => $this->getEngagementStats(),
        ];
    }

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
