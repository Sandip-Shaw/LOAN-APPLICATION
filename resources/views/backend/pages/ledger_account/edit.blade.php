
@extends('backend.layouts.master')

@section('title')
Ledger Account - Admin Panel
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
                <h4 class="page-title pull-left">EDIT LEDGER </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Edit LEDGER</span></li>
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
                    
                    <form action="{{ route('admin.ledger_account.update',$ledger->id) }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Ledger Type </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <select name="ledger_type" id="ledger_type" class="form-control" required>
                                <option value="">Please Select </option>
                                    @foreach($type as $types)
                                        <option value="{{$types->ledger_types_id}}">{{$types->types}}</option>
                                   
                                    @endforeach
      
                                </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Ledger Group </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <select name="ledger_group" id="ledger_group" class="form-control" required>
                                    <option value="">Please Select </option>
                                   
                                </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Name </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{$ledger->name}}" placeholder="Enter Ledger Display Name" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Accumulated Depreciation - Vehicles)</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>System Name </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="system_name" name="system_name" value="{{$ledger->system_name}}" placeholder="Enter Ledger System Name" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Accumulated Depreciation - Vehicles)</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Code </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="code" name="code" value="{{$ledger->code}}" placeholder="Enter code" required>
                                <span style="color:blue; font-size: 12px;">(e.g. 501, XYZ)</span>
                                </div>
                            </div>

                            <div class="form-group row"style="display:flex"> 
                                <!-- <p style="padding-right: 10px;line-height: 3;"> Gender <span style="color:red; font-size: 18px;line-height:1">*</span></p> -->
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Is Bank Account </b></label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_bank_account" value="Yes" <?php if($ledger->is_bank_account=="Yes") {echo "checked";} ?>>
                                    <label class="form-check-label" for="is_bank_account">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_bank_account" value="No" <?php if($ledger->is_bank_account=="No") {echo "checked";} ?>>
                                    <label class="form-check-label" for="is_bank_account">No</label>
                                </div>
                            </div>

                            <div class="form-group row"style="display:flex"> 
                                <!-- <p style="padding-right: 10px;line-height: 3;"> Gender <span style="color:red; font-size: 18px;line-height:1">*</span></p> -->
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Show In Day Book </b></label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="show_in_day_book" value="Yes" <?php if($ledger->show_in_day_book=="Yes") {echo "checked";} ?>>
                                    <label class="form-check-label" for="show_in_day_book">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="show_in_day_book" value="No" <?php if($ledger->show_in_day_book=="No") {echo "checked";} ?>>
                                    <label class="form-check-label" for="show_in_day_book">No</label>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Weight-age/ Position </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="position" name="position" placeholder="Enter Weight-age/ Position" required>
                                <span style="color:blue; font-size: 12px;">(e.g. Highest - 1. used to sort the groups in while listing)</span>
                                </div>
                            </div> -->
                            <div style="text-align:center;">
                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal">Update Account </button>
                                <a class="btn btn-danger" href="{{route('admin.ledger_group.index')}}">Cancel </a>

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
                                                Are you sure to update Ledger Account?
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->


                    
               
    </div>
</div>
        <!-- data table end -->
        
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
<script>
    const $select = document.querySelector('#ledger_type');
    $select.value = "{{$ledger->ledger_type}}"


    $(document).ready(function(){

        // -----------After page loading------------------
        var id=$("#ledger_type").find(":selected").val();
            //console.log(id);
        
            $.ajax({
                    type:"GET",
                    url:"../../group_details/"+id,
                    
                    success:function(res){  
                        console.log(res);
                        
                    if(res){
                        $('#ledger_group').empty();
                    
                        const obj = JSON.parse(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);

                            $('#ledger_group').append(
                                '<option value="'+ `${value.id}` +'">'+ `${value.types}` + " - "+ `${value.display_name}` +'</option>'
                            )
                        });
                    }
                }
            })

            // -----------after ledger type change-------------
        $("#ledger_type").change(function(){
            var id=$("#ledger_type").find(":selected").val();
            //console.log(id);
        
            $.ajax({
                    type:"GET",
                    url:"../../group_details/"+id,
                    
                    success:function(res){  
                        console.log(res);
                        
                    if(res){
                        $('#ledger_group').empty();
                    
                        const obj = JSON.parse(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);

                            $('#ledger_group').append(
                                '<option value="'+ `${value.id}` +'">'+ `${value.types}` + " - "+ `${value.display_name}` +'</option>'
                            )
                        });
                    }
                }
            })
        })
    })
</script>
@endsection
