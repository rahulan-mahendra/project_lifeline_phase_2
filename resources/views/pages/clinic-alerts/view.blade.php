@extends('layouts.main')

@push('css')
<!-- Sweet Alert css -->
<link href="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
@can('can-view-clinic-alert')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">View Clinic</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clinic-alerts.index')}}">Clinic Alerts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Clinic Alert</li>
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
                            <div class="card-item">
                                <table class="table-list-view">
                                    <tr>
                                        <td><strong>Clinic</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinicAlert->clinic->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alert Message</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinicAlert->message}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a type="submit" class="btn btn-secondary" href="{{route('clinic-alerts.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
@endpush
