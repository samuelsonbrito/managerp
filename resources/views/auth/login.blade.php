@extends('adminlte::login')

@section('css')
    <style>
        body, html {
            height: 100%;
        }

        .bg {
            /* The image used */
            background-image: url("{{url('assets/img/bg-clinica-2.jpg')}}");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
           
        }
    </style>

@endsection