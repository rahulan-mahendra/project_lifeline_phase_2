<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table= 'permissions';

    public function roles() {
        return $this->belongsToMany(Role::class,'role_has_permissions');
    }

    public function users() {
        return $this->belongsToMany(User::class,'model_has_permissions');
    }
}
