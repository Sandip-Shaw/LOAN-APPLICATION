@extends('backend.layouts.master')

@section('title')
    Dashboard Page - Admin Panel
@endsection

<style>
    /* .rowcontainer {
        width: 118%;
    }

    .notificationicon {
        position: absolute;
        top: 39px;
        right: -56px;
    } */
    .card-divs:hover img {
       transform: scale(1.1) translateY(-9px);
       transition: all 0.3s ease-in-out;
    }
    .card-divs img {
        margin-right: 10px;
    }
    
    .fa-angle-down:before {
    display: none;
}
@media (min-width: 240px) and (max-width: 435px){
   .main-cont{
     flex-wrap: wrap !important;
   } 
}
.sel-box{
    background: #dee1e3;
    border: none;
    padding: 10px;
    border-radius: 0.2rem;
}
/* Define the keyframes for the animation */
@keyframes blinker {  
  50% { opacity: 0; }
}

/* Apply the animation to the text */
.blinking-text {
  animation: blinker 1s linear infinite;
  color: red;
}
.toggle-text{
        position: relative;
        animation-name: up-down;
        animation-duration: 2s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        font-size: 2rem;
        color: #8914fe;
        right: 2;
        bottom: 1;
      }
      @keyframes up-down {
         0% {
           transform: translateY(0);
         }
         50% {
           transform: translateY(-2px);
         }
         100% {
           transform: translateY(0);
         }
       }


