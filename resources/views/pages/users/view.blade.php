@extends('layouts.main')

@push('css')
<!-- Sweet Alert css -->
<link href="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
@can('can-view-user')
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
                        <div class="row">
                            <div class="card-item col-lg-6">
                                <table class="table-list-view">
                                    <tr>
                                        <td><strong>First Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$user->firstname}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$user->lastname ? $user->lastname : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$user->roles[0]->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>
                                            @if ($user->is_active == true)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-item col-lg-6">
                                @can('can-edit-user')
                                <div class="col-md-3 mt-2">
                                    <button  onclick="changeStatus('{{$user->id}}')" class="btn btn-sm @if ($user->is_active == 1)  btn-danger   @else btn-success   @endif mr-1">@if ($user->is_active == 1) InActivate @else Activate  @endif</button>
                                    <form action="{{route('users.changeStatus',$user->id)}}" method="post" id='form-data'>
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </div>
                                @endcan
                                @can('can-delete-token')
                                <div class="col-md-3 mt-2">
                                    <button  onclick="clearToken('{{$user->id}}')" class="btn btn-warning mr-1">Clear Reset Token</button>
                                    <form action="{{route('tokens.destroy',$user->id)}}" method="post" id='form-data-{{$user->id}}'>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a type="submit" class="btn btn-secondary" href="{{route('users.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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

@push('script')
<!-- Sweet-Alert js -->
<script src="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script>
function changeStatus(id){
    swal({
        title: 'Are you sure?',
        text: "You want to change this user status",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger m-l-10',
        confirmButtonText: 'Yes, change it!'
    }).then(function () {
            $('#form-data').submit();
    })
}

function clearToken(id){
    swal({
        title: 'Are you sure?',
        text: "You want to clear this user's reset token",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger m-l-10',
        confirmButtonText: 'Yes, clear it!'
    }).then(function () {
            $('#form-data-'+id).submit();
    })
}
</script>
@endpush
