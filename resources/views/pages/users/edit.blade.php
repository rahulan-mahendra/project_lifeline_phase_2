@extends('layouts.main')

@section('content')
@can('can-edit-user')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit User</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                    <form action="{{route('users.update',["user" => $user->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control  @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="First Name" value="{{ old('firstname',$user->firstname)}}">
                            @error('firstname')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Last Name" value="{{ old('lastname',$user->lastname)}}">
                            @error('lastname')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email',$user->email)}}">
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if (!$user->isClinicManager())
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select class="form-control  @error('role') is-invalid @enderror" name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{ old('role') == '' ? ($userRole->role_id == $role->id ? 'selected' : '') : (old('role') == $role->id ? 'selected' : '') }}>{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endif
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
