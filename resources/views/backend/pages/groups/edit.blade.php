
@extends('backend.layouts.master')

@section('title')
Branch Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<style>
    .form-control-sm {
        width: 50px !important;
    }
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
                <h4 class="page-title pull-left">Group Master</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Group Master</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
        @include('backend.layouts.partials.messages')
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-------------- Group Details ------------>
        <div class="col-md-6 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                <h4 class="header-title">Group Details</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.groups.update', $group->id)}}" method="POST" id="form" enctype="multipart/form-data" data-parsley-validate>
                    @method('PUT')    
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="group_name">Group Name<span style="color:red; font-size: 18px;line-height:1; display: inline_block">*</span></label>
                                <input type="text" class="form-control" id="group_name" name="group_name" value="{{ $group->group_name }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="op_date">Op Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="op_date" name="op_date" value="{{ $group->op_date }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="group_branch">Group Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="group_branch" id="group_branch" class="form-control" required>
                                    <option value="">Select Branch</option>

                                    @foreach($allbranch as $groupbranch)
                                        <option value="{{$groupbranch->branch_name}}" >{{$groupbranch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="group_leader_name">Group Leader Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="group_leader_name" name="group_leader_name" value="{{ $group->group_leader_name }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="mobile_no">Mobile No<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ $group->mobile_no }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="group_address">Group Address<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="group_address" name="group_address" value="{{ $group->group_address }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="assign_employee">Assign Employee<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="assign_employee" id="assign_employee" class="form-control" required>

                                <option value="">Select Employee</option>

                                @foreach($employee as $assign_employee)
                                    <option value="{{$assign_employee->emp_code}}" >{{$assign_employee->emp_code}} - {{$assign_employee->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="collection_day">Collection Day<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="collection_day" id="collection_day" class="form-control" required>
                                    <option value="Monday" {{$group->collection_day=='Monday'?'selected':''}}>Monday</option>
                                    <option value="Tuesday" {{$group->collection_day=='Tuesday'?'selected':''}}>Tuesday</option>
                                    <option value="Wednesday" {{$group->collection_day=='Wednesday'?'selected':''}}>Wednesday</option>
                                    <option value="Thursday" {{$group->collection_day=='Thursday'?'selected':''}}>Thursday</option>
                                    <option value="Friday" {{$group->collection_day=='Friday'?'selected':''}}>Friday</option>
                                    <option value="Saturday" {{$group->collection_day=='Saturday'?'selected':''}}>Saturday</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="collection_time">Collection Time<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="time" class="form-control" id="collection_time" name="collection_time" value="{{ $group->collection_time }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="group_photo">Group Photo</label>
                                <input type="file" name="group_photo" class="" id="group_photo"/> 
                                @if(isset($group))
                                    <img src="{{asset('/images/Group_photo/'.$group->group_photo)}}" width="80">
                                @endif 
                            </div> 

                            <div class="form-group col-md-12">
                                <label for="group_photo" class="control-label">Leader Photo</label>
                                <input type="file" name="leader_photo" class="" id="leader_photo"/>  
                                @if(isset($group))
                                    <img src="{{asset('/images/Leader_photo/'.$group->leader_photo)}}" width="80">
                                @endif 
                            </div> 
                        </div> 
                        

                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update Group</button>
                        <a class="btn btn-danger" href="{{route('admin.groups.index')}}"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Add New Group</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <!-------------- End Of Group Details ------------>

        <!-------------- Group Member Link------------>

        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Group Member Link</h4>
                    <!-- @include('backend.layouts.partials.messages') -->

                    <form action="{{url('admin/member-update', $group->id)}}" method="post" data-parsley-validate>
                    
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="search_by_member">Search By Member<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="search_by_member" id="search_by_member" class="form-control" required>
                                    <option value=""></option>

                                    @foreach($members as $member)
                                    <option value="{{$member->member_id}}" >{{$member->member_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="member_name">Member Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="member_name" name="member_name" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="relative_details">Relative Details<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="relative_details" name="relative_details" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label  for="mobile">Mobile<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="previous_loan">Previous Loan<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="previous_loan" name="previous_loan" placeholder="" disabled>
                            </div>
                        </div>


                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4">Add to Queue</button>
                        
                        </div>
                    </form>

                </div>
            </div>

            <!-------------- Group Member Table------------>

            <div class="card mt-5">
                <div class="card-body">
                <h4 class="header-title">Group Member Table</h4>
                <div class="clearfix"></div>
                    <div class="data-tables">
                        <table style=" width: 100%" id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Member Code</th>
                                    <th>Member Name</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member_table as $membertable)
                                <tr>
                                    <td>{{$membertable->member_id}}</td>
                                    <td>{{$membertable->first_name}}</td>
                                    <td>{{$membertable->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
</div>




@endsection

@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->

<!-- <script src="jquery.js"></script>
<script src="parsley.min.js"></script> -->

<!-- <script>
    $(document).ready(function() {
        $('.select2').select2();
    })

</script> -->

<!-- <script>
  $('#form').parsley();
</script> -->

@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
     <!-- <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script> -->
<script>
    const $selectbranch = document.querySelector('#group_branch');
    $selectbranch.value = "{{$groupbranch->branch_name}}"

    const $selectemp = document.querySelector('#assign_employee');
    $selectemp.value = "{{$assign_employee->emp_code}}"

    $(document).ready(function(){
        $("#search_by_member").change(function(){
            var id=$(this).find(":selected").val();
            //console.log(id);
        
            $.ajax({
                    type:"GET",
                    url:"../../member_details/"+id,
                    success:function(res){  
                       // console.log(res);
                    
                    if(res){
                    
                        const obj = JSON.parse(res);
                        console.log(obj);   
                        document.getElementById("member_name").value = obj.first_name;
                        document.getElementById("relative_details").value = obj.nominee_name;
                        document.getElementById("mobile").value = obj.mobile;
                        document.getElementById("previous_loan").value = "0";

                    }
                }
            })
        })
    })

</script>
@endsection