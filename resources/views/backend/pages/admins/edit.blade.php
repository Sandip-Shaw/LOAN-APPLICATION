
@extends('backend.layouts.master')

@section('title')
User Edit - Admin Panel
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
                <h4 class="page-title pull-left">User Edit</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.admins.index') }}">All Users</a></li>
                    <li><span>Edit User - {{ $admin->name }}</span></li>
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
                    <h4 class="header-title">Edit User - {{ $admin->name }}</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $admin->name }}" readonly>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">User Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $admin->email }}" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="password">Assign Roles</label>
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="username">Login Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required value="{{ $admin->username }}">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="password">Branch</label>
                                <select name="branch[]" id="branch" class="form-control select2" multiple>
                                @foreach ($branch_sel as $item)
                                    <option value="{{$item->id}}" 
                                        @foreach ($admin->branchs as $itemType)
                                            {{$itemType->id == $item->id ? 'selected' : ''}}
                                        @endforeach
                                        
                                   >{{ucwords(trans($item->branch_name))}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="username">Back Date Entry Days </label>
                                <input type="text" class="form-control" id="back_date_entry_days" name="back_date_entry_days" placeholder="Enter Back Date Entry Days" value="{{$admin->back_date_entry_days}}">
                            </div>
                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6" style="display:flex">
                                <p style="padding-right: 10px;line-height: 3;"><b> Holiday Login </b><span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="holiday_login" value="1" <?php if($admin->holiday_login=="1") {echo "checked";} ?>>
                                    <label class="form-check-label" for="holiday_login">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="holiday_login" value="0" <?php if($admin->holiday_login=="0") {echo "checked";} ?>>
                                    <label class="form-check-label" for="holiday_login">No</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 " style="display:flex">
                            <p style="padding-right: 10px;line-height: 3;"><b>User Active </b><span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_active" value="1"  <?php if($admin->user_active=="1") {echo "checked";} ?>>
                                    <label class="form-check-label" for="user_active">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_active" value="0" <?php if($admin->user_active=="0") {echo "checked";} ?>>
                                    <label class="form-check-label" for="user_active">No</label>
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Edit User</button>
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
</script>
@endsection