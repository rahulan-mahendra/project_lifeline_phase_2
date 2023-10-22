@extends('layouts.main')

@section('content')
@can('can-view-role')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">View Role</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Role</li>
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
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header"></div>
                    <div class="card-body mb-2">
                        <div class="card-item">
                            <table class="table-list-view">
                                <tr>
                                <td><strong>Role</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{$role->name}}</td>
                                </tr>
                                <tr>
                                <td><strong>Permissions</strong></td>
                                <td><strong>:</strong></td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                            @php
                                                $permission_name = ucfirst(str_replace('-',' ',$permission->name));
                                            @endphp
                                            @if(strpos($permission_name,'delete'))
                                                <span class="badge badge-danger text-white"> {{ $permission_name }}</span>
                                            @elseif(strpos($permission_name,'edit'))
                                                <span class="badge badge-warning text-white"> {{ $permission_name }}</span>
                                            @elseif(strpos($permission_name,'add'))
                                                <span class="badge badge-success text-white"> {{ $permission_name }}</span>
                                            @else
                                                <span class="badge badge-primary text-white"> {{ $permission_name }}</span>
                                            @endif
                                        @endforeach
                                </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a type="submit" class="btn btn-secondary" href="{{route('roles.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
                        </div>
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
