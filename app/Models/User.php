<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function cans($permission) {
        return $this->permissions->contains('name', $permission);
    }

    public function roles() {
        return $this->belongsToMany(Role::class , 'model_has_roles' , 'model_id' , 'role_id');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class , 'model_has_permissions' , 'model_id' , 'permission_id');
    }

    public function isSuperAdmin() {
        return $this->roles->contains('name', 'SuperAdmin');
    }

    public function isClinicManager() {
        return $this->roles->contains('name', 'ClinicManager');
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class , 'clinic_id' , 'id');
    }
}
