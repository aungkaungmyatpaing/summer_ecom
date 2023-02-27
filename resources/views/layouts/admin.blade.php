<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') || {{ config('app.name', 'Laravel') }}</title>

          <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Majestic Admin</title>
                <!-- plugins:css -->
                <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
                <link rel="stylesheet" href="{{asset('admin/vendors/base/vendor.bundle.base.css')}}">
                <!-- endinject -->
                <!-- plugin css for this page -->
                <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
                <!-- End plugin css for this page -->
                <!-- inject:css -->
                <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
                <!-- endinject -->
                <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" />

        <!-- Scripts -->
   <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <style>
            .form-control{
                border: 1px solid #ddd;
            }
            .sidebar .nav .nav-item.active{
                background-color: #e9e9e9;
            }
        </style>


    </head>
    <body class="font-sans antialiased">
        <div class="container-scroller">
        @include('layouts.inc.admin.navbar')
             <div class="container-fluid page-body-wrapper">
                @include('layouts.inc.admin.sidebar')
                    <div class="main-panel">
                        <div class="content-wrapper">
                            @yield('content')
                        </div>
                    </div>
            </div>      
        </div>


        <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
        
        
        <script src="{{asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
        <script src="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
        
        <script src="{{asset('admin/js/off-canvas.js')}}"></script>
        <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('admin/js/template.js')}}"></script>

          <!-- Custom js for this page-->
        <script src="{{asset('admin/js/dashboard.js')}}"></script>
        <script src="{{asset('admin/js/data-table.js')}}"></script>
        <script src="{{asset('admin/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('admin/js/dataTables.bootstrap4.js')}}"></script>
        <!-- End custom js for this page-->

        <script src="/plugins/jquery/jquery.min.js"></script>

        @stack('scripts')


    </body>
</html>