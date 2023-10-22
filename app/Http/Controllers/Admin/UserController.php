<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Clinic;
use App\Mail\NewUserMail;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\ChangeUserPasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $clinic = $request->clinic ? $request->clinic : '';

        $role = $request->role ? $request->role : '';

        $data = User::with(['roles','roles.permissions']);


        if(isset($role) && $role!=''){
            $data = $data->with([
                'roles' => function ($query) use ($role) {
                    $query->where('id', '=', $role);
                }
            ]);
        }

        $data = $data->where('id','!=',1)->orderBy('created_at','DESC')->get();

        return view('pages.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinics = Clinic::where('name','!=','Main')->get();
        $roles = Role::whereNotIn('name',['SuperAdmin','ClinicManager'])->get();
        return view('pages.users.create', compact('clinics','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->clinic_id = $request->clinic_id;
            $user->email_verified_at =  now();
            $user->password = bcrypt($request->password);
            $user->save();

            DB::table('model_has_roles')->insert([
                ['model_id'=>$user->id, 'model_type' => 'App\Models\User', 'role_id'=>$request->role]
            ]);

            DB::commit();
            Flasher::addSuccess('User added successfully');
            return redirect()->route('users.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('User could not be added');
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::with('roles')->find($user->id);
        return view('pages.users.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userRole = DB::table('model_has_roles')->where('model_id', $user->id)->first();
        $roles = Role::whereNotIn('name',['SuperAdmin','ClinicManager'])->get();
        return view('pages.users.edit', compact('user','userRole','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->save();

            if(!$user->isClinicManager()){
                DB::table('model_has_roles')->where('model_id', $user->id)->delete();

                DB::table('model_has_roles')->insert([
                    ['model_id'=>$user->id, 'model_type' => 'App\Models\User', 'role_id'=>$request->role]
                ]);
            }

            DB::commit();
            Flasher::addSuccess('User updated successfully');
            return redirect()->route('users.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('User could not be updated');
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function changeStatus(Request $request, User $user)
    {
        try {
            DB::beginTransaction();
            if($user->is_active == 1){
                $user->is_active = 0;
            }else {
                $user->is_active = 1;
            }
            $user->save();

            DB::commit();
            Flasher::addSuccess('User status changed successfully');
            return redirect()->route('users.show',$user->id);
        }  catch (\Exception $e) {
            DB::rollback();
            Flasher::addError('User status could not be changed');
            return redirect()->route('users.show',$user->id);
        }
    }

    public function changePasswordPage($id)
    {
        return view('pages.users.password',compact('id'));
    }

    public function changePassword(ChangeUserPasswordRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $user = User::find($id);
            $user->password=bcrypt($request->password);
            $user->save();

            $loggedInUser = Auth::user()->id;

            Auth::setUser($user)->logoutOtherDevices($request->password);

            Auth::loginUsingId($loggedInUser);

            DB::commit();
            Flasher::addSuccess('message', "Password has been changed successfully");
            return redirect()->route('users.index');
        }catch(\Exception $e){
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('message', "Something went wrong.");
            return redirect()->route('users.index');
        }
    }
}
