
@extends('backend.layouts.master')

@section('title')
Ledger - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css"
        integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"
      integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<style>
    .editBtn{
        position: absolute;
        top: 10px;
        right: 100px;
        z-index: 100;
    } 
 </style>
 <style>
  /* sryles for drop down input box */
        /* Import Google Font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #4285f4;
        }

        ::selection {
            color: #fff;
            background: #4285f4;
        }

        .wrapper {
            width: 100%;
            margin: 0;
            
        }

        .select-btn,
        li {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .select-btn {
           height: 5vh;
            padding: 0 20px;
            font-size: 11px;
            background: #fff;
            box-sizing: border-box;
            justify-content: space-between;
            border-radius: 0.2rem; 
            border: 0.5px solid #e8e5dc;
        }

        .select-btn i {
            
            transition: transform 0.3s linear;
            
        }

        .wrapper.active .select-btn i {
            transform: rotate(-180deg);
        }

        .content {
            display: none;
            padding: 20px;
            margin-top: 15px;
            background: #fff;
            border-radius: 7px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            position: absolute;
            z-index: 10;
        }

        .wrapper.active .content {
            display: block;
        }

        .content .search {
            position: relative;
        }

        .search i {
            top: 50%;
            left: 15px;
            color: #999;
            font-size: 20px;
            pointer-events: none;
            transform: translateY(-50%);
            position: absolute;
        }

        .search input {
            height: 30px;
            width: 100%;
            outline: none;
            font-size: 13px;
            border-radius: 5px;
            padding: 0 20px 0 43px;
            border: 1px solid #B3B3B3;
        }

        .search input:focus {
            padding-left: 42px;
            border: 2px solid #4285f4;
        }

        .search input::placeholder {
            color: #bfbfbf;
        }

        .content .options {
            margin-top: 10px;
            max-height: 250px;
            overflow-y: auto;
            padding-right: 7px;
        }

        .options::-webkit-scrollbar {
            width: 4px;
        }

        .options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 25px;
        }

        .options::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 25px;
        }

        .options::-webkit-scrollbar-thumb:hover {
            background: #b3b3b3;
        }

        .options li {
            height: 50px;
            padding: 0 13px;
            font-size: 10px;
        }

        .options li:hover,
        li.selected {
            border-radius: 5px;
            background: #f2f2f2;
        }
    </style>

@section('admin-content')

  

    

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Ledger </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.ledger_account.index') }}">Ledger Account</a></li>

                    <li><span>{{$ledger->name}}</span></li>
                    <li><span>--</span></li>

                    <li><span>{{$ledger->system_name}}</span></li>

                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->


<style>
  .input-group {
    margin-right: 3px;
    width: 50%;
  }
  .btn{
    padding: 6px 15px 6px 15px;
   }
  .btn-search {
    margin: 0 !important;
    padding: 0;
  }
  
  .input-group, .row {
    padding: 0 !important; 
  }
  .divider{
    height: 3px;
    width: 13px;
  }
  .form-control .form-control-sm{
    padding: 0.5rem;
  }
  /* input[type="text"] */
  input[type="date"]{
    font-size: 0.9rem;
    padding-left: 1rem;
  }

.select-input {
  height: 38px;
}

</style>

<form class="flex-md-row row flex-column justify-content-center align-items-center my-3" method='get' onsubmit=''>

<div class="col-md-2 col-sm-7  mb-2 col-7 position-relative z-10 mr-1 pr-0">
    <div class="wrapper ">
       <div class="select-btn">
            <span>Branch name..</span>
            <i class="uil uil-angle-down"></i>
        </div>
        <div class="content">
            <div class="search">
                <i class="uil uil-search"></i>
                <input spellcheck="false" type="text" placeholder="Search">
            </div>
            <ul class="options"></ul>
        </div>
    </div>
    <!-- <input type="text" class="form-control form-control-sm" id="search-input" name="search-input" placeholder="Type here..."> -->  
</div>
  <div class="col-md-2 col-sm-7 input-group mb-2 col-7">
    <input type="date" class="form-control form-control-sm" id="sd" name='startdate'>
  </div>
  <div class="bg-dark divider  mx-1 mb-2 "></div>
  <div class="col-md-2 col-sm-7 input-group mb-2 col-7">
    <input type="date" class="form-control form-control-sm" id="ed" name='enddate'>
  </div>
  <div class="col-md-2 btn-search">
    <button class="btn btn-warning btn-sm mb-2 text-white" type='submit'>SEARCH</button>
  </div>

</form>



