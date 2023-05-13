
@extends('backend.layouts.master')

@section('title')
Profile Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="../../../../../public/backend/assets/css/issue.css" rel="stylesheet" />

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
                <h4 class="page-title pull-left">Company Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Company Profile</span></li>
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
    <div class="row" >
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h4 class="header-title">Company's Profile </h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.company.store') }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Company Website<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="company_website" name="company_website" placeholder="Enter Your Website" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Company name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Short Name</label>
                                <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Enter Short Name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Company Email <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Mobile Number<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Landline Number</label>
                                <input type="text" class="form-control" id="landline_no" name="landline_no" placeholder="Enter Landline no.">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">About Company</label>
                                <textarea id="summernote" name="about_company" class="form-control" placeholder="Enter about company"></textarea>
                                <!-- <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"> -->
                            </div>
                        </div>

                        <h4 class="header-title">Company's Details </h4>

                        <div class="form-row">
                            <div class="form-group col-md-9 col-sm-12">
                                <label for="name">Address <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <textarea id="summernote" name="address" class="form-control" placeholder="Enter Address" style="resize:none;" rows="2" required></textarea>
                                <!-- <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address"> -->
                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="name">City <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" style="height:8vh;" required>
                            </div>


                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">State<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required>
                            </div>
                        <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Pin code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Country<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="contry" name="contry" placeholder="Enter Country" required>
                            </div>
                        </div>

                        <h4 class="header-title">Business's Details </h4>

                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="category">Category</label>
                                <!-- <input type="text" class="form-control" id="state" name="state" placeholder="Enter State"> -->
                                <select name="category" id="category" class="form-control">
                                    <option value="Limited By Shares">Limited By Shares</option>
                                    <option value="Limited By Guarentee">Limited By Guarentee</option>
                                    <option value="Unlimited Company">Unlimited Company</option>

                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="category">Company Class<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="state" name="state" placeholder="Enter State"> -->
                                <select name="company_class" id="company_class" class="form-control" required>
                                <option value="">Choose company class</option>

                                    <option value="Public Limited Company">Public Limited Company</option>
                                    <option value="Association of Persons">Association of Persons</option>
                                    <option value="Partnership Firm">Partnership Firm</option>

                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">CIN Number</label>
                                <input type="text" class="form-control" id="cin_no" name="cin_no" placeholder="Enter CIN NO.">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">PAN Number</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter PAN No.">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">TAN Number</label>
                                <input type="text" class="form-control" id="tan_no" name="tan_no" placeholder="Enter TAN No.">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">GST Number</label>
                                <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Enter GST No.">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Incorporation Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="incorporation_date" name="incorporation_date" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Incorporation State<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="incorporation_state" name="incorporation_state" placeholder="Enter Incorporation State" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="name">Incorporation Country<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="incorporation_country" name="incorporation_country" placeholder="Enter Incorporation Country" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Authorized Capital</label>
                                <input type="number" class="form-control" id="authorized_capital" name="authorized_capital" >
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Paid-up Capital</label>
                                <input type="number" class="form-control" id="paid_ip_capital" name="paid_ip_capital" >
                            </div>

                        </div>

                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Create Company </button>
                        <a class="btn btn-danger" href="{{route('admin.company.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

<script>
  $('#form').parsley();
</script>
@endsection
