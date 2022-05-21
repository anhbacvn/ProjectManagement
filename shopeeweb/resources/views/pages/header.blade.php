<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('fontend/css/loading-css.css')}}" rel="stylesheet">
    <script src="{{asset('fontend/js/loading-js.js')}}"></script>
    <link href="{{asset('fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('fontend/css/responsive.css')}}" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{asset('fontend/css/sweetalert.css')}}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- <link rel="shortcut icon" href="{{asset('fontend/images/ico/favicon.ico')}}"> -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('fontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('fontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('fontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('fontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <!-- Css giỏ hàng trống -->
    <style>
        .content {
            text-align: center;
            padding: 80px 0;
        }

        .img__nocart {
            width: 100px;
            object-fit: cover;
        }

        .btn__order {
            cursor: pointer;
            border-radius: 12px;
            border-color: #ccc;
            background: #fdd200;
            padding: 10px 25px;
            border: none;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .btn__order:hover {
            background: #f7d636;
        }
    </style>

    <!-- CSS payment_success -->
    <style>
        .content {
            text-align: center;
            padding: 0;
        }

        .img_success {
            width: 70px;
            margin-top: 30px;
        }

        .title {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: rgba(0, 0, 0, 0.8);
        }

        .transaction__id {
            font-size: 1.2rem;
            margin-top: -10px;
            color: rgb(99, 96, 96);
        }

        .table__product {
            margin: 0 auto 20px;
            width: 800px;
            border-spacing: 0px;
            border: 1px solid #ccc;
        }

        .table__product>thead {
            background-color: #eee;
        }

        .table__product>thead th,
        .table__product>tbody td {
            height: 40px;
        }

        .table__product>tbody td {
            border-bottom: 1px solid #ccc;
        }

        .table__product>tbody tr:last-child td {
            border: none;
        }

        .btn__success {
            margin-top: 30px;
            cursor: pointer;
            border-bottom: 1px px solid #eaeaea;
        }

        .btn__home-back {
            margin-right: 20px;
            border-color: #ccc;
            border-radius: 12px;
            cursor: pointer;
            padding: 10px 25px;
            border: none;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .btn__home-back:hover {
            background: rgb(250, 241, 241);
        }



        .btn__show-order {
            cursor: pointer;
            border-radius: 12px;
            border-color: #ccc;
            background: #fdd200;
            padding: 10px 25px;
            border: none;
            text-transform: uppercase;
        }

        .btn__show-order:hover {
            background: #f7d636;
        }

        .fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 99999;
            background-color: white;
        }
    </style>
</head>
<!--/head-->

<body>
    <div id="thongbao"></div>