<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::with('permissions');

        $data = $data->where('name','!=','SuperAdmin')->orderBy('created_at','DESC')->get();

        return view('pages.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::whereNotIn('group_name',['Clinic','Role','User','Token'])->get()->groupBy('group_name');
        return view('pages.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = ModelsRole::create(['name' => $request->name]);

            $role->syncPermissions($request->permissions);

            DB::commit();
            Flasher::addSuccess('Role added successfully');
            return redirect()->route('roles.index');
        }  catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Role could not be added');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role_permissions = DB::table('role_has_permissions')->where('role_id',$role->id)->pluck('permission_id');
        $permissions = Permission::whereIn('id',$role_permissions)->get()->groupBy('group_name');
        return view('pages.roles.view', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::whereNotIn('group_name',['Clinic','Role','User','Token'])->get()->groupBy('group_name');
        return view('pages.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsRole $role)
    {
        try {
            DB::beginTransaction();
            // $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            DB::commit();
            Flasher::addSuccess('Role updated successfully');
            return redirect()->route('roles.index');
        }  catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Role could not be updated');
            return redirect()->route('roles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
