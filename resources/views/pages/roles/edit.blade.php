@extends('layouts.main')

@section('content')
@can('can-edit-role')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Role</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
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
                    <form action="{{route('roles.update',$role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name',$role->name) }}" readonly>
                            @error('name')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h4 class="text-dark mt-4 mb-4 text-center">Permissions</h4>
                        <div class="row mb-4">
                            @forelse ($permissions as $key => $permissionGroup)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <div>{{$key}}
                                                        </div>
                                                        @forelse ($permissionGroup as $permission)
                                                            <div>
                                                                <label class="checkboxLabel">
                                                                    <input type="checkbox" id="permission-{{$permission->id}}" class="permission-check permission-selected-{{str_replace('','-',$key)}}" name="permissions[]" value="{{$permission->id}}" {{in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : ''}}>
                                                                    {{$permission->name}}
                                                                </label>

                                                            </div>
                                                        @empty

                                                        @endforelse
                                                </div>
                                            </div>

                                        @empty

                                        @endforelse
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a type="submit" class="btn btn-secondary" href="{{route('roles.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
