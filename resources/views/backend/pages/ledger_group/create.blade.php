
@extends('backend.layouts.master')

@section('title')
Ledger Group - Admin Panel
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
                <h4 class="page-title pull-left">ADD LEDGER GROUP</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>New Ledger Group</span></li>
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
        <div class="col-md-7">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.ledger_group.store') }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Group Type </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <select name="group_type" id="group_type" class="form-control" required>
                                    <option value="">Please Select </option>
                                    @foreach($group as $groups)
                                    <option value="{{$groups->ledger_types_id}}">{{$groups->types}}</option>
                                   
                                    @endforeach
      
                                </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Display Name </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Enter Group Display Name" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Current Assets)</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>System Name </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="system_name" name="system_name" placeholder="Enter System Name" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Current Assets)</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Weight-age/ Position </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="position" name="position" placeholder="Enter Weight-age/ Position" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Highest - 1. used to sort the groups in while listing)</span>
                                </div>
                            </div>

                            <div class="form-group row"style="display:flex"> 
                                <!-- <p style="padding-right: 10px;line-height: 3;"> Gender <span style="color:red; font-size: 18px;line-height:1">*</span></p> -->
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>System Group </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                                <div class="col-sm-6">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="system_group" value="Yes" >
                                    <label class="form-check-label" for="system_group">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="system_group" value="No" checked>
                                    <label class="form-check-label" for="system_group">No</label>
                                </div>
                                </div>

                            </div>
                            <div style="text-align:center;">

                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Add Group </button>
                                <a class="btn btn-danger" href="{{route('admin.ledger_group.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>


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
                                                Are you sure to add new group?
                                          
                                        </div>
                                        <div class="modal-footer">

                                            <button type="submit" class="btn btn-primary">Add </button>
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

<script>
  $('#form').parsley();
</script>
@endsection
