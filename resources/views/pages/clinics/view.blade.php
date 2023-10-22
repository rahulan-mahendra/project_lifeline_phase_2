@extends('layouts.main')

@push('css')
<!-- Sweet Alert css -->
<link href="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
@can('can-view-clinic')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">View Clinic</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('clinics.index')}}">Clinics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Clinic</li>
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
                                        <td><strong>Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinic->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinic->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact Number</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinic->contact_no}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$clinic->address}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mb-2">
                        <h6 class="card-subtitle"><strong>Open Hours</strong></h6>
                        <div class="table-responsive m-b-30">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Day</th>
                                        <th scope="col">Is Open</th>
                                        <th scope="col">Open Time</th>
                                        <th scope="col">Close Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clinic->openHours as $item)
                                    <tr>
                                        <th>{{$item['day']}}</th>
                                        <td>
                                            @if ($item['is_open'] == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>{{Carbon\Carbon::parse($item['open_time'])->isoFormat('h:mm A')}}</td>
                                        <td>{{Carbon\Carbon::parse($item['close_time'])->isoFormat('h:mm A')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a type="submit" class="btn btn-secondary" href="{{route('clinics.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
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
@endpush
