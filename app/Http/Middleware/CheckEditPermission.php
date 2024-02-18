<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckEditPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $id = $request->route('staff');
        // $user =User::find($id);
        // if($user == null)
        // {
        //     return redirect()->back()->withErrors(['message' => 'You do not have permission to edit this resource.']);
        // }
        return $next($request);
    }
}