<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                               
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-12>
                        @include('backend.layouts.partials.messages')
                        <table  class="table table-details ">
                                <thead class="table-primary">
                                        <tr>
                                            <th>CODE</th>
                                            <th>GROUP</th>
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>IS SYSTEM</th>
                                            <th>SHOW IN DB</th>
                                            <th>TYPE</th>
                                            <th>TOTAL T.</th>
                                            <th>LAST T.</th>
                                            <th>T. DEBITS</th>
                                            <th>T. CREDITS</th>
                                            <th>(T.CREDITS -T.DEBITS)</th>
                                            <th>CLOSING BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                </thead>
                        <tbody>
                            <tr>
                                <td>{{$ledger->code}}</td>
                                <td>{{$ledger->ledgergroup->display_name}}</td>
                                <td>{{$ledger->name}}</td>
                                <td>{{$ledger->system_name}}</td>
                                <td><span class="badge badge-info mr-4">{{$ledger->is_bank_account}}</span></td>
                                <td><span class="badge badge-info mr-4">{{$ledger->show_in_day_book}}</span></td>
                                <td>{{$ledger->ledgertype->types}}</td>
                                <td>{{$ledger->total_transaction}}</td>
                                <td></td>
                                <td>{{$ledger->total_debit}}</td>
                                <td>{{$ledger->total_credit}}</td>
                                <td>{{$ledger->debit_credit}}</td>
                                <td>{{$ledger->closing_balance}}</td>
                                <td>
                                <a href="{{ route('admin.ledger_account.edit',$ledger->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                <!-- <button class="btn btn-danger">Re-generate</button> -->
                                </td>


                            </tr>
                        </tbody>
                            
                        </table>
                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
<!-- @php
   use App\Helpers\Helper;
 @endphp
{{ json_encode(Helper::processingFee());}} -->

         <!-- data table start -->
         <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Transaction</h4>
                   
                    <div class="clearfix"></div>
                    <div class="data-tables" style=" display: grid;">
                   
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>BRANCH</th>
                                    <th>DATE</th>
                                    <th>DESCRIPTION</th>
                                    <th>IS SYSTEM</th>
                                    <th>O. BALANCE</th>
                                    <th>DEBIT</th>
                                    <th>CREDIT</th>
                                    <th>C .BALANCE</th>  
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach($entry as $entries)
                                <tr>
                                        <td>{{$entries->ledgerbrnch->branch_name}}</td>
                                        <td></td>
                                        <td>{{$entries->description}}</td>
                                        <td>{{$entries->is_system}}</td>
                                        <td>{{$entries->opening_acc_balance}}</td>
                                        <td></td>
                                        <td>{{$entries->amount}}</td>
                                        <td>{{$entries->closing_acc_balance}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    
     <script>
         /*================================
        datatable active
        ==================================*/

        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script>
<script>
   

   var currentDate = new Date().toISOString().substr(0, 10); // Replace this with your original date
   var firstDayOfMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 1);
   var timezoneOffsetMs = new Date().getTimezoneOffset() * 60000; // Get timezone offset in milliseconds
   var localDate = new Date(firstDayOfMonth.getTime() - timezoneOffsetMs); // Adjust for timezone offset
   var formattedDate = localDate.toISOString().substr(0, 10); // Format date as YYYY-MM-DD
//  console.log(formattedDate);
  //override the default value of input date
  document.getElementById("sd").value = formattedDate;       
  document.getElementById("ed").value = currentDate;       

</script>

     <script>
