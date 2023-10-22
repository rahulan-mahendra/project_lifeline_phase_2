@extends('layouts.main')

@push('css')
<!-- Datepicker css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
.form-control[readonly]{
            background-color: #fff;
            opacity: 1;
}
</style>
@endpush

@section('content')
@can('can-edit-appointment')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Appointment</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Clinics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Appointment</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body py-0 m-2">
                    <form action="{{route('appointments.update',["appointment" => $appointment->id])}}" id="edit_form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="approve" id="approve" value="NO">
                        <div class="form-group mb-3">
                            <label for="code">Code</label>
                            <input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" id="code" placeholder="code" value="{{old('code',$appointment->code)}}" disabled>
                            @error('code')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control  @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="First Name" value="{{old('name',$appointment->firstname)}}">
                            @error('firstname')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Last Name" value="{{old('name',$appointment->lastname)}}">
                            @error('lastname')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{old('email',$appointment->email)}}">
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone_no">Phone Number</label>
                            <input type="text" class="form-control  @error('phone_no') is-invalid @enderror" name="phone_no" id="phone_no" placeholder="+61XXXXXXXXX" value="{{old('phone_no',$appointment->phone_no)}}">
                            @error('phone_no')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Date Of Birth</label>
                            <input type="text" class="form-control  @error('dob') is-invalid @enderror" name="dob" id="dob" placeholder="Date Of Birth" value="{{old('name',$appointment->name)}}">
                            @error('dob')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="text" class="form-control  @error('appointment_date') is-invalid @enderror" name="appointment_date" id="appointment_date" placeholder="Name" value="{{old('appointment_date',$appointment->appointment_date)}}">
                            @error('appointment_date')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="appointment_time">Appointment Time</label>
                            <input type="text" class="form-control  @error('appointment_time') is-invalid @enderror" name="appointment_time" id="appointment_time" placeholder="Name" value="{{old('appointment_time',$appointment->appointment_time)}}">
                            @error('appointment_time')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="is_new_patient">New Patient? </label>
                            <select class="form-control  @error('is_new_patient') is-invalid @enderror" name="is_new_patient" id="is_new_patient">
                                <option value="1" {{ old('is_new_patient') == '' ? ($appointment->is_new_patient == '1' ? 'selected' : '') : (old('is_new_patient') == '1' ? 'selected' : '') }}>Yes</option>
                                <option value="0" {{ old('is_new_patient') == '' ? ($appointment->is_new_patient == '0' ? 'selected' : '') : (old('is_new_patient') == '0' ? 'selected' : '') }}>No</option>
                            </select>
                            @error('is_new_patient')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="notes">Notes</label>
                            <textarea type="text" class="form-control  @error('notes') is-invalid @enderror" name="notes" id="notes" placeholder="Notes">{{old('notes',$appointment->notes)}}</textarea>
                            @error('notes')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a type="submit" class="btn btn-secondary" href="{{route('appointments.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
                                <button class="btn btn-warning" onclick="submitForm()"><i class="fa fa-save me-2"></i>Submit and <i class="fa fa-check-circle-o"></i> Approve</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endcan
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const date = new Date();

    let currentHour = date.getHours();

    let currentMinute = date.getMinutes();

    let currentDay= String(date.getDate()).padStart(2, '0');

    let currentMonth = String(date.getMonth()+1).padStart(2,"0");

    let currentYear = date.getFullYear();

    let currentDate = `${currentYear}-${currentMonth}-${currentDay}`;

    const clinic = {!! $clinic !!}
    const appointment = {!! $appointment !!}

    const breakpoint = ":";

    let start_time = clinic.appointment_start_time;
    let start_time_arr = start_time.split(breakpoint);
    clinic_start_time = `"${start_time_arr[0]}:${start_time_arr[1]}"`;

    end_time = clinic.appointment_end_time;
    end_time_arr = end_time.split(breakpoint);
    clinic_end_time = `"${end_time_arr[0]}:${end_time_arr[1]}"`;

    $("#dob").flatpickr({
        defaultDate: appointment.dob,
        dateFormat: "Y-m-d",
    });

    $("#appointment_date").flatpickr({
        defaultDate: appointment.appointment_date,
        dateFormat: "Y-m-d",
        minDate: currentDate,
    });

    $("#appointment_time").flatpickr({
        defaultHour: start_time_arr[0],
        defaultMinute: start_time_arr[1],
        enableTime: true,
        noCalendar: true,
        minTime: clinic_start_time,
        maxTime: clinic_end_time,
        minuteIncrement: 10,
        dateFormat: "h:i K",
    });

    function submitForm(){
        $('#approve').val("YES");
        $("#edit_form").trigger("submit");
    }
</script>
@endpush
