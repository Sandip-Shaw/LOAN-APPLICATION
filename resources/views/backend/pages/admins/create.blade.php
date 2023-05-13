@extends('backend.layouts.master')

@section('title')
    User Create - Admin Panel
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">User Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.admins.index') }}">All Users</a></li>
                        <li><span>Create User</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                    <div class="card-body">
                        <h4 class="header-title">Create New Role</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.admins.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="employee" class=" col-form-label"><b>Employee</b><span
                                            style="color:red; font-size: 18px;line-height:1">*</span></label>

                                    <select name="employee_id" id="employee" class="form-control">
                                        <option value="">Select Employee</option>
                                        @foreach ($employee as $key => $employee_id)
                                            <option value="{{ $employee_id }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-top: 4px;">
                                    <label for="designation"> <b>Designation</b></label>
                                    <!-- <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation  "> -->
                                    <select name="designation" id="designation" class="form-control" required>
                                        <option value="">Choose designation</option>
                                        @foreach ($design as $key => $designation)
                                            <option value="{{ $designation }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name"><b> Name </b></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email"><b> Email </b></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="mobile"><b> Mobile </b></label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter mobile no.">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="dob"><b> DOB </b></label>
                                    <input type="text" class="form-control" id="dob" name="dob"
                                        placeholder="Enter DOB">
                                </div>
                            </div>

                            <!-- <div class="form-row">
                                                                <div class="form-group col-md-6 col-sm-12">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-12">
                                                                    <label for="password_confirmation">Confirm Password</label>
                                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                                                </div>
                                                            </div> -->

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="password">Assign Roles</label>
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="username">Login Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="password">Branch</label>
                                    <select name="branch[]" id="branch" class="form-control select2" multiple>
                                        @foreach ($branch as $key => $branches)
                                            <option value="{{ $branches }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="username">Back Date Entry Days </label>
                                    <input type="text" class="form-control" id="back_date_entry_days"
                                        name="back_date_entry_days" placeholder="Enter Back Date Entry Days">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6" style="display:flex">
                                    <p style="padding-right: 10px;line-height: 3;"><b> Holiday Login </b><span
                                            style="color:red; font-size: 18px;line-height:1">*</span></p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="holiday_login"
                                            value="1" checked>
                                        <label class="form-check-label" for="holiday_login">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="holiday_login"
                                            value="0">
                                        <label class="form-check-label" for="holiday_login">No</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 " style="display:flex">
                                    <p style="padding-right: 10px;line-height: 3;"><b>User Active </b><span
                                            style="color:red; font-size: 18px;line-height:1">*</span></p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_active" value="1"
                                            checked>
                                        <label class="form-check-label" for="user_active">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_active"
                                            value="0">
                                        <label class="form-check-label" for="user_active">No</label>
                                    </div>
                                </div>

                            </div>




                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><i class="fa fa-plus-square"
                                    aria-hidden="true"></i>&nbsp;Create Admin</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
        $(document).ready(function() {
            $("#employee").change(function() {
                var id = $(this).find(":selected").val();


                $.ajax({
                    type: "GET",
                    url: "../employeeDetails/" + id,
                    success: function(res) {
                        console.log(res);
                        if (res) {
                            const obj = JSON.parse(res);
                            document.getElementById("designation").value = obj.designation;
                            document.getElementById("name").value = obj.name;
                            document.getElementById("email").value = obj.email;
                            document.getElementById("mobile").value = obj.mobile;
                            document.getElementById("dob").value = obj.dob;



                        }
                    }
                })
            })
        })
        $('#press-flag').on('change', function(e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if (valueSelected == 0) {
                $('#prescription').addClass('d-none')
            } else {
                $('#prescription').removeClass('d-none')
            }
        });
        $('#sample').on('change', function(e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if (valueSelected == 'no') {
                $('#test-center').addClass('d-none')
            } else {
                $('#test-center').removeClass('d-none')
            }
        });
    </script>
@endsection
