<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function showResetPasswordForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email,'token' => $request->token])->first();

        if(!$updatePassword){
            Flasher::addError('Invalid token!');
            return back();
        }

        try
        {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

            DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

            DB::commit();
            Flasher::addSuccess('message', 'Your password has been changed!');
            return redirect()->route('login');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Something went wrong!!!');
            return back();
        }
    }
}
