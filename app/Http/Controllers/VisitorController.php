<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\View\View;

class VisitorController extends Controller
{
    /**
     * Display paginated list of visitors
     */
    public function index(): View
    {
        $visitors = Visitor::latest('visited_at')
            ->paginate(5);

        // Calculate basic stats
        $totalVisitors = Visitor::count();
        $uniqueVisitors = Visitor::distinct('ip_address')->count();
        $pageViews = Visitor::count();

        return view('admin.visitors', compact('visitors', 'totalVisitors', 'uniqueVisitors', 'pageViews'));
    }
}
