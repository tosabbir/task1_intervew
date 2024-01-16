<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/admin_dashboard');
    }


     /**
     * Destroy an authenticated session. or admin logout here
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // admin profile page show
    public function adminProfile(){

        // fin all data
        $id = Auth::user()->id;
        $adminData = User::find($id);
        // print_r($adminData);
        return view('admin.admin_profile', compact('adminData'));
        //Whern i run Your projeck here faching some issues
    }

}