</style>

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center main-cont" style="flex-wrap: nowrap;">


            <div class="col-md-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 clearfix" style="display: flex;
                align-items: center;
                justify-content: end;
                ">
                <div class="col-md-6 col-sm-4 clearfix ">
                    <ul class="notification-area pull-right notificationicon">
                        <li class="dropdown">
                            <i class="ti-bell dropdown-toggle " data-toggle="dropdown">
                                <span>2</span>
                            </i>
                            <div class="dropdown-menu bell-notify-box notify-box">
                                <span class="notify-title">You have 3 new notifications <a href="#">view
                                        all</a></span>
                                <div class="nofity-list">
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                        <div class="notify-text">
                                            <p>New Commetns On Post</p>
                                            <span>30 Seconds ago</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
                                        <div class="notify-text">
                                            <p>Some special like you</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                    {{-- <a href="#" class="notify-item"> --}}
                                    <a href="#" class="notify-item">
                                        <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                        <div class="notify-text">
                                            <p>You have Changed Your Password</p>
                                            <span>Just Now</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->
    @php
        use App\Helpers\Helper;
    @endphp
    {{ Helper::cashAssetData(2) }}

    <div class="main-content-inner">

     <!-- <div class="row">
         <div class="col-lg-12">
            <div class="row ">
                <div class="col-12 mb-3 d-flex justify-content-end align-items-center">
                 <p style="margin-right: 5px;">Branch: </p>
                 <select name="" id="" class="sel-box">
                    <option value="">All</option>
                    <option value="">Test Brunch kolkata</option>
                 </select>
                 <button class="sel-box" style="margin-left: 10px;">
                  <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px"  viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                 <!--</button>
                </div> -->
               <!-- <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <a href="{{ route('admin.roles.index') }}">
                                    <div class="pr-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon p-4">
                                         <svg xmlns="http://www.w3.org/2000/svg" height="45px" width="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM128 208a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 0a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm96 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>   
                                         <!-- </div>
                                         <div style="color: #fff;">
                                          Sms Balance
                                         </div>
                                        <h2>5024</h2>
                                    </div> -->
                                <!-- </a> -->
                           <!-- </div>
                        </div>
                        
                </div> -->
         <!-- </div>
       </div>  -->
        <div class="row">
             <div class="col-lg-12">
                <div class="row">
                <div class="col-lg-12 mb-3 row justify-content-end align-items-center" style="margin-right: -27px;">
                 <p style="margin-right: 5px;">Branch: </p>
                 <select name="" id="" class="sel-box">
                    <option value="">All</option>
                    <option value="">Test Brunch kolkata</option>
                 </select>
                 <button class="sel-box" style="margin-left: 10px;">
                  <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px"  viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                 </button>
                </div>
                </div>
             </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12">
             <div class="row">
                <div class="col-md-6 col-lg-4 mb-3 card-divs">
                        <div class="card" style="box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                            <div class="seo-fact ">
                                <a href="{{ route('admin.roles.index') }}">
                                    <div class="pr-4 d-flex justify-content-start align-items-center">
                                        <div class="seofct-icon p-4 sbg1">
                                         <!-- <svg xmlns="http://www.w3.org/2000/svg" height="45px" width="40px" viewBox="0 0 512 512"><--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. <path d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM128 208a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm128 0a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm96 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>    -->
                                         <img src="{{asset('2.png')}}" style="height: 45px; width: 40px;" alt="">
                                        </div>
                                        <div class="ml-2">
                                        <h5 style="color: #000;">
                                            SMS BALANCE
                                         </h5>
                                        <div style="color: #000;">5024</div>
                                        </div>
                                        
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card mt-3" style="box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                            <div class="seo-fact ">
                                <a href="{{ route('admin.roles.index') }}">
                                    <div class="pr-4 d-flex justify-content-start align-items-center position-relative">
                                        <div class="seofct-icon p-4 sbg4">
                                            <img src="{{asset('1.png')}}" style="height: 45px; width: 40px;" alt="">
                                           <!-- <svg xmlns="http://www.w3.org/2000/svg" height="45px" width="40px" viewBox="0 0 448 512"><-! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"/></svg>   -->                                      
                                        </div>
                                         <div class="ml-2 ">
                                         <h5 style="color: #000;">
                                           ATTENDANCE
                                         </h5>
                                           <div style="color: #000;">IN TIME :</div>
                                           <div style="color: #000;">OUT TIME :</div>
                                           <div class="toggle-text position-absolute">+</div>
                                         </div>
                                         
                                    </div>
                                </a>
                               </div>
                        </div>
                </div> 


                <div class="col-md-6 col-lg-8 mb-3" >
                        <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                            <div class="seo-fact">
                                
                                    <div class="p-4" style="height: 12.5rem; display: flex !important;justify-content: center !important;">
                                        <h4 style="text-align: center;">Notice Board <span class="blinking-text">**</span></h4>
                                            
                                    </div>
                                    <div style="text-align: center;">
                                            @foreach($notice_board as $notice)
                                                {{$loop->index+1}}.  {{$notice->text}} <br>

                                            @endforeach
                                    </div>
                                    
                            </div>
                        </div>
                       
                </div> 
             </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="row rowcontainer">
                    <div class="col-md-6 col-lg-4 mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <a href="{{ route('admin.roles.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-tasks"></i>--><img src="{{asset('14.png')}}" style="height: 45px; width: 40px;" alt=""> Roles</div>
                                        <h2>{{ $total_roles }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{ route('admin.admins.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-black-tie" aria-hidden="true"></i>--><img src="{{asset('7.png')}}" style="height: 45px; width: 40px;" alt=""> Admins</div>
                                        <h2>{{ $total_admins }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3  card-divs">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><!--<i class="fa fa-asterisk" aria-hidden="true"></i>--><img src="{{asset('6.png')}}" style="height: 45px; width: 40px;" alt=""> Permissions
                                    </div>
                                    <h2>{{ $total_permissions }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{ route('admin.members_management.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-users"></i>--><img src="{{asset('4.png')}}" style="height: 45px; width: 40px;" alt=""> Members</div>
                                        <h2>{{ $members }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <a href="{{ route('admin.comp_branch.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-university"></i>--><img src="{{asset('9.png')}}" style="height: 45px; width: 40px;" alt=""> Branches</div>
                                        <h2>{{ $branchs }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{ route('admin.groups.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-plus-square-o"></i>--><img src="{{asset('13.png')}}" style="height: 45px; width: 40px;" alt=""> Groups</div>
                                        <h2>{{ $groups }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg1">
                                <a href="{{ route('admin.hr_management.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-briefcase" aria-hidden="true"></i>-->
                                        <img src="{{asset('11.png')}}" style="height: 45px; width: 40px;" alt=""> Employees</div>
                                        <h2>{{ $employee }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{ route('admin.loan_appli_accnt.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-money" aria-hidden="true"></i>--><img src="{{asset('10.png')}}" style="height: 45px; width: 40px;" alt=""> Loan
                                            Account</div>
                                        <h2>{{ $loanAccount }}</h2>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <a href="{{ route('admin.ledger_account.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-file-text-o"
                                                aria-hidden="true"></i>--><img src="{{asset('12.png')}}" style="height: 45px; width: 40px;" alt=""> Ledger Accounts</div>
                                        <h2></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg3">
                                <a href="{{ route('admin.ledger_account.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-file-text-o"
                                                aria-hidden="true"></i>--><img src="{{asset('5.png')}}" style="height: 45px; width: 40px;" alt=""> Investment</div>
                                        <h2></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5  mb-3 card-divs">
                        <div class="card">
                            <div class="seo-fact sbg4">
                                <a href="{{ route('admin.ledger_account.index') }}">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><!--<i class="fa fa-file-text-o"
                                                aria-hidden="true"></i>--><img src="{{asset('3.png')}}" style="height: 45px; width: 40px;" alt=""> Business / Other Loans</div>
                                        <h2></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">

                        <div id="accordion">
                            <div class="card" style="width: 91%;margin-top: 5px;">
                                <div class="card-header" style="background-color:#47719b; text-align:center;">
                                    <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseOne">
                                        Cash Book
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse " data-parent="#accordion">
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-details">
                                            <b> Total Balance: {{ $balance->sum('total_amt') }} </b>
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Branch</th>
                                                    <th>Cash Balance</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($balance as $total_bal)
                                                    <tr>
                                                        <!-- <td class="ft-200" style="width: 250px;"></td> -->
                                                        <td>{{ $loop->index + 1 }} </td>
                                                        <td>{{ $total_bal->branch_name }} </td>
                                                        <td>{{ $total_bal->total_amt }} </td>

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">

                        <div id="accordion">
                            <div class="card" style="width: 91%;margin-top: 5px;">
                                <div class="card-header" style="background-color:#47719b;margin-right: 8px; text-align:center;">
                                    <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseTwo">
                                        Bank Balance
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse " data-parent="#accordion">
                                    <div class="card-body">
                                        <table id="dataTable" class="table table-details">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Bank Name</th>
                                                    <th>Bank A/C</th>
                                                    <th> Balance</th>
                                                    <th> Today Bank</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <!-- <td class="ft-200" style="width: 250px;"></td> -->
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
