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
        height: 400px;

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

    .error {
        color: red;
    }

</style>

@endsection

@section('content')
<h1>Successfully logged in.</h1>
@endsection
