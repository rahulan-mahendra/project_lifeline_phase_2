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
            <h4 class="page-title"></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li> --}}
                    <li class="breadcrumb-item active text-strong" aria-current="page">Dashboard @if (Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager())  @else -  {{Auth::user()->clinic->name}}  @endif</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a class="btn btn-primary-rgba" href="{{route('dashboard')}}"><i class="fa fa-refresh me-2"></i>Refresh</a>
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
        <div class="col-lg-12 col-xl-3">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">Total Pending Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 pr-0">
                            <h4 class="mb-3"><span class="badge badge-warning">{{$pendingApponitments ? $pendingApponitments : 0}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-3">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">Total Approved Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 pr-0">
                            <h4 class="mb-3"><span class="badge badge-primary">{{$approvedApponitments ? $approvedApponitments : 0}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-3">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">Total Cancelled Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4 pr-0">
                            <h4 class="mb-3"><span class="badge badge-danger">{{$cancelledApponitments ? $cancelledApponitments : 0}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-3">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title mb-0">Appointments by Patient Type</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6 pr-0">
                            <h4 class="mb-3">New : {{$newPatientApponitments ? $newPatientApponitments : 0}}</h4>
                        </div>
                        <div class="col-6 pr-0">
                            <h4 class="mb-3">Old : {{$oldPatientApponitments ? $oldPatientApponitments : 0}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header justify-content-between d-flex">
                    <h5 class="card-title">Today's Pending Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>Phone Number</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayPendingApponitments as $appointment)
                                <tr>
                                    <td>{{$appointment->code}}</td>
                                    <td>{{$appointment->firstname}}</td>
                                    <td>{{$appointment->lastname}}</td>
                                    <td>{{$appointment->dob}}</td>
                                    <td>{{$appointment->phone_no}}</td>
                                    <td>{{$appointment->appointment_date}}</td>
                                    <td>{{\Carbon\Carbon::createFromTimeString($appointment->appointment_time,'Australia/Melbourne')->format('g:i A')}}</td>
                                    <td>
                                        @if ($appointment->status == 'Pending')
                                        <span class="badge badge-warning">{{$appointment->status}}</span>
                                        @elseif ($appointment->status == 'Approved')
                                            <span class="badge badge-primary">{{$appointment->status}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$appointment->status}}</span>
                                        @endif
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- <!-- Apex js -->
    <script src="{{asset('admin/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
    <!-- Slick js -->
    <script src="{{asset('admin/assets/plugins/slick/slick.min.js')}}"></script>
    <!-- Custom Dashboard js -->
    <script src="{{asset('admin/assets/js/custom/custom-dashboard.js')}}"></script> --}}
@endpush
