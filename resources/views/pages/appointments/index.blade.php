@extends('layouts.main')

@push('css')
<!-- DataTables css -->
<link href="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Sweet Alert css -->
<link href="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<style>
.form-control[readonly]{
            background-color: #fff;
            opacity: 1;
}
</style>
@endpush

@section('content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Appointments</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
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
                <div class="card-header justify-content-between d-flex">
                    <h5 class="card-title">Appointments @if (Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager())  @else -  {{Auth::user()->clinic->name}}  @endif</h5>
                    <a class="btn btn-primary-rgba" href="{{route('appointments.index')}}"><i class="fa fa-refresh me-2"></i>Refresh</a>
                </div>
                <div class="card-body">
                    <!--Filter Form-->
                    <form class="bg-light rounded" action="{{route('appointments.index')}}" method="GET">
                        <div class="row p-1">
                            @csrf
                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="code">Code <span class="text-danger font-14">(Number Only.)</span></label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="{{old('code',$code)}}">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="{{old('name',$name)}}">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="code">DOB</label>
                                    <input type="text" class="form-control" id="dob" name="dob" placeholder="DOB">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="appointment_date">Appointment Date</label>
                                    <input type="text" class="form-control" id="appointment_date" name="appointment_date" placeholder="Appointment Date">
                                </div>
                            </div>

                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="" selected>All</option>
                                        <option value="Pending"  {{ old('status') == '' ? ($status == 'Pending' ? 'selected' : '') : (old('status') == 'Pending' ? 'selected' : '') }}>Pending</option>
                                        <option value="Approved" {{ old('status') == '' ? ($status == 'Approved' ? 'selected' : '') : (old('status') == 'Pending' ? 'Approved' : '') }}>Approved</option>
                                        <option value="Cancelled" {{ old('status') == '' ? ($status == 'Cancelled' ? 'selected' : '') : (old('status') == 'Cancelled' ? 'selected' : '') }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>


                            @if (Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager())
                            <div class="col col-lg-4 col-md-3">
                                <div class="form-group">
                                    <label for="status">Clinic</label>
                                    <select class="form-select" id="clinic" name="clinic">
                                        <option value="" selected>All</option>
                                        @foreach ($clinics as $item)
                                            <option value="{{$item->id}}" {{ old('clinic') == '' ? ($clinic == $item->id ? 'selected' : '') : (old('clinic') == $item->id ? 'selected' : '') }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="d-grid mt-2 mb-2">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>
                    <!--Filter Form-->
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
                                @if (Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager())
                                <th>Clinic</th>
                                @endif
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $appointment)
                                <tr>
                                    <td>{{$appointment->code}}</td>
                                    <td>{{$appointment->firstname}}</td>
                                    <td>{{$appointment->lastname}}</td>
                                    <td>{{$appointment->dob}}</td>
                                    <td>{{$appointment->phone_no}}</td>
                                    <td>{{$appointment->appointment_date}}</td>
                                    <td>{{\Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A')}}</td>
                                    <td>
                                        @if ($appointment->status == 'Pending')
                                        <span class="badge badge-warning">{{$appointment->status}}</span>
                                        @elseif ($appointment->status == 'Approved')
                                            <span class="badge badge-primary">{{$appointment->status}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$appointment->status}}</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->isSuperAdmin() || Auth::user()->isClinicManager())
                                    <th>{{$appointment->clinic_name}}</th>
                                    @endif
                                    <td class="d-flex">
                                        @can('can-view-appointment')
                                        <a class="btn btn-success-rgba me-2" href="{{route('appointments.show',$appointment->id)}}"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @if ($appointment->status == "Pending")
                                            @can('can-edit-appointment')
                                            <a class="btn btn-warning-rgba me-2" href="{{route('appointments.edit',$appointment->id)}}"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('can-approve-appointment')
                                                <button class="btn btn-primary-rgba me-2" onclick="approvalConfirmation('{{$appointment->id}}')"><i class="fa fa-check-circle-o"></i></button>
                                                <form action="{{route('appointments.approve',$appointment->id)}}" method="post" id='form-data-{{$appointment->id}}'>
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @endcan
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
    <!-- Sweet-Alert js -->
    <script src="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
    <script>
        const date = new Date();

        let currentHour = date.getHours();

        let currentMinute = date.getMinutes();

        let currentDay= String(date.getDate()).padStart(2, '0');

        let currentMonth = String(date.getMonth()+1).padStart(2,"0");

        let currentYear = date.getFullYear();

        let currentDate = `${currentYear}-${currentMonth}-${currentDay}`;

        $("#dob").flatpickr({
            dateFormat: "Y-m-d",
        });

        $("#appointment_date").flatpickr({
            // defaultDate: currentDate,
            dateFormat: "Y-m-d",
            mode: "range",
        });


        function approvalConfirmation(id){
            swal({
                title: 'Are you sure?',
                text: "You want to approve this appointment",
                type: 'question',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                confirmButtonText: 'Yes, approve it!'
            }).then(function () {
                    $('#form-data-'+id).submit();
            })
        }
    </script>
@endpush
