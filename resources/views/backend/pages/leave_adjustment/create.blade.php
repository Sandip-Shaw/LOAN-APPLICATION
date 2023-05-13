
@extends('backend.layouts.master')

@section('title')
Leave Master - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

    .upper{
        position: absolute;
        right: 5%;
        top: 43%;
    }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Leave Adjustment </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Leave Adjustment</span></li>
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
                    
                    <form action="{{ route('admin.leave_adjustment.store') }}" method="post" data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                    <label  for="" ><b> Employee Code & Name</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                            
                                    <select name="employee" id="employee" class="form-control " >
                                    <option value="">Select Employee</option>
                                           @foreach($hrmanagements as $hrmanagement)
                                      <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                           @endforeach
                                     </select>

                            </div>
                            <div class="form-group col-md-6 ">
                                 <label  for="" ><b> Joining Date </b></label>
                                  <input type="date" class="form-control" id="doj" name="doj"  readonly>
                            </div>
                        </div>
                         
                       
                        <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" style="text-align: right" for="" ><b> Leave Date </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-4">
                                <input type="date" class="form-control" id="leave_date" name="leave_date"  required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" style="text-align: right" for="" ><b> Purpose </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-4">
                                <!-- <input type="text" class="form-control" id="holiday_date" name="holiday_date"  required> -->
                                <textarea id="summernote" name="purpose" class="form-control" placeholder="Enter Purpose"></textarea> 
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" style="text-align: right" for="" ><b> Leave Type </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-4">
                                <!-- <input type="text" class="form-control" id="holiday_date" name="holiday_date"  required> -->
                                <!-- <textarea id="summernote" name="purpose" class="form-control" placeholder="Enter Purpose"></textarea>  -->
                                  <input type="checkbox" name="leave_type[]" id="sl" value="SL"> SL &nbsp; &nbsp;
                                  <input type="checkbox" name="leave_type[]" id="cl" value="CL"> CL &nbsp; &nbsp;
                                  <input type="checkbox" name="leave_type[]" id="el" value="EL"> EL &nbsp; &nbsp;
                                  <input type="checkbox" name="leave_type[]" id="lop" value="LOP"> LOP

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" style="text-align: right" for="" ><b> Total Leave </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="total_leave" name="total_leave"  required>
                                
                                </div>
                            </div>
                       
                            <div id="leave_det" class="upper" style="width:450px; height: 100%;height: 250px; height: 250px;">

                            </div>
                            <div style="text-align:center;">
                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Save</button>
                                <a class="btn btn-danger" href="{{route('admin.leave_adjustment.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>

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
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Save</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </button>
                
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
    // $(function() {
    //      $('.selectpicker').selectpicker();
    //     });
</script>

<script>
 $(document).ready(function(){
        $("#employee").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../employeeDetails/"+id,
                success:function(res){        
                if(res){
                    const obj = JSON.parse(res);
                    console.log(obj);
                   
                    document.getElementById("doj").value = obj.dateofjoining;
                 
                   
                }
            }
            })
        })
    })



</script>

<script>
    var cl=0;
    var el=0;
    var sl=0;
    
    $(document).ready(function(){
        $("#employee").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../leave-type/"+id,
                success:function(res){   
                    console.log(res);     
                if(res){
                     const obj = (res);
                    
                     $('#leave_det').empty();

                    cl=obj.cl;
                    el=obj.el;
                    sl=obj.sl;


                    trHTML = '<table id="doc_table" style="width:100%;"><tr><td>' + 'CL' + '</td><td>' + obj.cl + '</td></tr> <tr><td>' + 'EL' + '</td><td>' + obj.el + '</td></tr><tr><td>' +
                             'SL' + '</td><td>' + obj.sl + '</td></tr> </table>';
                    
                    $('#leave_det').append(trHTML);

                }
            }
            })
        })
    })

</script>

@endsection
