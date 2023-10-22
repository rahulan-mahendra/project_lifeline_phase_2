<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\ForgotPassword;
use Illuminate\Support\Carbon;
use App\Mail\ForgotPasswordMail;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token =  Str::random(64);


        try{
            DB::beginTransaction();
            $entry = DB::table('password_reset_tokens')->insert(
                        ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
                    );

            $details = [
                'token' => $token,
                'to' => $request->email,
            ];

            if($entry){
                ForgotPassword::dispatch($details);
            }

            DB::commit();
            Flasher::addSuccess('We have e-mailed your password reset link!');
            return redirect()->route('login');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Something went wrong, Please inform your administrator!!!');
            return back();
        }
    }
}
