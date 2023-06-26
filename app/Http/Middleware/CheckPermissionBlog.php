<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionBlog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id') ? $request->route('id') : $request->all()['id'];
        $idPost = Post::find($id)->user_id;
        if ($idPost == Auth::id()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', __('message.permission'));
    }
}
