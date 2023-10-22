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
@can('can-add-clinic-alert')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Create Clinic Alert</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clinic-alerts.index')}}">Clinic Alerts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Clinic Alert</li>
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
                    <div class="card-header">

                    </div>
                    <div class="card-body py-0 m-2">
                        <form action="{{route('clinic-alerts.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="clinic_id">Clinic</label>
                                <select class="form-control  @error('clinic_id') is-invalid @enderror" name="clinic_id" id="clinic_id">
                                    <option value="">--Select a clinic--</option>
                                    @foreach ($clinics as $clinic)
                                        <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                    @endforeach
                                </select>
                                @error('clinic_id')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="message">Alert Message</label>
                                <textarea type="text" class="form-control  @error('message') is-invalid @enderror" name="message" id="message" placeholder="Alert Message">{{old('message')}}</textarea>
                                @error('message')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a type="submit" class="btn btn-secondary" href="{{route('clinic-alerts.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
    $("#appointment_start_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        minuteIncrement: 10,
        dateFormat: "h:i K",
    });

    $("#appointment_end_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        minuteIncrement: 10,
        dateFormat: "h:i K",
    });
</script>
@endpush
