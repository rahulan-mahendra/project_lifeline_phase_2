<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>LIFELINE - Appointment</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/color_logo_no_background.svg')}}">
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!-- Datepicker css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <style>
        .col-form-label {
            text-align: left !important; /* !important added for priority in SO snippet. */
        }
        .form-control[readonly]{
            background-color: #fff;
            opacity: 1;
        }
        .form-control[disabled]{
            background-color: #D3D3D3;
            opacity: 1;
        }
        .move-left {
            width: auto;
            box-shadow: none;
        }
        .form-control {
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #212529;
        }
        .form-control::placeholder {
            opacity: .5;
        }
        .modal-header
        {
            border: 1px solid #d9534f;
        }
    </style>
    <!-- End css -->
</head>

<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar appointment-authenticate-bg bg-secondary">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-8">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card ">
                                <div class="card-body">
                                    <form class="form-validate"  method="POST" action="{{route('patient.appointment.store')}}">
                                        @csrf
                                        <div class="form-head">
                                            <a href="{{route('patient.appointment.index')}}" class="logo"><img src="{{asset('admin/assets/images/color_logo_no_background.svg')}}" class="img-fluid" alt="logo"></a>
                                        </div>
                                        <p class="text-danger">Weekend closures apply to some of our Centers. Therefore, we request our patients to check the opening hours on <span> <a href="https://lifelinemedicals.com.au" target="_blank" >https://lifelinemedicals.com.au</a> </span> before making reservations.</p>
                                        <h4 class="text-primary mt-2 mb-2">Book An Appointment With Us</h4>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="lastname">First Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter First Name here">
                                                @error('firstname')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="lastname">Last Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter Last Name here">
                                                @error('lastname')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email here">
                                                @error('email')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="phone_no">Phone Number <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" placeholder="Enter Phone Number here">
                                                @error('phone_no')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="dob">Date of Birth <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" placeholder="Enter Date of birth here">
                                                @error('dob')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="lastname">Preferred Clinic Location <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <select class="form-control  @error('clinic') is-invalid @enderror" name="clinic" id="clinic">
                                                    <option value=" " selected>Please select a clinic</option>
                                                    @foreach ($clinics as $clinic)
                                                        <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('clinic')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="appointment_date">Preferred Appointment Date <span class="text-danger">* <div class="date_warn font-10"></div></span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date" name="appointment_date" placeholder="Select Appoinment Date">
                                                @error('appointment_date')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" id="day_index" name="day_index">
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="appointment_time"> Preferred Appointment Time <span class="text-danger">* <div class="time_limit font-10"></div></span></label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('appointment_time') is-invalid @enderror" id="appointment_time" name="appointment_time" placeholder="Select Time">
                                                @error('appointment_time')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-form-label" for="is_new_patient">New Patient? <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <select class="form-control  @error('is_new_patient') is-invalid @enderror" name="is_new_patient" id="is_new_patient">
                                                    <option value=" " selected>Please select an option</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                @error('is_new_patient')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-lg-4 col-md-4 col-form-label" for="date_time">Notes </label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" placeholder="Tell us if you need any reports">{{ old('notes') }}</textarea>
                                                @error('notes')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2 mb-2">
                                            <div class="btn btn-secondary  font-18" onclick="clearForm()">Clear Form</div>
                                            <button class="btn btn-primary  font-18" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->

    <!-- Start Alert Modal -->
    <div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="staticBackdropLabel">Alert!!!</h5>
                </div>
                <div class="modal-body">
                    <div id="alert-message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Alert Modal -->
    <!-- Start js -->
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap.bundle.js')}}"></script>

    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        const date = new Date();

        let currentHour = date.getHours();

        let currentMinute = date.getMinutes();

        let currentDay= String(date.getDate()).padStart(2, '0');

        let currentMonth = String(date.getMonth()+1).padStart(2,"0");

        let currentYear = date.getFullYear();

        let currentDate = `${currentYear}-${currentMonth}-${currentDay}`;

        let currentTime = `${currentYear}-${currentMonth}-${currentDay} ${currentHour}:${currentMinute}`;

        const clinics = {!! json_encode($clinics) !!};

        let clinic_start_time = "00:00";
        let clinic_end_time = "00:00";

        $( document ).ready(function(){
            clearForm();
            disableAndReset();
        });

        $('#clinic').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var clinicSelected = this.value;


            if($.trim(clinicSelected).length !== 0){
                $('#appointment_date').val("");
                $('#appointment_date').prop("disabled",false);
                $('#appointment_time').val("");
                $("#appointment_time").prop("disabled",true);


                var clinics = {!! json_encode($clinics) !!};

                var clinic = clinics.find(clinic => {
                    return clinic.id == parseInt(clinicSelected);
                });

                if (clinic.alert != null) {
                    $('#alert-message').html(clinic.alert.message);
                    $('#alertModal').modal("show");
                }

                let closed_day_indexes = closedDays(clinic.open_hours);

                $("#appointment_date").flatpickr({
                    // defaultDate: currentDate,
                    dateFormat: "Y-m-d",
                    minDate: currentDate,
                    disableMobile: "true",
                    locale: {
                        "firstDayOfWeek": 1 // start week on Monday
                    },
                    disable: [
                        function(date){
                            if (closed_day_indexes.includes(0)) {
                                return date.getDay() === 0;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(1)) {
                                return date.getDay() === 1;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(2)) {
                                return date.getDay() === 2;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(3)) {
                                return date.getDay() === 3;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(4)) {
                                return date.getDay() === 4;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(5)) {
                                return date.getDay() === 5;
                            }
                        },
                        function(date){
                            if (closed_day_indexes.includes(6)) {
                                return date.getDay() === 6;
                            }
                        }
                    ],
                    onChange: function(selectedDates, dateStr, instance) {
                        let seletected_day_index = selectedDates[0].getDay();
                        prepareTimePicker(seletected_day_index);
                        $('#day_index').val(seletected_day_index);
                    },
                });

                function prepareTimePicker(day_index){
                    $("#appointment_time").prop("disabled",false);


                    let openHours = clinic.open_hours;
                    let selected_day = openHours.filter((item)=> (item.day_index === day_index ? true : false));

                    const breakpoint = ":";

                    let start_time = selected_day[0].open_time;
                    let start_time_arr = start_time.split(breakpoint);
                    clinic_start_time = `"${start_time_arr[0]}:${start_time_arr[1]}"`;

                    end_time =  selected_day[0].close_time;
                    end_time_arr = end_time.split(breakpoint);
                    clinic_end_time = `"${end_time_arr[0]}:${end_time_arr[1]}"`;


                    let start_limit = timeFormatter(start_time_arr);
                    let end_limit = timeFormatter(end_time_arr);

                    $(".time_limit").html(`Choose a time between ${start_limit} - ${end_limit}`);

                    $("#appointment_time").val(clinic_start_time);

                    $("#appointment_time").flatpickr({
                        defaultHour: start_time_arr[0],
                        defaultMinute: start_time_arr[1],
                        enableTime: true,
                        noCalendar: true,
                        minTime: clinic_start_time,
                        maxTime: clinic_end_time,
                        minuteIncrement: 10,
                        dateFormat: "h:i K",
                    });
                }
            } else {
                disableAndReset();
            }
        });

        $("#dob").flatpickr({
            // defaultDate: currentDate,
            dateFormat: "Y-m-d",
            maxDate: currentDate,
            disableMobile: "false"
        });

        function clearForm(){
            $('#firstname').val("");
            $('#lastname').val("");
            $('#email').val("");
            $('#phone_no').val("");
            $('#dob').val("");
            $('#clinic').val(" ").change();
            $('#appointment_date').val("");
            $('#appointment_time').val("");
            $('#is_new_patient').val(" ").change();
            $('#notes').val("");
        }

        function disableAndReset(){
            $('#appointment_date').val("");
            $('#appointment_time').val("");
            $('#appointment_date').prop("disabled",true);
            $("#appointment_time").prop("disabled",true);
            $(".date_warn").html(`Choose a clinic.`)
            $(".time_limit").html(`Choose a date.`)
        }

        function enableAndPreSet(){
            $('#appointment_date').val("");
            $('#appointment_time').val("");
            $('#appointment_date').prop("disabled",false);
            $("#appointment_time").prop("disabled",false);
            $(".date_warn").html(`Choose a clinic.`)
            $(".time_limit").html(`Choose a date.`)
        }

        function timeFormatter(time_arr){
            var hour = time_arr[0] - 12;
            if (hour < 0 && hour != -12) {
                return `"${time_arr[0]}:${time_arr[1]} AM"`;
            }
            if (hour == -12){
                return `"${12}:${time_arr[1]} AM"`;
            }
            if (hour > 0 && hour != 12) {
                return `"${time_arr[0]-12}:${time_arr[1]} PM"`;
            }
            if (hour == 0){
                return `"${time_arr[0]}:${time_arr[1]} PM"`;
            }
        }

        function closedDays(days_arr){
            let all_days_arr = days_arr;
            let closed_days_arr = all_days_arr.filter((item)=> (item.is_open === 0 ? true : false));
            let closed_day_indexes = closed_days_arr.map(item => item.day_index);

            return closed_day_indexes;
        }
    </script>
    <!-- End js -->
</body>

</html>
