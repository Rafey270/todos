<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todos - Admin Panel</title>
    <link href="/css/style.default.css" rel="stylesheet">
    <link href="/css/morris.css" rel="stylesheet">
    <link href="/css/select2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    @toastr_css
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
    #infowindow-content .title {
    font-weight: bold;
    }

    #infowindow-content {
    display: none;
    }

    #map #infowindow-content {
    display: inline;
    }
   </style>
</head>

<body>

    {{-- Header --}}
    @include('admin.includes._header')
    <section>
        <!-- mainwrapper -->
        <div class="mainwrapper">

            {{-- Sidebar --}}
            @include('admin.includes._sidebar')

            <!-- mainpanel -->
            <div class="mainpanel">
                @yield('content')
            </div>

        </div>
    </section>
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/modernizr.min.js"></script>
    <script src="/js/pace.min.js"></script>
    <script src="/js/retina.min.js"></script>
    <script src="/js/jquery.cookies.js"></script>
    <script src="/js/flot/jquery.flot.min.js"></script>
    <script src="/js/flot/jquery.flot.resize.min.js"></script>
    <script src="/js/flot/jquery.flot.spline.min.js"></script>
    <script src="/js/jquery.sparkline.min.js"></script>
    <script src="/js/morris.min.js"></script>
    <script src="/js/raphael-2.1.0.min.js"></script>
    <script src="/js/bootstrap-wizard.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>

        jQuery("#select-multi").select2();

        toastr.options = {
            "positionClass": "toast-bottom-right",
            "progressBar" : true,
            "closeButton": true,

        }

        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    @toastr_js
    @toastr_render
    @yield('scripts')
</body>

</html>
