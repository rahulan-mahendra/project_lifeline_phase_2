<?php

namespace App\Rules\Patient;

use Closure;
use Carbon\Carbon;
use App\Models\Clinic;
use Illuminate\Contracts\Validation\ValidationRule;

class ClinicAppointmentTimeRule implements ValidationRule
{
    public $clinic_id;

    public function __construct($clinic_id)
    {
        $this->clinic_id = $clinic_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Process appointment time
        $appointment_time = Carbon::createFromFormat('g:i A',$value)->toTimeString();

        // Get Clinic Time
        $clinic = Clinic::where('id','=',$this->clinic_id)->first();
        //Start Time
        $start_time = $clinic->appointment_start_time;
        $end_time = $clinic->appointment_end_time;

        if (!( Carbon::parse($appointment_time)->gte(Carbon::parse($start_time)) && Carbon::parse($appointment_time)->lte(Carbon::parse($end_time)))){
            $fail('The appointment time  must be between '. \Carbon\Carbon::createFromTimeString($clinic->appointment_start_time,'Australia/Melbourne')->format('g:i A') .'-'. \Carbon\Carbon::createFromTimeString($clinic->appointment_end_time,'Australia/Melbourne')->format('g:i A'));
        }

    }
}
