<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\ChangeUserPasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('pages.users.profile',compact('user'));
    }

    public function update(ProfileRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->email_verified_at =  now();
            $user->save();

            // Mail::to($request->email)->send(new NewUserMail($request->firstname, $request->lastname, $request->email));

            DB::commit();
            Flasher::addSuccess('User profile updated successfully');
            return redirect()->route('profile.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('User profile could not be updated');
            return redirect()->route('profile.index');
        }
    }

    public function changePassword(ChangeUserPasswordRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $user = User::find($id);
            $user->password=bcrypt($request->password);
            $user->save();

            Auth::loginUsingId($user->id);

            DB::commit();
            Flasher::addSuccess('message', "Password has been changed successfully");
            return redirect()->route('profile.index');
        }catch(\Exception $e){
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('message', "Something went wrong.");
            return redirect()->route('profile.index');
        }
    }
}
