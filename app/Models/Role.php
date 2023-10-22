<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table= 'roles';

    public function permissions() {
        return $this->belongsToMany(Permission::class,'role_has_permissions');
    }

    public function users() {
        return $this->belongsToMany(User::class,'model_has_roles');
    }
}
