<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Clinic;
use App\Models\ClinicAlert;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClinicAlertRequest;

class ClinicAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ClinicAlert::with('clinic')->orderBy('created_at','DESC')->get();

        return view('pages.clinic-alerts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clincHasalerts = ClinicAlert::pluck('clinic_id');
        $clinics = Clinic::whereNotIn('id',$clincHasalerts)->where('id','!=',1)->get();
        return view('pages.clinic-alerts.create',compact('clinics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicAlertRequest $request)
    {
        try {
            DB::beginTransaction();
            $clinicAlert = new ClinicAlert();
            $clinicAlert->clinic_id = $request->clinic_id;
            $clinicAlert->message =  $request->message;
            $clinicAlert->save();

            DB::commit();
            Flasher::addSuccess('Clinic Alert added successfully');
            return redirect()->route('clinic-alerts.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic Alert could not be added');
            return redirect()->route('clinic-alerts.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClinicAlert $clinicAlert)
    {
        return view('pages.clinic-alerts.view',compact('clinicAlert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClinicAlert $clinicAlert)
    {
        return view('pages.clinic-alerts.edit',compact('clinicAlert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClinicAlertRequest $request, ClinicAlert $clinicAlert)
    {
        try {
            DB::beginTransaction();
            $clinicAlert->message =  $request->message;
            $clinicAlert->save();

            DB::commit();
            Flasher::addSuccess('Clinic Alert updated successfully');
            return redirect()->route('clinic-alerts.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic Alert could not be updated');
            return redirect()->route('clinic-alerts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClinicAlert $clinicAlert)
    {
        try {
            $clinicAlert->delete();

            Flasher::addSuccess('Clinic Alert deleted successfully');
            return redirect()->route('clinic-alerts.index');
         } catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic Alert could not be deleted');
            return redirect()->route('clinic-alerts.index');
         }

    }
}
