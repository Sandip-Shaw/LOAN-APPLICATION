
@extends('backend.layouts.master')

@section('title')
Upload Document - Admin Panel
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
                <h4 class="page-title pull-left">Business Application Documents</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Business Application Documents</span></li>
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
                    <!-- <h4 class="header-title"> Create Company's Branch </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.uploaded_doc')}}" method="post" enctype="multipart/form-data" id="form"  data-parsley-validate>
                        @csrf
                        @method('PATCH')
                      <div class="col-xs-12 col-md-11 col-md-offset-1">
                        <div class="container1">
                            <a class="add_form_field" style="color:blue; cursor: pointer;">Add More Document &nbsp; 
                                <span style="font-size:16px; font-weight:bold;">+ </span>
                            </a>
                            <!-- <div><input type="text" name="mytext[]"></div> -->
                        </div>
                        <input type="hidden" name="loan_id" value="{{$loan_application->loanApplication_id}}">
                      </div>

                                           
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Upload</button>
                        <a class="btn btn-danger" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="parsley.min.js"></script>

<!-- <script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script> -->

<script>
  $('#form').parsley();
</script>
<script>
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input type="text" name="doc_name[]"  placeholder="Enter Document Name"/> <input type="file" name="doc_file[]" /> <a href="#" class="delete">Delete</a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});

</script>

@endsection