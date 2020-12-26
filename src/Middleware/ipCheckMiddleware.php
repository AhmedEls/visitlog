<?php

namespace AhmedEls\VisitLog\Middleware;

use Closure;
use Illuminate\Http\Request;
use AhmedEls\VisitLog\Models\VisitLog as VisitModel;
use AhmedEls\VisitLog\VisitLog;

class ipCheckMiddleware extends VisitLog
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = app('VisitLog')->getUserIP();

        if (VisitModel::where('ip', $ip)->where('is_banned', 1)->first()) {
            abort(404);
        }

        return $next($request);
    }
}
