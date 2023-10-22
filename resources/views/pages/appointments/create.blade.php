@extends('layouts.main')

@section('content')
@can('can-add-appointment')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Create Clinic</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Clinics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Clinic</li>
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
                        <form action="{{route('appointments.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{old('name')}}">
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact_no">Contact Number</label>
                                <input type="text" class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no" id="contact_no" placeholder="+63xxxxxxxxx" value="{{old('contact_no')}}">
                                @error('contact_no')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address">{{old('address')}}</textarea>
                                @error('address')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a type="submit" class="btn btn-secondary" href="{{route('appointments.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
