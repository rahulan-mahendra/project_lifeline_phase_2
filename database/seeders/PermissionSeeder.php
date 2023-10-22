<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_has_permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('clinics')->delete();

        $input =  [
            // Clinic==================================================================================
            [ 'name' => 'can-view-clinic', 'guard_name' => 'web', 'group_name' => "Clinic"],
            [ 'name' => 'can-edit-clinic', 'guard_name' => 'web', 'group_name' => "Clinic"],
            [ 'name' => 'can-add-clinic', 'guard_name' => 'web', 'group_name' => "Clinic"],
            [ 'name' => 'can-hide-clinic', 'guard_name' => 'web', 'group_name' => "Clinic"],

            // Role==================================================================================
            [ 'name' => 'can-view-role', 'guard_name' => 'web', 'group_name' => "Role"],
            [ 'name' => 'can-edit-role', 'guard_name' => 'web', 'group_name' => "Role"],
            [ 'name' => 'can-add-role', 'guard_name' => 'web', 'group_name' => "Role"],
            [ 'name' => 'can-delete-role', 'guard_name' => 'web', 'group_name' => "Role"],

            // User==================================================================================
            [ 'name' => 'can-view-user', 'guard_name' => 'web', 'group_name' => "User"],
            [ 'name' => 'can-edit-user', 'guard_name' => 'web', 'group_name' => "User"],
            [ 'name' => 'can-add-user', 'guard_name' => 'web', 'group_name' => "User"],
            [ 'name' => 'can-delete-user', 'guard_name' => 'web', 'group_name' => "User"],

            // Appointment==================================================================================
            [ 'name' => 'can-view-appointment', 'guard_name' => 'web', 'group_name' => "Appointment"],
            [ 'name' => 'can-edit-appointment', 'guard_name' => 'web', 'group_name' => "Appointment"],
            [ 'name' => 'can-approve-appointment', 'guard_name' => 'web', 'group_name' => "Appointment"],
            [ 'name' => 'can-cancel-appointment', 'guard_name' => 'web', 'group_name' => "Appointment"],

            // Token==================================================================================
            [ 'name' => 'can-delete-token', 'guard_name' => 'web', 'group_name' => "Token"],

            // Clinic Alert==================================================================================
            [ 'name' => 'can-view-clinic-alert', 'guard_name' => 'web', 'group_name' => "ClinicAlert"],
            [ 'name' => 'can-edit-clinic-alert', 'guard_name' => 'web', 'group_name' => "ClinicAlert"],
            [ 'name' => 'can-add-clinic-alert', 'guard_name' => 'web', 'group_name' => "ClinicAlert"],
            [ 'name' => 'can-delete-clinic-alert', 'guard_name' => 'web', 'group_name' => "ClinicAlert"],

        ];

        DB::table('permissions')->insert($input);


        // Start SuperAdmin Role
        DB::table('roles')->insert([
            ['name'=>'SuperAdmin' , 'guard_name' => 'web']
        ]);

        $super_admin_permissions = DB::table('permissions')->get();

        $super_admin_role_id = DB::table('roles')->where('name' , 'SuperAdmin')->first()->id;

        foreach ($super_admin_permissions as $key => $permission) {
            DB::table('role_has_permissions')->insert([
                ['role_id'=>$super_admin_role_id, 'permission_id'=>$permission->id]
            ]);
        }
        // End SuperAdmin Role

        // Start Clinic Manager Role
        DB::table('roles')->insert([
            ['name'=>'ClinicManager' , 'guard_name' => 'web']
        ]);

        $clinic_manager_permissions = DB::table('permissions')->where('group_name','Appointment')->get();

        $clinic_manager_role_id = DB::table('roles')->where('name' , 'ClinicManager')->first()->id;

        foreach ($clinic_manager_permissions as $key => $permission) {
            DB::table('role_has_permissions')->insert([
                ['role_id'=>$clinic_manager_role_id, 'permission_id'=>$permission->id]
            ]);
        }
        // End Clinic Manager Role

        // Initial Clinic
        DB::table('clinics')->insert([
            'name' => "Main",
            'email' => "MainClinic@gmail.com",
            'contact_no' => "0767219211",
            'address' => 'main',
            'is_hidden' => '1'
        ]);

        // Start Super Admin User Creation
        $superAdminUser = DB::table('users')->insert([
            'firstname' => "Super",
            'lastname' => "Admin",
            'email' => "Sendhu.Anand@lifelinemedicals.com.au",
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'is_active' => 1,
            'clinic_id' => 1
        ]);

        DB::table('model_has_roles')->insert([
            ['model_id'=>1, 'model_type' => 'App\Models\User', 'role_id'=>$super_admin_role_id]
        ]);
        // End Super Admin User Creation

        // Start Clinic Manager User Creation
        $clinicManagerUser = DB::table('users')->insert([
            'firstname' => "Clinic",
            'lastname' => "Manager",
            'email' => "sjanany12@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'is_active' => 1,
            'clinic_id' => 1
        ]);

        DB::table('model_has_roles')->insert([
            ['model_id'=>2, 'model_type' => 'App\Models\User', 'role_id'=>$clinic_manager_role_id]
        ]);
        // End Clinic Manager User Creation
    }
}
