@extends('main')

@section('title', 'Login page - Rooms Equipment Monitoring System')

@section('style')

<style>
    body {
        margin: 0px;
    }

    body::after {
        content: "";
        background-image: url('{{ URL::to('/') }}/images/bg.jpg');
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 100%;
        opacity: 0.7;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
    }

    .background {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /* 
http://jsfiddle.net/6KaMy/1/
is there a better way than the absolute positioning and negative margin.
It has the problem that the content will  will be cut on top if the window is smalller than the content.
*/

    .content {
        width: 400px;
        height: 700px;

        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;

        max-width: 100%;
        max-height: 100%;
        overflow: auto;
    }

    h1, hr, a {
        color: #fff;
        border-color: #fff;
    }

    #error {
        color: #FFFFFF;
        text-shadow: 2px 2px 2px red;
    }

    img {
        width: 300px;
        margin-left: 40px;
        margin-bottom: -70px;
        margin-top: -80px;
    }

</style>

@endsection

@section('content')
<div class="background">
    <div class="content">
        <img src="{{ URL::to('/')}}/images/logo.png" />
        <div class="text-center">
            <h1 class="h4 mb-4">Please login to proceed</h1>
        </div>

        <form class="user" method="post" action="{{ route('login') }}">
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user" placeholder="Email Adress">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
            </div>
            
            <?php
                if (session('error')) {
            ?>
                    <div id="error"><p class="small">{{ session('error') }}</p></div>
            <?php } ?>

            <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
                </button>

            @csrf
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="forgot-password.html">Forgot Password?</a>
        </div>
    </div>
</div>
@endsection
