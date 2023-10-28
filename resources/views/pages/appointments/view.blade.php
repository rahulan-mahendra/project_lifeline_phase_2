@extends('layouts.main')

@push('css')
@endpush

@section('content')
@can('can-view-appointment')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">View Appointment</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('appointments.index')}}">Appointments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Appointment</li>
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
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <a type="submit" class="btn btn-secondary" href="{{route('appointments.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
                        </div>
                    </div>
                    <div class="card-body mb-2">
                        <div class="row">
                            <div class="card-item col">
                                <table class="table-list-view">
                                    <tr>
                                        <td><strong>Code</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->code}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>First Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->firstname}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->lastname}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of Birth</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->dob}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->phone_no}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Appointment Date</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->appointment_date}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Appointment Time</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Notes</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->notes}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Clinic</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{$appointment->clinic->name}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-item col">
                                <table class="table-list-view">
                                    <tr>
                                        <td><strong>Appointment Status</strong></td>
                                        <td><strong>:</strong></td>
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
                                    @if ($appointment->status == 'Approved')
                                        <tr>
                                            <td><strong>Approved By</strong></td>
                                            <td><strong>:</strong></td>
                                            <td>{{$appointment->approvedBy->firstname}} {{$appointment->approvedBy->lastname}}</td>
                                        </tr>
                                    @endif

                                    @if ($appointment->status == 'Cancelled')
                                        <tr>
                                            <td><strong>Cancelled By</strong></td>
                                            <td><strong>:</strong></td>
                                            <td>{{$appointment->cancelledBy->firstname}} {{$appointment->cancelledBy->lastname}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cancelled Requested By Patient?</strong></td>
                                            <td><strong>:</strong></td>
                                            <td>
                                                @if ($appointment->cancellation_requested_by_patient == '1')
                                                    <span class="badge badge-primary">Yes</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cancellation Notes</strong></td>
                                            <td><strong>:</strong></td>
                                            <td>{{$appointment->cancellation_notes}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->


        @can('can-cancel-appointment')
        @if ($appointment->status != 'Cancelled')
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        Cancel Appointment
                    </div>
                    <div class="card-body py-0 m-2">
                        <form action="{{route('appointments.cancel',["id" => $appointment->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="cancellation_requested_by_patient">Cancellation Requested By Patient? </label>
                                <select class="form-control  @error('cancellation_requested_by_patient') is-invalid @enderror" name="cancellation_requested_by_patient" id="cancellation_requested_by_patient">
                                    <option value=" " selected>Select an option</option>
                                    <option value="1" {{ old('cancellation_requested_by_patient') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('cancellation_requested_by_patient') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('cancellation_requested_by_patient')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cancellation_notes">Cancellation Notes</label>
                                <textarea type="text" class="form-control  @error('cancellation_notes') is-invalid @enderror" name="cancellation_notes" id="cancellation_notes" placeholder="Cancellation Note">{{old('cancellation_notes')}}</textarea>
                                @error('cancellation_notes')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a type="submit" class="btn btn-secondary" href="{{route('appointments.index')}}"><i class="fa fa-arrow-circle-left me-2"></i>Back</a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle-o me-2"></i>Cancel Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
        @endif
        @endcan
</div>
<!-- End Contentbar -->
@endcan
@endsection

@push('script')

@endpush
