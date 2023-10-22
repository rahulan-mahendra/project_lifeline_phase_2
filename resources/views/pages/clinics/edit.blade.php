@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .form-control[readonly]{
        background-color: #fff;
        opacity: 1;
    }
</style>
@endpush

@section('content')
@can('can-edit-clinic')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Clinic</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clinics.index')}}">Clinics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Clinic</li>
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
                    <form action="{{route('clinics.update',["clinic" => $clinic->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{old('name',$clinic->name)}}">
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{old('email',$clinic->email)}}">
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="contact_no">Contact Number</label>
                            <input type="text" class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no" id="contact_no" placeholder="Contact Number" value="{{old('contact_no',$clinic->contact_no)}}">
                            @error('contact_no')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address">{{old('address',$clinic->address)}}</textarea>
                            @error('address')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="days" class="col-form-label text-md-right">Select Open Hours</label>
                            <div class="row">
                                <div class="p-2 col-md-3"  style="vertical-align:bottom;text-align:center;">Day</div>
                                <div class="p-2 col-md-3"  style="vertical-align:bottom;text-align:center;">Is Open</div>
                                <div class="p-2 col-md-3"  style="vertical-align:bottom;text-align:center;">Open Time</div>
                                <div class="p-2 col-md-3"  style="vertical-align:bottom;text-align:center;">Close Time</div>
                            </div>
                            <hr>
                            <div class="row">
                                @foreach ($clinic->openHours as $item)
                                <div class='department p-2 col-md-3' style="vertical-align:bottom;text-align:center;">
                                        <strong>{{ucfirst($item->day)}}</strong>
                                        <input type="hidden" name="days[{{$item->day}}][day]" value="{{$item->day}}">
                                        <input type="hidden" name="days[{{$item->day}}][day_index]" value="{{$item->day_index}}">
                                </div>
                                <div class='checkbox p-2 col-md-3' style="vertical-align:bottom;text-align:center;">
                                    <select class="form-control  @error('{{$item->day}}_is_open') is-invalid @enderror" name="days[{{$item->day}}][is_open]" id="{{$item->day}}_is_open">
                                        <option value="1" {{ old('days.'.$item->day.'.is_open') == '' ? ($item->is_open == '1' ? 'selected' : '') : (old('days.'.$item->day.'.is_open') == '1' ? 'selected' : '') }}>Open</option>
                                        <option value="0" {{ old('days.'.$item->day.'.is_open') == '' ? ($item->is_open == '0' ? 'selected' : '') : (old('days.'.$item->day.'.is_open') == '0' ? 'selected' : '') }}>Closed</option>
                                    </select>
                                </div>
                                <div class='checkbox p-2 col-md-3' style="vertical-align:bottom;text-align:center;">
                                    <input type="time" class="form-control  @error('days.'.$item->day.'.open_time') is-invalid @enderror" name="days[{{$item->day}}][open_time]" id="{{$item->day}}_open_time" value="{{old('days.'.$item->day.'.open_time', $item->open_time)}}">
                                    @error('days.'.$item->day.'.open_time')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='checkbox p-2 col-md-3' style="vertical-align:bottom;text-align:center;">
                                    <input type="time" class="form-control  @error('days.'.$item->day.'.close_time') is-invalid @enderror" name="days[{{$item->day}}][close_time]" id="{{$item->day}}_close_time" value="{{old('days.'.$item->day.'.close_time', $item->close_time)}}">
                                    @error('days.'.$item->day.'.close_time')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a type="submit" class="btn btn-secondary" href="{{route('clinics.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
    const breakpoint = ":";

    var clinic = {!! json_encode($clinic) !!}

    var prev_start_time = clinic.appointment_start_time;
    var prev_start_time_arr = prev_start_time.split(breakpoint);

    var prev_end_time = clinic.appointment_end_time;
    var prev_end_time_arr = prev_end_time.split(breakpoint);


    console.log(prev_start_time, prev_end_time);

    let load_start_time;
    if( (parseInt(prev_start_time_arr[0]) - 12) == 0 )
    {
        load_start_time = `${parseInt(prev_start_time_arr[0])-12}:${prev_start_time_arr[1]} PM` ;
    }
    else if ( (parseInt(prev_start_time_arr[0]) - 12 ) == (-12))
    {
        load_start_time = `${parseInt(prev_start_time_arr[0])+12}:${prev_start_time_arr[1]} AM`;
    }
    else if ( (parseInt(prev_start_time_arr[0]) - 12) > 0)
    {
        load_start_time = `${parseInt(prev_start_time_arr[0])-12}:${prev_start_time_arr[1]} PM`;
    }
    else
    {
        load_start_time = `${parseInt(prev_start_time_arr[0])}:${prev_start_time_arr[1]} AM` ;
    }

    let load_end_time;
    if( (parseInt(prev_end_time_arr[0]) - 12) == 0 )
    {
        load_end_time = `${parseInt(prev_end_time_arr[0])}:${prev_end_time_arr[1]} PM` ;
    }
    else if ( (parseInt(prev_end_time_arr[0] -12 ) - 12) == (-12))
    {
        load_end_time = `${parseInt(prev_end_time_arr[0]) + 12}:${prev_end_time_arr[1]} AM`;
    }
    else if ( (parseInt(prev_end_time_arr[0]) - 12) > 0)
    {
        load_end_time = `${parseInt(prev_end_time_arr[0]) - 12}:${prev_end_time_arr[1]} PM`;
    }
    else
    {
        load_end_time = `${parseInt(prev_end_time_arr[0])}:${prev_end_time_arr[1]} AM` ;
    }



    $(document).ready(function(){
        $("#appointment_start_time").val(load_start_time);
        $("#appointment_end_time").val(load_end_time);

    });


    $("#appointment_start_time").flatpickr({
        defaultHour: prev_start_time_arr[0],
        defaultMinute: prev_start_time_arr[1],
        enableTime: true,
        noCalendar: true,
        minuteIncrement: 10,
        dateFormat: "h:i K",
    });

    $("#appointment_end_time").flatpickr({
        defaultHour: prev_end_time_arr[0],
        defaultMinute: prev_end_time_arr[1],
        enableTime: true,
        noCalendar: true,
        minuteIncrement: 10,
        dateFormat: "h:i K",
    });
