
@extends('backend.layouts.master')

@section('title')
Attendence - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Attendence</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Create Attendence </span></li>
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

    <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title">  </h4> -->
                    @include('backend.layouts.partials.messages')
                    <form class="" action="" id="attendence_form">

                    <div class="form-inline col-md-12">
                         <label for="" ><b> Select Month Year :</b></label>&nbsp;

                         <input type="month" class="form-control" id="month_year" name="month_year"  required>&nbsp; &nbsp;
                           
                    </div>
                    <br>
                    <br>
                    <br>

                    <div class="form-inline col-md-12">
                       
                            <label for="" ><b> Employee Code & Name :</b></label>&nbsp;
                            <select name="employee" id="employee" class="form-control " required >
                            <option value="" >Select Employee</option>
                                @foreach($hrmanagements as $hrmanagement)
                                <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                @endforeach
                            </select> &nbsp; &nbsp;&nbsp; &nbsp;

                            <label for="" ><b> Date:</b></label>&nbsp;
                            <input type="date" class="form-control" id="date" name="date"  required>&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="button"  name="FD" class="btn btn-primary  pr-4 pl-4  attendence_type">Full Day (FD) </button>&nbsp;
                            <button type="button" name="HD" class="btn btn-secondary  pr-4 pl-4 attendence_type">Half Day (HD) </button> &nbsp;
                            <!-- <button type="button"  name="CL"class="btn btn-warning  pr-4 pl-4 attendence_type">CL </button>&nbsp;
                            <button type="button" name="SL" class="btn btn-warning  pr-4 pl-4 attendence_type">SL </button>&nbsp;
                            <button type="button" name="EL" class="btn btn-warning  pr-4 pl-4 attendence_type">EL </button> &nbsp; -->
                            <button type="button" name="LOP" class="btn btn-danger  pr-4 pl-4 attendence_type">Loss Of Pay (LOP) </button>

                           
                    </div>
                    </form>
                            
                            <form action="{{route('admin.attendence.store')}}" method="post" style="text-align:right; padding-top: 10px;">
                                @csrf
                                <input type="hidden" name="code_data" id="code_data">
                            
                                <button type="submit" class="btn btn-primary">Submit</button>
                            
                            </form>
                </div>
            </div>
        </div>


       
        
    </div>
</div>
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

     <script>
         /*================================
        datatable active
        ==================================*/
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

$(document).ready(function(){
    let form_buttons = document.getElementsByClassName('attendence_type');
    let form = document.getElementById('attendence_form');
    const formData = {}
       Object.values(form_buttons).forEach((item)=>
        {
            console.log(item);
            item.onclick = (e)=>{
                e.preventDefault()
                formData["buttonName"] = item.name
               // console.log(item.name); // button name
            Object.values(form).forEach((input)=>{
            //console.log(input);
                formData[input.name] = input.value
            }) 
            console.log( formData);
            $('#code_data').val(JSON.stringify(formData));
                
            }
            
        })
    
})

     </script>


@endsection