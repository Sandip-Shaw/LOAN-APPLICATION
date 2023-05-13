
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
                    <li><span> Attendence of Employee</span></li>
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
                    <h4 class="header-title float-left">Attendence List</h4>        
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.attendence.create') }}">Create Attendence</a>
                    </p>
                        <form action="{{route('admin.attendence.index')}}">
                            <div class="form-inline col-md-12">
                                <label for="" ><b> Select Month Year :</b></label>&nbsp;

                                <input type="month" class="form-control" id="month_year" name="month_year" value="{{ \Carbon\Carbon::now()->format('Y-m') }}" required>&nbsp; &nbsp;
                                <button type="submit" class="btn btn-primary">Submit</button>
                                
                            </div> 

                        </form>

                    <p class="float-right mb-2">
                        <!-- <a class="btn btn-primary text-white" href="{{ route('admin.add_designation.create') }}">Create New Designation</a> -->
                    </p>
                    <div class="clearfix"></div>
                    <div class="container" style="padding-right: 100px;">
                        <div class="row">
                    <div class="data-tables pt-5 col-md-12">
                    
                        <table id="dataTable" class="table table-bordered">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="10%">Emp Code</th>
                                    
                                    <th width="10%">Emp Name</th>
                                    
                                    
                                    <?php
                                        for($th = 0; $th < 31; $th++){
                                           
                                            echo "<th>".($th+1)."</th>";
                                        }
                                    ?>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @php 
                                        use App\Helpers\Helper;
                            @endphp

                                @foreach($emp_attendence as $attendences) 
                                    @foreach($attendences as $key=>$employee)

                                    @php 
                                        $empdet = Helper::getEmpName($key);
                                    @endphp
                                    <tr>
                                    <td>{{$empdet["emp_code"]}}</td>
                                    <td>{{$empdet["emp_name"]}}</td>

                                            
                                           <?php
                                           for($th = 1; $th <= 31; $th++){
                                            $f=0;
                                            $s=0;
                                            ?>
                                                
                                                @foreach($employee as $atten) 
                                                <?php
                                                   $d = Carbon\Carbon::parse($atten['date'])->format('d');
                                                   if($th==$d)
                                                    {
                                                         echo "<td>".$atten['attendence_type']."</td>";
                                                         $s=1;
                                                    }
                                                    else{
                                                        $f=1;
                                                    }
                                                ?>
                                                @endforeach      
                                            <?php
                                                if($f==1 && $s==0)
                                                {
                                                    echo "<td>"."-"."</td>";
                                                }
                                             }
                                            ?>
                                            
                                     </tr>
                                    @endforeach
                             @endforeach
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
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