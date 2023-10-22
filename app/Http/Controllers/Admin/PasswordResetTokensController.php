<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetTokens;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PasswordResetTokensController extends Controller
{
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $user = User::find($id);
            $tokens = PasswordResetTokens::where('email','=',$user->email)->get();
            if($tokens){
                foreach($tokens as $token){
                    DB::delete('DELETE FROM password_reset_tokens WHERE email = ?', [$user->email]);
                }
            } else {
                Flasher::addInfo('message', "No token found");
                return redirect()->back();
            }
            DB::commit();
            Flasher::addSuccess('message', "Token has been deleted successfully");
            return redirect()->back();
        }catch(\Exception $e){
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('message', "Something went wrong.");
            return redirect()->back();
        }
    }
}
