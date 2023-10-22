<?php

namespace App\Services;

use DB;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;


class EmployeeDashboardService
{

    public static function totalPendingAppointmentCount(){
        $pendingApponitments = Appointment::where('status','=','Pending')->where('clinic_id','=',Auth::user()->clinic_id)->count();
        return $pendingApponitments;
    }

    public static function totalApprovedAppointmentCount(){
        $approvedApponitments = Appointment::where('status','=','Approved')->where('clinic_id','=',Auth::user()->clinic_id)->count();
        return $approvedApponitments;
    }

    public static function totalCancelledAppointmentCount(){
        $cancelledApponitments = Appointment::where('status','=','Cancelled')->where('clinic_id','=',Auth::user()->clinic_id)->count();
        return $cancelledApponitments;
    }

    public static function totalNewPatientAppointmentsCount(){
        $newPatientApponitments = Appointment::where('is_new_patient','=',1)->where('clinic_id','=',Auth::user()->clinic_id)->count();
        return $newPatientApponitments;
    }

    public static function totalOldPatientAppointmentsCount(){
        $oldPatientApponitments = Appointment::where('is_new_patient','=',0)->where('clinic_id','=',Auth::user()->clinic_id)->count();
        return $oldPatientApponitments;
    }

    public static function todayPendingAppointmentsCount(){
        $today = date('Y-m-d');

        $status = 'Pending';

        $data = DB::table('appointments')->select('appointments.*', 'clinics.id as clinic_id','clinics.name as clinic_name')
        ->leftJoin('clinics','clinics.id','=','appointments.clinic_id');

        // Date Filter
        if (!empty($date) && !empty($date)) {
            $data = $data->where(function ($query) use($date) {
                $query->whereDate('appointments.appointment_date',  '=',  $date);
            });
        }


        $data = $data->where(function ($query) use($status) {
            $query->where('appointments.status', '=',  $status);
        });

        $data = $data->where('clinic_id','=',Auth::user()->clinic_id)->orderBy('appointments.id','ASC')->get();

        $todayPendingApponitments = $data;
        return $todayPendingApponitments;
    }


}
