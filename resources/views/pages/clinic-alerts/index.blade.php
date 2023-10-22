@extends('layouts.main')

@push('css')
<!-- DataTables css -->
<link href="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert css -->
<link href="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Clinic Alerts</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clinic Alerts</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                @can('can-add-clinic-alert')
                <a class="btn btn-primary-rgba" href="{{route('clinic-alerts.create')}}"><i class="feather icon-plus me-2"></i>Create</a>
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
                    <h5 class="card-title">Clinic Alerts</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Clinic</th>
                                <th>Alert Message</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clinic_alert)
                                <tr>
                                    <td>{{$clinic_alert->clinic->name}}</td>
                                    <td>{{$clinic_alert->message}}</td>
                                    <td class="d-flex">
                                        @can('can-view-clinic-alert')
                                        <a class="btn btn-success-rgba me-2" href="{{route('clinic-alerts.show',$clinic_alert->id)}}"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('can-edit-clinic-alert')
                                        <a class="btn btn-warning-rgba me-2" href="{{route('clinic-alerts.edit',$clinic_alert->id)}}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('can-delete-clinic-alert')
                                            <button class="btn btn-danger-rgba me-2" onclick="deleteConfirmation('{{$clinic_alert->id}}')"><i class="fa fa-trash"></i></button>
                                            <form action="{{route('clinic-alerts.destroy',$clinic_alert->id)}}" method="post" id='form-data-{{$clinic_alert->id}}'>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
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
    <!-- Sweet-Alert js -->
    <script src="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

    <script>
        function deleteConfirmation(id){
            swal({
                title: 'Are you sure?',
                text: "You want to delete this clinic alert",
                type: 'question',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                    $('#form-data-'+id).submit();
            })
        }
    </script>
@endpush
