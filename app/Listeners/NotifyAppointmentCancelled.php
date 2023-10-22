<?php

namespace App\Listeners;

use Carbon\Carbon;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Events\AppointmentCancelled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\AppointmentCancelledByUsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\AppointmentCancelledByPatientMail;

class NotifyAppointmentCancelled
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
    public function handle(AppointmentCancelled $event): void
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
            $cancellation_requested_by_patient = $appointment->cancellation_requested_by_patient == 1 ? true : false;

            $content = [
                'clinic_name' => $clinic_name,
                'from' => $from,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'appointment_code' => $appointment_code,
                'appointment_date' => $appointment_date,
                'appointment_time' => $appointment_time,
                'cancellation_requested_by_patient' => $cancellation_requested_by_patient,
            ];

            if($cancellation_requested_by_patient){
                Mail::to($to)->send(new AppointmentCancelledByPatientMail($content));
            } else {
                Mail::to($to)->send(new AppointmentCancelledByUsMail($content));
            }
        } catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            Flasher::addError('Could not send email. Please inform your administrator!!!');
        }
    }
}
