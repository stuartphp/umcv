<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get permissions
        $roles = DB::table('role_user')->where('user_id', auth()->id())
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->get();
    
        $permissions = [];
        foreach($roles as $role)
        {
            $perm = DB::table('permission_role')->where('role_id', $role->role_id)
                ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                ->get();
            foreach($perm as $p)
            {
                $permissions[]=$p->title;
            }
        }

        session()->put('grant',$permissions);
        return view('home');
    }
}
