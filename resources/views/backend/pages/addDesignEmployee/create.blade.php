
@extends('backend.layouts.master')

@section('title')
EMI Payout - Admin Panel
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
                <h4 class="page-title pull-left">Designation </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Add Designation</span></li>
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
        <div class="col-md-12">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.add_designation.store') }}" method="post" data-parsley-validate>
                        @csrf
                        
                         
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="text-align: left" for="" ><b> Designation Name </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-3">
                                <input type="text" class="form-control" id="designation_name" name="designation_name"  required>
                                
                                </div>
                                <div style="text-align: right">
                                <button type="button" class="btn btn-primary  pr-4 pl-4 btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Save</button>
                                <a class="btn btn-danger btn-sm" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>

                            </div>
                            </div>

 

                            
                             <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
            
                                        <div class="modal-body">
                                                Are you sure to Save?
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                                        </div>
                        </form>
                                    </div>
                                </div>
                            </div>
        <!-- end modal -->
          
                </div>
            </div>
        </div>
        

                                 
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

<script>
  $('#form').parsley();
</script>

@endsection
