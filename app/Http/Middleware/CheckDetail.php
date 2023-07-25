<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDetail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('postDetail');
        if((Auth::check() && (Auth::user()->role == User::ROLE_ADMIN || Auth::user()->id == $post->user_id)) || $post->status === Post::STATUS_ACTIVE) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', __('admin.admin_error'));
    }
}
