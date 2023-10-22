<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Models\Clinic;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Events\AppointmentApproved;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Events\AppointmentCancelled;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\AppointmentRequest;
use App\Http\Requests\Admin\AppointmentCancellationRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name ? trim($request->name) : '';

        $code = $request->code ? trim($request->code) : '';

        $dob = $request->dob ? $request->dob : '';

        $appointment_date = $request->appointment_date ? $request->appointment_date : '';

        $from = '';

        $to =  '';

        $date = '';

        if($request->appointment_date != ''){

            $isRange = str_contains($request->appointment_date, "to");

            if($isRange){
                list($init_from, $init_to) = explode("to",$request->appointment_date);
                $from = trim($init_from);
                $to = trim($init_to);
            } else {
                $date = trim($request->appointment_date);
            }
        }

        $clinic = $request->clinic ? $request->clinic : '';

        $status = $request->status ? $request->status : '';

        $data = DB::table('appointments')->select('appointments.*', 'clinics.id as clinic_id','clinics.name as clinic_name')
        ->leftJoin('clinics','clinics.id','=','appointments.clinic_id');


        // Code Filter
        if (!empty($code) && !is_null($code) ) {
            $data = $data->where(function ($query) use($code) {
                $full_code = "APPT-".$code;
                $query->where('appointments.code', '=',  $full_code);
            });
        }

        if (!empty($name) && !is_null($name)  && $name != "") {
            $data = $data->where(function ($query) use ($name) {
                $query->Where('appointments.firstname', 'LIKE', '%' . $name . '%')
                ->orWhere('appointments.lastname', 'LIKE', '%' . $name . '%')
                ->orwhereRaw("CONCAT(appointments.firstname,' ',appointments.lastname) LIKE ? ", "%" . $name . "%");
            });
        }

        // DOB Filter
        if (!empty($dob) && !empty($dob)) {
            $data = $data->where(function ($query) use($dob) {
                $query->whereDate('appointments.dob', '=',  $dob);
            });
        }

        // Date Filter
        if (!empty($date) && !empty($date)) {
            $data = $data->where(function ($query) use($date) {
                $query->whereDate('appointments.appointment_date',  '=',  $date);
            });
        }

        // Date Range Filter
        if (!empty($from) && !empty($to) && !is_null($from) && !is_null($to)) {
            $data = $data->where(function ($query) use($from,$to) {
                $query->whereDate('appointments.appointment_date', '>=',  $from)
                    ->whereDate('appointments.appointment_date', '<=',  $to);
            });
        }

        // Status Filter
        if (!empty($status) && !empty($status)) {
            $data = $data->where(function ($query) use($status) {
                $query->where('appointments.status', '=',  $status);
            });
        }

        if(Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager()){
            // Clinic Filter
            if (!empty($clinic) && !is_null($clinic) ) {
                $data = $data->where(function ($query) use($clinic) {
                    $query->where('appointments.clinic_id',  '=',  $clinic);
                });
            } else {
                $data = $data->where('clinic_id','!=',Auth::user()->clinic_id);
            }
        } else {
            $data = $data->where('clinic_id','=',Auth::user()->clinic_id);
        }

        $data = $data->orderBy('appointments.id','ASC')->get();

        $clinics = Clinic::where('id','!=',Auth::user()->clinic_id)->get();

        return view('pages.appointments.index',compact('data','clinics','name','code','from','to','clinic','status'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment = Appointment::with('clinic','approvedBy','cancelledBy')->find($appointment->id);
        return view('pages.appointments.view', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if($appointment->status != 'Pending'){
            return redirect()->route('appointments.index');
        } else {
            $clinic = Clinic::find($appointment->clinic_id);
            return view('pages.appointments.edit', compact('appointment','clinic'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        try {

            $appointment_time = Carbon::createFromFormat('g:i A',$request->appointment_time)->toTimeString();

            DB::beginTransaction();
            $appointment->firstname = $request->firstname;
            $appointment->lastname = $request->lastname;
            $appointment->dob = $request->dob;
            $appointment->email = $request->email;
            $appointment->phone_no = $request->phone_no;
            $appointment->is_new_patient = $request->is_new_patient;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $appointment_time;
            $appointment->dob = $request->dob;
            $appointment->notes = $request->notes;
            if($request->approve == "YES"){
                $appointment->status = 'Approved';
                $appointment->approved_by = Auth::user()->id;
            }
            $appointment->save();

            if($appointment && $request->approve == "YES"){
                $mail_appointment = Appointment::with('clinic')->where('id','=',$appointment->id)->first();
                AppointmentApproved::dispatch($mail_appointment);
            }

            DB::commit();
            Flasher::addSuccess('Appointment updated successfully');
            return redirect()->route('appointments.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Appointment could not be updated');
            return redirect()->route('appointments.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function approveAppointment($id)
    {
        try {
            $appointment = Appointment::find($id);
            if($appointment){
                DB::beginTransaction();
                $appointment->status = 'Approved';
                $appointment->approved_by = Auth::user()->id;
                $appointment->save();

                if($appointment){
                    $mail_appointment = Appointment::with('clinic')->where('id','=',$appointment->id)->first();
                    AppointmentApproved::dispatch($mail_appointment);
                }
                DB::commit();
                Flasher::addSuccess('Appointment approved successfully');
                return redirect()->route('appointments.index');
            }else{
                Flasher::addError('Appointment not found');
                return redirect()->route('appointments.index');
            }
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Appointment could not be approved');
            return redirect()->route('appointments.index');
        }
    }

    public function cancelAppointment(AppointmentCancellationRequest $request, $id)
    {
        try {
            $appointment = Appointment::find($id);
            if($appointment){
                DB::beginTransaction();
                $appointment->status = 'Cancelled';
                $appointment->cancellation_requested_by_patient = $request->cancellation_requested_by_patient;
                $appointment->cancellation_notes = $request->cancellation_notes;
                $appointment->cancelled_by = Auth::user()->id;
                $appointment->save();
                if($appointment){
                    $mail_appointment = Appointment::with('clinic')->where('id','=',$appointment->id)->first();
                    AppointmentCancelled::dispatch($mail_appointment);
                }
                DB::commit();
                Flasher::addSuccess('Appointment cancelled successfully');
                return redirect()->route('appointments.index');
            }else{
                Flasher::addError('Appointment not found');
                return redirect()->route('appointments.index');
            }
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Appointment could not be cancelled');
            return redirect()->route('appointments.index');
        }
    }
}
