<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $id = Auth::user()->id;
            $userData = User::find($id);
            return view('dashboard', compact('userData'));
        }

         /**
     * Destroy an authenticated session. or admin logout here
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request)
        {
            $slug = $request->slug;
            $id = $request->id;

            $request->validate([
                'name' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,' . $id . 'email'],
                'phone' => ['required', 'max:20', 'unique:users,phone,' . $id . 'phone'],
                'address' => ['required', 'max:100'],
            ]);


            // check image here
            if ($request->image) {

                $image = $request->file('image');
                $customeName = "U" . "." . rand() . time() . "." . $image->getClientOriginalExtension();
                $path = public_path('uploads/user/' . $customeName);
                Image::make($image)->resize(250, 250)->save($path);

                $update = User::where('status_id', 1)->where('slag', $slug)->update([
                    'photo' => $customeName,

                ]);
            }

            $update = User::where('status_id', 1)->where('slag', $slug)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);


            if ($update) {

                $notification = array(
                    'message' => "Profile Update Successfully",
                    'alert-type' => "success",
                );
                return back()->with($notification);
            } else {

                $notification = array(
                    'message' => "Opps Profile Is Not Updated",
                    'alert-type' => "success",
                );

                return back()->with($notification);
            }
        }


}
