@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Admin Panel
@endsection
@section('styles')
    <style>
        .bg_img {
            position: absolute;
            height: 100vh;
            top: 0;
            left: 0;
            width: 100%;
            object-fit: fill;
        }

        .bg-glass {
            background-color: #ffffff4d !important;
            backdrop-filter: saturate(200%) blur(5px);
            z-index: 100;
        }

        .login-box {
            position: absolute;
            right: 70px;
            top: 0px;
        }

        .login-box form label {
            color: black;
        }

        .details {
            display: flex;
            flex-direction: row;
            margin-top: 12px;
        }

        .details img,
        h2 {
            z-index: 1000;
            margin-left: 12px;
        }

        .details h2 {

            font-size: 26px;

            margin-right: 32px;
            align-content: right;
            text-align: right;
        }

        .details i {
            z-index: 100;
            font-size: 26px;
            margin-right: 10px;
            margin-top: 4px;
            margin-right: -3px;
        }

        .details .icon {
            margin-left: 354px;
        }

        .company p {
            z-index: 100;

            position: absolute;
            top: 387px;
            left: 228px;
            font-size: 97px;
            color: red;
            font-weight: 500;
            text-shadow: 1px 1px 0 #000, 2px 2px 0 #000, 3px 3px 0 #000;
            /* transition: all 0.3s ease-in-out; */
        }


        /* .company p:hover {
                text-shadow: none;
                color: red;
                transform: rotateY(360deg);
                text-shadow: 1px 1px 0 #000, 2px 2px 0 #000, 3px 3px 0 #000;
            } */

        .login-form-head {
            background: white;
            height: 1vh;
        }

        .login-form-head h4,
        .login-form-head p {
            text-align: left;
            color: black
        }

        .login-form-body {
            color: black;
            background: white;
        }

        #form_submit {
            background: #FF18E8;
            color: white;
            font-size: 22px;
        }

        .login-box .remember {
            border: 1px solid black;
        }
    </style>
@endsection
@section('auth-content')
    <!-- login area start -->

    <section style="h-auto w-auto" id="bg">
        <img src="{{ asset('login_background.png') }}" class="bg_img" alt="">
        <div class="details">
            <img src="{{ asset('logo.png') }}" alt="">
            <i class="fa fa-phone icon" aria-hidden="true"></i>
            <h2>Help Line : +917001905055</h2>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <h2>Email : customercare@boundparivar.com</h2>
        </div>
        <div class="company">
            <p>Boundparivar</p>
        </div>
        <div class="login-area">
            <div class="container">
                <div class="login-box ptb--100 ">

                    <form method="POST" action="{{ route('admin.login.submit') }}" class="bg-glass">
                        @csrf
                        <div class="login-form-head">
                            <h4>Sign In</h4>
                            <p>Hello User, Sign in and start managing your Admin Panel</p>
                        </div>
                        <div class="login-form-body">
                            @include('backend.layouts.partials.messages')
                            <div class="form-gp">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" id="exampleInputEmail1" name="email">
                                <i class="ti-email"></i>
                                <div class="text-danger"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-gp">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" id="exampleInputPassword1" name="password">
                                <i class="ti-lock"></i>
                                <div class="text-danger"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input remember"
                                            id="customControlAutosizing" name="remember">
                                        <label class="custom-control-label text-black"
                                            for="customControlAutosizing">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="submit-btn-area">
                                <button id="form_submit" type="submit">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- login area end -->
@endsection
