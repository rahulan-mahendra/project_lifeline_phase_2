<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\AppointmentApproved;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentApprovedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewPatientAppointmentApprovedMail;

class NotifyAppointmentApproved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentApproved $event): void
    {
        try {
            $appointment = $event->appointment;

            $clinic_name = $appointment->clinic->name;
            $from = $appointment->clinic->email;
            $to = $appointment->email;
            $firstname = $appointment->firstname;
            $lastname = $appointment->lastname;
            $appointment_code = $appointment->code;
            $appointment_date = $appointment->appointment_date;
            $appointment_time = Carbon::createFromTimeString($appointment->appointment_time,'Australia/Melbourne')->format('g:i A');
            $is_new_patient = $appointment->is_new_patient == 1 ? true : false;

            $content = [
                'clinic_name' => $clinic_name,
                'from' => $from,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'appointment_code' => $appointment_code,
                'appointment_date' => $appointment_date,
                'appointment_time' => $appointment_time,
                'is_new_patient' => $is_new_patient,
            ];

            if($is_new_patient){
                Mail::to($to)->send(new NewPatientAppointmentApprovedMail($content));
            } else {
                Mail::to($to)->send(new AppointmentApprovedMail($content));
            }
        } catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            Flasher::addError('Could not send email. Please inform your administrator!!!');
        }

    }
}
