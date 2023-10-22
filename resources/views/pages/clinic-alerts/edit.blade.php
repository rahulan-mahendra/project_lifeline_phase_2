@extends('layouts.main')

@push('css')
@endpush

@section('content')
@can('can-edit-clinic-alert')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Clinic</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clinic-alerts.index')}}">Clinic Alerts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Clinic Alert</li>
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
                    <form action="{{route('clinic-alerts.update',["clinic_alert" => $clinicAlert->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="clinic_id">Clinic</label>
                            <input type="text" class="form-control  @error('clinic_id') is-invalid @enderror" name="clinic_id" id="clinic_id" placeholder="Clinic" value="{{ old('clinic_id',$clinicAlert->clinic->name)}}" readonly>
                            @error('clinic_id')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Alert Message</label>
                            <textarea type="text" class="form-control  @error('message') is-invalid @enderror" name="message" id="message" placeholder="Alert Message">{{old('message',$clinicAlert->message)}}</textarea>
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
@endpush
