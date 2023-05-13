
<style>
    .user-info {
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .user-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-info h2 {
        font-size: 18px;
        margin-left: 12px;
        color: white;
    }
    .user-profile{
      padding: 15px 26px !important;
    }
    .dd-cont{
        display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-bottom: 1px solid #8914fe;
    }
    .dd-bottom{
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 5px 5px;
    }
    .user-profile .dropdown-menu a {
    display: inline-flex;
    padding: 0;
    color: #8a8a8a;
    letter-spacing: 0;
    font-weight: 500;
    
}
.dropdown-menu{
   padding: 1rem; 
   width: 17rem;
}
@media (min-width: 240px) and (max-width: 479px){
.user-profile .dropdown-menu {
    width: 100%;
    right: 76px !important;
    padding: 10px;
}
}
.bars{
    display: none;
}
@media screen and (max-width: 576px) {
    .bars{
        display: inline-flex;
    }
    .user-profile h4{
      display: none;
    }
    .user-profile{
        background: #fff;
    }
}
</style>
<div class="user-profile pull-right">
    <svg class="user-name dropdown-toggle row align-items-center bars" data-toggle="dropdown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20px" width="20px"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
    {{-- <img class="avatar user-thumb" src="{{ asset('backend/assets/images/author/avatar.png') }}" alt="avatar"> --}}
    <h4 class="user-name dropdown-toggle row align-items-center" data-toggle="dropdown">
    <svg class="user-box" xmlns="http://www.w3.org/2000/svg" height="26px" width="44px" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
        {{ Auth::guard('admin')->user()->name }}
        {{-- <i class="fa fa-angle-down"></i> --}}
    </h4>
    <div class="dropdown-menu" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <div class="dd-cont">
          <svg xmlns="http://www.w3.org/2000/svg" height="26px" width="44px" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
          <h5 style="margin-top: 10px;">{{ Auth::guard('admin')->user()->name }}</h5>
          <p>User since 2021</p>
        </div>
        <div class="dd-bottom">
         <a href="" class="" >Account</a>
         <a class=""  href="{{ route('admin.logout.submit') }}"
            onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();">Log
            Out</a>
        </div>
        
    </div>

    <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
