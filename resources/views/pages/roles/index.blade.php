@extends('layouts.main')

@push('css')
<!-- DataTables css -->
<link href="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Roles</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                @can('can-add-role')
                <a class="btn btn-primary-rgba" href="{{route('roles.create')}}"><i class="feather icon-plus me-2"></i>Create</a>
                @endcan
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
                <div class="card-header">
                    <h5 class="card-title">Roles</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
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
                                    <td class="d-flex">
                                        @can('can-view-role')
                                        <a class="btn btn-success-rgba me-2" href="{{route('roles.show',$role->id)}}"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('can-edit-role')
                                        <a class="btn btn-warning-rgba me-2" href="{{route('roles.edit',$role->id)}}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        {{-- <button  onclick="deleteConfirmation('{{$role->id}}')" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Delete</button>
                                        <form action="{{route('roles.destroy',$role->id)}}" method="post" id='form-data-{{$role->id}}'>
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection

@push('script')
    <!-- Datatable js -->
    <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/custom-table-datatable.js')}}"></script>
@endpush
