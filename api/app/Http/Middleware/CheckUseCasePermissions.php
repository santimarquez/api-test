<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckUseCasePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $permission_found = DB::table("role_permission")
                                ->join("permission_list", "role_permission.id_permission", "=", "permission_list.id")
                                ->select("role_permission.id")
                                ->where([
                                    "id_role" => Auth::user()->id_role, 
                                    "permission_list.permission_name" => $request->route()->getName()]
                                )->first();
        if(empty($permission_found)) {
            return response()->json(["msg" => "You don't have permission to perform this action."], 403);
        }

        return $next($request);
    }
}
