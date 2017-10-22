<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fixhub\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Project Acl middleware.
 */
class ProjectAcl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*
        if (!Auth::guard($guard)->check() || (Auth::guard($guard)->check() && !Auth::guard($guard)->user()->isAdmin)) {
            throw new HttpException(401);
        }
        */
        $project = $request->route('project_id');
        error_log(var_export($project, true), 3, '/tmp/gsl.log');
        return $next($request);
    }
}
