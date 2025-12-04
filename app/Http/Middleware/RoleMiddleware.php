<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Employee;
use App\Models\Role;

class RoleMiddleware
{
    
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if(!$user){
            abort(403,'unauthorized');
        }
        $employee= Employee::where ("UserID",$user->UserID)->first();
         if(!$employee){
            abort(403,'User is not an employee');
        }
        $userRole = Role::where('RoleID',$employee->RoleID)->first();

        $allowed = array_filter(array_map('trim', explode(',',implode(',',$roles))));
        $allowed = array_map('strtolower', $allowed);

        if (!$userRole || !in_array(strtolower($userRole->Role),$allowed,true)) {
            abort(403, 'Unauthorized - Invalid role');
        }

        return $next($request);
    }
}
