<?php

namespace App\Http\Controllers\Patient;

use DB;
use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::with('alert','openHours')->where('is_hidden','!=',1)->get();
        return view('patients.pages.appointments.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        // dd($request->all());
        try {
            $appointment_time = Carbon::createFromFormat('g:i A',$request->appointment_time)->toTimeString();

            $last = Appointment::select('code')->orderBy('id', 'DESC')->first();

            if($last == null){
                $code = 'APPT-'.(string)(1001) ;
            }else{
                $code_num =  ((int) ltrim($last->code, "APPT-"))+ 1;
                $code = 'APPT-'. (string) $code_num;
            }


            DB::beginTransaction();
            $appointment = new Appointment();
            $appointment->code = $code;
            $appointment->firstname = $request->firstname;
            $appointment->lastname = $request->lastname;
            $appointment->dob = $request->dob;
            $appointment->email = $request->email;
            $appointment->phone_no = $request->phone_no;
            $appointment->is_new_patient = $request->is_new_patient;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $appointment_time;
            $appointment->dob = $request->dob;
            $appointment->status = 'Pending';
            $appointment->notes = $request->notes;
            $appointment->clinic_id = $request->clinic;
            $appointment->save();

            DB::commit();
            Flasher::addSuccess('Appoinment created successfully');
            return redirect()->back();
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Appoinment could not be created');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