$(document).ready(function(){
   var ledger_name =  {!! json_encode($ledger->name) !!}
   console.log(ledger_name);
   console.log(formattedDate);
   console.log(currentDate);

    // if( ledger_name == 'Processing Charge'){
    //     $.ajax({
    //         url: "../processing-fee/"+formattedDate+"/"+currentDate,
    //         type: 'GET',
            
    //             success:function(res){  
    //                 //console.log(res);

    //                 if(res.length){
    //                      $('#myTable').empty();
                    
    //                     const obj = (res);
    //                     Object.entries(obj).forEach((entry) => {
    //                         const [key, value] = entry;
    //                         //console.log(`${key}: ${value.created_at}`);
                            
    //                         $('#myTable').append(
    //                             // '<tr><td>' +  +
    //                             '<tr><td>' + `${value.branch_name} ` +
    //                             '</td><td>' + `${value.created_at}` +
    //                             '</td><td>' + `${value.description}` +
    //                             '</td><td>' + `${value.is_system}` +
    //                             '</td><td>' + `${value.obalance}` +
    //                             '</td><td>' + `0` +
    //                             '</td><td>' + `${value.credit}` +
    //                             '</td><td>' + `${value.close_balance}` +
    //                             // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
    //                              '</td></tr>'
                                
    //                         );
    //                        // console.log(value.emi_date);
    //                     });
    //                 }else{
    //                     $('#myTable').empty();

    //                         $('#myTable').append(
    //                             '<tr><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +

    //                                 '</td><td>' + `No Transaction in this Account` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td></tr>'
    //                             );
    //                     }
                   
    //                 }
    //             })

    //         }


    // if( ledger_name == 'INSURANCE CHARGE'){
    //     $.ajax({
    //         url: "../insurance-fee/2022-12-01/2023-03-01",
    //         type: 'GET',
            
    //             success:function(res){  
    //                 //console.log(res);

    //                 if(res.length){
    //                      $('#myTable').empty();
                    
    //                     const obj = (res);
    //                     Object.entries(obj).forEach((entry) => {
    //                         const [key, value] = entry;
    //                         //console.log(`${key}: ${value.created_at}`);
                            
    //                         $('#myTable').append(
    //                             // '<tr><td>' +  +
    //                             '<tr><td>' + `${value.branch_name} ` +
    //                             '</td><td>' + `${value.created_at}` +
    //                             '</td><td>' + `${value.description}` +
    //                             '</td><td>' + `${value.is_system}` +
    //                             '</td><td>' + `${value.obalance}` +
    //                             '</td><td>' + `0` +
    //                             '</td><td>' + `${value.credit}` +
    //                             '</td><td>' + `${value.close_balance}` +
    //                             // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
    //                              '</td></tr>'
                                
    //                         );
    //                        // console.log(value.emi_date);
    //                     });
    //                 }else{
    //                     $('#myTable').empty();

    //                         $('#myTable').append(
    //                             '<tr><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +

    //                                 '</td><td>' + `No Transaction in this Account` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td><td>' + `` +
    //                                 '</td></tr>'
    //                             );
    //                     }
                   
    //                 }
    //             })

    //         }


        // if( ledger_name == 'CHARGES PER EMI'){
        // $.ajax({
        //     url: "../loan-other-charge",
        //     type: 'GET',
            
        //         success:function(res){  
        //             //console.log(res);

        //             if(res.length){
        //                  $('#myTable').empty();
                    
        //                 const obj = (res);
        //                 Object.entries(obj).forEach((entry) => {
        //                     const [key, value] = entry;
        //                     //console.log(`${key}: ${value.created_at}`);
                            
        //                     $('#myTable').append(
        //                         // '<tr><td>' +  +
        //                         '<tr><td>' + `${value.branch_name} ` +
        //                         '</td><td>' + `${value.paid_date}` +
        //                         '</td><td>' + `${value.description}` +
        //                         '</td><td>' + `${value.is_system}` +
        //                         '</td><td>' + `${value.obalance}` +
        //                         '</td><td>' + `0` +
        //                         '</td><td>' + `${value.credit}` +
        //                         '</td><td>' + `${value.close_balance}` +
        //                         // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
        //                          '</td></tr>'
                                
        //                     );
        //                    // console.log(value.emi_date);
        //                 });
        //             }else{
        //                 $('#myTable').empty();

        //                     $('#myTable').append(
        //                         '<tr><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +

        //                             '</td><td>' + `No Transaction in this Account` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td></tr>'
        //                         );
        //                 }
                   
        //             }
        //         })

        //     }

        //     if( ledger_name == 'STAMP DUTY'){
        // $.ajax({
        //     url: "../loan-stamp-fee",
        //     type: 'GET',
            
        //         success:function(res){  
        //             //console.log(res);

        //             if(res.length){
        //                  $('#myTable').empty();
                    
        //                 const obj = (res);
        //                 Object.entries(obj).forEach((entry) => {
        //                     const [key, value] = entry;
        //                     //console.log(`${key}: ${value.created_at}`);
                            
        //                     $('#myTable').append(
        //                         // '<tr><td>' +  +
        //                         '<tr><td>' + `${value.branch_name} ` +
        //                         '</td><td>' + `${value.created_at}` +
        //                         '</td><td>' + `${value.description}` +
        //                         '</td><td>' + `${value.is_system}` +
        //                         '</td><td>' + `${value.obalance}` +
        //                         '</td><td>' + `0` +
        //                         '</td><td>' + `${value.credit}` +
        //                         '</td><td>' + `${value.close_balance}` +
        //                         // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
        //                          '</td></tr>'
                                
        //                     );
        //                    // console.log(value.emi_date);
        //                 });
        //             }else{
        //                 $('#myTable').empty();

        //                     $('#myTable').append(
        //                         '<tr><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +

        //                             '</td><td>' + `No Transaction in this Account` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td><td>' + `` +
        //                             '</td></tr>'
        //                         );
        //                 }
                   
        //             }
        //         })

        //     }
   
         })


        
     </script> 

<script>
  // for drop down auto complete search box
        const wrapper = document.querySelector(".wrapper"),
            selectBtn = wrapper.querySelector(".select-btn"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");

        let countries = ["capital"];

        function addCountry(selectedCountry) {
            options.innerHTML = "";
            countries.forEach(country => {
                let isSelected = country == selectedCountry ? "selected" : "";
                let li = `<li onclick="updateName(this)" class="${isSelected}">${country}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }
        addCountry();

        function updateName(selectedLi) {
            searchInp.value = "";
            addCountry(selectedLi.innerText);
            wrapper.classList.remove("active");
            selectBtn.firstElementChild.innerText = selectedLi.innerText;
        }

        searchInp.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInp.value.toLowerCase();
            arr = countries.filter(data => {
                return data.toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! no match found</p>`;
        });

        selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));
    </script>
@endsection