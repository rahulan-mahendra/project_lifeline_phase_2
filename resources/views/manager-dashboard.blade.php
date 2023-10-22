@extends('layouts.main')

@section('content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        @foreach ($clinicAppointmentStats as $item)
        <div class="col-lg-12 col-xl-4">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="card-title mb-0">Appointments - {{$item['clinic_name']}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body appointment-widget">
                    <h3></h3>
                    <h6>Total - {{$item['total']}}</h6>
                    <ul class="list-unstyled py-3">
                        <li  class="row align-items-left">
                            <div class="col-4"><i class="mdi mdi-circle text-warning me-2"></i>Pending</div>
                            <div class="col-4">:</div>
                            <div class="col-4"><span class="badge badge-warning">{{$item['pending']}}</span></div>
                        </li>
                        <li  class="row align-items-left">
                            <div class="col-4"><i class="mdi mdi-circle text-primary me-2"></i>Approved</div>
                            <div class="col-4">:</div>
                            <div class="col-4"><span class="badge badge-primary">{{$item['approved']}}</span></div>
                        </li>
                        <li  class="row align-items-left">
                            <div class="col-4"><i class="mdi mdi-circle text-danger me-2"></i>Cancelled</div>
                            <div class="col-4">:</div>
                            <div class="col-4"><span class="badge badge-danger">{{$item['cancelled']}}</span></div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="row align-items-end">
                        <div class="col-6">
                            <div class="mb-3">New Patient: {{$item['new_patient']}}</div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">Old Patient: {{$item['old_patient']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection

@push('script')
    <!-- Apex js -->
    <script src="{{asset('admin/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
    <!-- Slick js -->
    <script src="{{asset('admin/assets/plugins/slick/slick.min.js')}}"></script>
    <!-- Custom Dashboard js -->
    <script src="{{asset('admin/assets/js/custom/custom-dashboard.js')}}"></script>
@endpush