</script>
<script>
    $( document ).ready(function(){
        var mondayIsOpen = $("#monday_is_open").val();
        if(mondayIsOpen == '1'){
            $("#monday_open_time").show();
            $("#monday_close_time").show();
        } else {
            $("#monday_open_time").val(null);
            $("#monday_open_time").hide();
            $("#monday_close_time").val(null);
            $("#monday_close_time").hide();
        }

        var tuesdayIsOpen = $("#tuesday_is_open").val();
        if(tuesdayIsOpen == '1'){
            $("#tuesday_open_time").show();
            $("#tuesday_close_time").show();
        } else {
            $("#tuesday_open_time").val(null);
            $("#tuesday_open_time").hide();
            $("#tuesday_close_time").val(null);
            $("#tuesday_close_time").hide();
        }

        var wednesdayIsOpen = $("#wednesday_is_open").val();
        if(wednesdayIsOpen == '1'){
            $("#wednesday_open_time").show();
            $("#wednesday_close_time").show();
        } else {
            $("#wednesday_open_time").val(null);
            $("#wednesday_open_time").hide();
            $("#wednesday_close_time").val(null);
            $("#wednesday_close_time").hide();
        }

        var thursdayIsOpen = $("#thursday_is_open").val();
        if(thursdayIsOpen == '1'){
            $("#thursday_open_time").show();
            $("#thursday_close_time").show();
        } else {
            $("#thursday_open_time").val(null);
            $("#thursday_open_time").hide();
            $("#thursday_close_time").val(null);
            $("#thursday_close_time").hide();
        }

        var fridayIsOpen = $("#friday_is_open").val();
        if(fridayIsOpen == '1'){
            $("#friday_open_time").show();
            $("#friday_close_time").show();
        } else {
            $("#friday_open_time").val(null);
            $("#friday_open_time").hide();
            $("#friday_close_time").val(null);
            $("#friday_close_time").hide();
        }

        var saturdayIsOpen = $("#saturday_is_open").val();
        if(saturdayIsOpen == '1'){
            $("#saturday_open_time").show();
            $("#saturday_close_time").show();
        } else {
            $("#saturday_open_time").val(null);
            $("#saturday_open_time").hide();
            $("#saturday_close_time").val(null);
            $("#saturday_close_time").hide();
        }

        var sundayIsOpen = $("#sunday_is_open").val();
        if(sundayIsOpen == '1'){
            $("#sunday_open_time").show();
            $("#sunday_close_time").show();
        } else {
            $("#sunday_open_time").val(null);
            $("#sunday_open_time").hide();
            $("#sunday_close_time").val(null);
            $("#sunday_close_time").hide();
        }

    });


    $('#monday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#monday_open_time").show();
            $("#monday_close_time").show();
        } else {
            $("#monday_open_time").val(null);
            $("#monday_open_time").hide();
            $("#monday_close_time").val(null);
            $("#monday_close_time").hide();
        }
    });

    $('#tuesday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#tuesday_open_time").show();
            $("#tuesday_close_time").show();
        } else {
            $("#tuesday_open_time").val(null);
            $("#tuesday_open_time").hide();
            $("#tuesday_close_time").val(null);
            $("#tuesday_close_time").hide();
        }
    });

    $('#wednesday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#wednesday_open_time").show();
            $("#wednesday_close_time").show();
        } else {
            $("#wednesday_open_time").val(null);
            $("#wednesday_open_time").hide();
            $("#wednesday_close_time").val(null);
            $("#wednesday_close_time").hide();
        }
    });

    $('#thursday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#thursday_open_time").show();
            $("#thursday_close_time").show();
        } else {
            $("#thursday_open_time").val(null);
            $("#thursday_open_time").hide();
            $("#thursday_close_time").val(null);
            $("#thursday_close_time").hide();
        }
    });

    $('#friday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#friday_open_time").show();
            $("#friday_close_time").show();
        } else {
            $("#friday_open_time").val(null);
            $("#friday_open_time").hide();
            $("#friday_close_time").val(null);
            $("#friday_close_time").hide();
        }
    });

    $('#saturday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#saturday_open_time").show();
            $("#saturday_close_time").show();
        } else {
            $("#saturday_open_time").val(null);
            $("#saturday_open_time").hide();
            $("#saturday_close_time").val(null);
            $("#saturday_close_time").hide();
        }
    });

    $('#sunday_is_open').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var IsOpen = this.value;
        if(IsOpen == '1'){
            $("#sunday_open_time").show();
            $("#sunday_close_time").show();
        } else {
            $("#sunday_open_time").val(null);
            $("#sunday_open_time").hide();
            $("#sunday_close_time").val(null);
            $("#sunday_close_time").hide();
        }
    });
</script>
@endpush
