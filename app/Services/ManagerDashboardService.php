<?php

namespace App\Services;

use DB;
use App\Models\Clinic;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;


class ManagerDashboardService
{
    public static function totalPendingAppointmentCount(){
        $pendingApponitments = Appointment::where('status','=','Pending')->count();
        return $pendingApponitments;
    }

    public static function totalApprovedAppointmentCount(){
        $approvedApponitments = Appointment::where('status','=','Approved')->count();
        return $approvedApponitments;
    }

    public static function totalCancelledAppointmentCount(){
        $cancelledApponitments = Appointment::where('status','=','Cancelled')->count();
        return $cancelledApponitments;
    }

    public static function totalNewPatientAppointmentsCount(){
        $newPatientApponitments = Appointment::where('is_new_patient','=',1)->count();
        return $newPatientApponitments;
    }

    public static function totalOldPatientAppointmentsCount(){
        $oldPatientApponitments = Appointment::where('is_new_patient','=',0)->count();
        return $oldPatientApponitments;
    }

    public static function clinicAppointmentStats(){
        $clinicAppointmentStats = [];
        $clinics = Clinic::where('id','!=',1)->get();
        $clinicData = array('clinic_name' => '' ,'total' => 0, 'pending' => 0 ,'approved' => 0, 'cancelled' => 0, 'new_patient' => 0, 'old_patient' => 0);

        foreach($clinics as $clinic){
            $current_clinic = $clinic->id;
            $clinic_name = $clinic->name;
            $total = Appointment::where('clinic_id','=',$current_clinic)->count();
            $pending = Appointment::where('status','=','Pending')->where('clinic_id','=',$current_clinic)->count();
            $approved = Appointment::where('status','=','Approved')->where('clinic_id','=',$current_clinic)->count();
            $cancelled = Appointment::where('status','=','Cancelled')->where('clinic_id','=',$current_clinic)->count();
            $new_patient = Appointment::where('is_new_patient','=',1)->where('clinic_id','=',$current_clinic)->count();
            $old_patient = Appointment::where('is_new_patient','=',0)->where('clinic_id','=',$current_clinic)->count();
            $clinicData = [
                'clinic_name' => $clinic_name,
                'total' => $total,
                'pending' => $pending,
                'approved' => $approved,
                'cancelled' => $cancelled,
                'new_patient' => $new_patient,
                'old_patient' => $old_patient,
            ];
            array_push($clinicAppointmentStats, $clinicData);
        }

        return $clinicAppointmentStats;
    }

}
