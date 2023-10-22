<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function clinic() {
        return $this->belongsTo(Clinic::class , 'clinic_id' , 'id');
    }

    public function approvedBy() {
        return $this->belongsTo(User::class , 'approved_by' , 'id');
    }

    public function cancelledBy() {
        return $this->belongsTo(User::class , 'cancelled_by' , 'id');
    }
}
