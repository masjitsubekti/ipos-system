<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/custom.style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/all/sort-table/sort-table.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}"> --}}
  <!-- endinject -->  
  <!-- Plugin css for this page -->
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}"> --}}
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style-orig.css') }}"> --}}
  <!-- endinject -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  @yield('css')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts/header')
    <div class="page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts/sidebar')
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')
      </div>
    </div>
  </div>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  {{-- <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script> --}}

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/all/sort-table/sort-table.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script> --}}
  <!-- End custom js for this page-->
  @yield('js')
</body>
</html>

