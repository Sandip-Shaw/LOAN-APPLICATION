
@extends('backend.layouts.master')

@section('title')
Collection Center - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

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
                <h4 class="page-title pull-left">Edit Collection Center</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Collection Center Edit</span></li>
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
                    <h4 class="header-title"> Edit Collection Center </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.collec_branch.update', $collection->id)}}" method="POST" id="form" data-parsley-validate>
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="center_no">Center No<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="center_no" name="center_no" value="{{ $collection->center_no }}" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="branch">Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Select Center Head</option>

                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}" @php if($collection->branch==$branch) echo "selected"; @endphp>{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="center_head">Center Head</label>
                                <select name="center_head" id="center_head" class="form-control" >
                                    <option value="">Select Center Head</option>

                                    <option value="Andhra Pradesh" {{$collection->center_head=='Andhra Pradesh'?'selected':''}}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh" {{$collection->center_head=='Arunachal Pradesh'?'selected':''}}>Arunachal Pradesh</option>
                                    <option value="Assam" {{$collection->center_head=='Assam'?'selected':''}}>Assam</option>
                                    <option value="Bihar" {{$collection->center_head=='Bihar'?'selected':''}}>Bihar</option>
                                    <option value="Chhattisgarh" {{$collection->center_head=='Chhattisgarh'?'selected':''}}>Chhattisgarh</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 ">
                            <label for="center_cashier">Center Cashier</label>
                                <select name="center_cashier" id="center_cashier" class="form-control" >
                                    <option value="">Select Center Head</option>

                                    <option value="Andhra Pradesh" {{$collection->center_cashier=='Andhra Pradesh'?'selected':''}}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh" {{$collection->center_cashier=='Arunachal Pradesh'?'selected':''}}>Arunachal Pradesh</option>
                                    <option value="Assam" {{$collection->center_cashier=='Assam'?'selected':''}}>Assam</option>
                                    <option value="Bihar" {{$collection->center_cashier=='Bihar'?'selected':''}}>Bihar</option>
                                    <option value="Chhattisgarh" {{$collection->center_cashier=='Chhattisgarh'?'selected':''}}>Chhattisgarh</option>
                                </select>
                            </div>
                            
                        </div>
                     

                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="collection_day">Collection Day</label>
                                <input type="text" class="form-control" id="collection_day" name="collection_day" value="{{ $collection->collection_day }}">                               
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="collection_time">Collection Time</label>
                                <input type="text" class="form-control" id="collection_time" name="collection_time" value="{{ $collection->collection_time }}">
                            </div>
                        
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="center_active">Center Active<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                               <select name="center_active" id="center_active" class="form-control" required>
                                   <option value="">Choose Yes or No</option>

                                   <option value="yes" {{$collection->center_active=='yes'?'selected':''}}>YES</option>
                                   <option value="no" {{$collection->center_active=='no'?'selected':''}}>No</option>
                                  
                               </select>
                            </div>
                           
                            <div class="form-group col-md-6">
                                <label for="current_address">Center Address</label>
                                <textarea id="current_address" name="current_address" class="form-control">{{ $collection->current_address }}</textarea>
                            </div>

                        </div>

                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Center's Address GPS Location - 
                        <button type="button" id="get_location" class="btn btn-primary pr-4 pl-4">Get Current Location </button></h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="latitude">Location Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $collection->latitude }}">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="longitude">Location Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $collection->longitude }}">
                            </div>
                           
                        </div>      



                                           
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;Update Collection center</button>
                        <a class="btn btn-danger" href="{{route('admin.collec_branch.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    })


    const btn = document.getElementById("get_location")

btn.addEventListener('click', function () {
    // console.log('clicked');
          //  report(result.state);
       
    navigator.permissions.query({
        name: 'geolocation'
    }).then(function (result) {
        if (result.state == 'granted') {
            // report(result);
            navigator.geolocation.getCurrentPosition((e) =>{

                document.getElementById("latitude").value =e.coords.latitude;
                document.getElementById("longitude").value =e.coords.longitude;
                // ${e.coords.latitude}, ${e.coords.longitude});
            
            })
            // geoBtn.style.display = 'none';
        } else if (result.state == 'prompt') {
            // report(result.state);
            // console.log(document.getElementById('location'));
            navigator.geolocation.getCurrentPosition((e) =>{
            document.getElementById("latitude").value =e.coords.latitude;
                document.getElementById("longitude").value =e.coords.longitude;
            })
        } else if (result.state == 'denied') {
            // report(result.state);
            // geoBtn.style.display = 'inline';
        }
        result.addEventListener('change', function () {
            // report(result.state);
        });
    }); 
});

</script>

<script>
  $('#form').parsley();
</script>
@endsection