<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class RecordVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Record visitor after response
        $response = $next($request);

        // Only record unauthenticated users (public visitors)
        // Exclude admin routes and authenticated users
        if (!auth()->check() && $response->getStatusCode() === 200) {
            try {
                Visitor::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referer' => $request->header('referer'),
                    'page_path' => $request->path(),
                    'visited_at' => now(),
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to record visitor: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
