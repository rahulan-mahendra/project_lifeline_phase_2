<?php

namespace App\Rules\Patient;

use Closure;
use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\OpenHour;
use Illuminate\Contracts\Validation\ValidationRule;

class ClinicAppointmentTimeRule implements ValidationRule
{
    public $clinic_id;
    public $day_index;

    public function __construct($clinic_id,$day_index)
    {
        $this->clinic_id = $clinic_id;
        $this->day_index = $day_index;
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
        $openHour = OpenHour::where('id','=',$this->clinic_id)->where('day_index','=',$day_index)->first();
        //Start Time
        $start_time = $openHour->open_time;
        $end_time = $openHour->close_time;

        if (!( Carbon::parse($appointment_time)->gte(Carbon::parse($start_time)) && Carbon::parse($appointment_time)->lte(Carbon::parse($end_time)))){
            $fail('The appointment time  must be between '. \Carbon\Carbon::parse($start_time)->isoFormat('h:mm A') .'-'. \Carbon\Carbon::parse($end_time)->isoFormat('h:mm A'));
        }

    }
}
