<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('admin.layouts.head-tag')
</head>

<body class="hold-transition sidebar-mini">
    <section class="wrapper">
        <!-- Navbar Header-->
        @include('admin.layouts.header')
        <!-- /.navbar Header-->

        <!-- Main Sidebar Container -->
        @include('admin.layouts.main-sidebar')
        <!-- /.Main Sidebar Container-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @hasSection('content_header')
            <section class="content-header">
                <div class="container-fluid">
                    @yield('content_header')
                </div>
            </section>
            @endif
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('admin.layouts.control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('admin.layouts.footer')
        <!-- /.Main Footer -->
    </section>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('admin.layouts.scripts')
    <!-- /.REQUIRED SCRIPTS -->
</body>

</html>