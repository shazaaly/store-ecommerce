<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function editProfile(){
        $id =  auth('admin')->user();
        $id =  auth('admin')->user() -> id;
        $admin = Admin::find($id);
        return view('dashboard.profile.edit', compact('admin'));

    }


    public function updateProfile(Request $request){
        try {
            if ($request->filled('password')){
                $request->merge(['password'=> bcrypt('password')]);
            }
            unset($request['id']);
            unset($request['password_confirmation']);


            $admin = Admin::find(auth('admin')->user() -> id);
            $admin->update($request->all());

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex)   {
//            return $ex;
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);


        }

    }


}
