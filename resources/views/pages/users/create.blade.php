@extends('layouts.main')

@section('content')
@can('can-add-user')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Create User</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create User</li>
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
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control  @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="First Name" value="{{ old('firstname')}}" >
                                @error('firstname')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Last Name" value="{{ old('lastname')}}" >
                                @error('lastname')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email')}}" >
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select class="form-control  @error('role') is-invalid @enderror" name="role" id="role">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" {{old('role') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="clinic_id">Clinic</label>
                                <select class="form-control  @error('clinic_id') is-invalid @enderror" name="clinic_id" id="clinic_id">
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
                                <label for="password">Password</label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a type="submit" class="btn btn-secondary" href="{{route('users.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
