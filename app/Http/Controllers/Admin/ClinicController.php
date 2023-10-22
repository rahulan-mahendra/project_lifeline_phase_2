<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Models\Clinic;
use App\Enums\WeekDays;
use App\Models\OpenHour;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClinicRequest;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Clinic::where('id','!=',1)->orderBy('created_at','DESC')->get();

        return view('pages.clinics.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days = WeekDays::array();
        return view('pages.clinics.create', compact('days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClinicRequest $request)
    {
        dd($request->all());
        try {
            // $start_time = Carbon::createFromFormat('g:i A',$request->appointment_start_time)->toTimeString();
            // $end_time = Carbon::createFromFormat('g:i A',$request->appointment_end_time)->toTimeString();

            DB::beginTransaction();
            $clinic = new Clinic();
            $clinic->name = $request->name;
            $clinic->email = $request->email;
            $clinic->contact_no = $request->contact_no;
            $clinic->address =  $request->address;
            $clinic->save();

            foreach($request->days as $item){
                $openHour = new OpenHour();
                $openHour->day = $item['day'];
                $openHour->day_index = $item['day_index'];
                $openHour->is_open = $item['is_open'];
                $openHour->open_time = $item['open_time'];
                $openHour->close_time = $item['close_time'];
                $openHour->clinic_id = $clinic->id;
                $openHour->save();
            }

            DB::commit();
            Flasher::addSuccess('Clinic added successfully');
            return redirect()->route('clinics.index');
        } catch(\Exception $e) {
            return $e->getMessage();
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic could not be added');
            return redirect()->route('clinics.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinic $clinic)
    {
        $clinic = Clinic::with('openHours')->where('id','=',$clinic->id)->first();
        return view('pages.clinics.view',compact('clinic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinic $clinic)
    {
        $clinic = Clinic::with('openHours')->where('id','=',$clinic->id)->first();
        return view('pages.clinics.edit',compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClinicRequest $request, Clinic $clinic)
    {
        try {
            DB::beginTransaction();
            $clinic->name = $request->name;
            $clinic->email = $request->email;
            $clinic->contact_no = $request->contact_no;
            $clinic->address =  $request->address;
            $clinic->save();

            DB::commit();
            Flasher::addSuccess('Clinic updated successfully');
            return redirect()->route('clinics.index');
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic could not be updated');
            return redirect()->route('clinics.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        //
    }

    public function hide(Clinic $clinic)
    {
        try {
            $clinic = Clinic::find($clinic->id);
            if($clinic){
                DB::beginTransaction();
                $clinic->is_hidden = true;
                $clinic->save();
                DB::commit();
                Flasher::addSuccess('Clinic hidded successfully');
                return redirect()->route('clinics.index');
            }else{
                Flasher::addError('Clinic not found');
                return redirect()->route('clinics.index');
            }
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic could not be hidden');
            return redirect()->route('clinics.index');
        }
    }

    public function unHide(Clinic $clinic)
    {
        try {
            $clinic = Clinic::find($clinic->id);
            if($clinic){
                DB::beginTransaction();
                $clinic->is_hidden = false;
                $clinic->save();
                DB::commit();
                Flasher::addSuccess('Clinic displayed successfully');
                return redirect()->route('clinics.index');
            }else{
                Flasher::addError('Clinic not found');
                return redirect()->route('clinics.index');
            }
        } catch(\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            DB::rollback();
            Flasher::addError('Clinic could not be displayed');
            return redirect()->route('clinics.index');
        }
    }
}
