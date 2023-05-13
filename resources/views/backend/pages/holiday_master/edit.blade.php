
@extends('backend.layouts.master')

@section('title')
Holiday Master - Admin Panel
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
                <h4 class="page-title pull-left">Holiday Master </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Add Holiday</span></li>
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
                    
                    <form action="{{ route('admin.holiday_master.update',$holiday->id) }}" method="post" data-parsley-validate>
                        @csrf
                        @method('PUT')
                        
                         
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Title </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" value="{{$holiday->title}}" required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Holiday Date </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="holiday_date" name="holiday_date"  value="{{$holiday->holiday_date}}" required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Holiday Day </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="holiday_day" name="holiday_day"  value="{{$holiday->holiday_day}}"  required readonly>
                                
                                </div>
                            </div>

 

                            <div style="text-align:center;">
                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal">Update</button>
                                <a class="btn btn-danger" href="{{route('admin.holiday_master.index')}}">Cancel </a>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<script>
    // $(document).ready(function() {
    //     $('.select2').select2();
    // })
</script>

<script>
//   $('#form').parsley();
  $(document).ready(function(){
        $("#holiday_date").change(function(){
            let dt=$(this).val();
           
            const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

            const d = new Date(dt);
            let day = weekday[d.getDay()];
        
            document.getElementById("holiday_day").value = day;
        })
    })
</script>

@endsection
