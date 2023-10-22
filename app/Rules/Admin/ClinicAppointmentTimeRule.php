<?php

namespace App\Rules\Admin;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class ClinicAppointmentTimeRule implements ValidationRule
{
    public $get_time;

    public function __construct($get_time)
    {
        $this->get_time = $get_time;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start_time = Carbon::createFromFormat('g:i A',$this->get_time)->toTimeString();
        $end_time = Carbon::createFromFormat('g:i A',$value)->toTimeString();

        if(Carbon::parse($start_time)->gt(Carbon::parse($end_time))){
            $fail('The appointment end time  must be greater than appointment start time');
        }
    }
}
