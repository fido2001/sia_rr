<!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL('/') }}/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL('/') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ URL('/') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ URL('/') }}/assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{ URL('/') }}/assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ URL('/') }}/assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="{{ URL('/') }}/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="{{ URL('/') }}/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL('/') }}/assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    {{-- JS Tambahan --}}
    @stack('custom-js')
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ URL('/') }}/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    {{-- Script tambahan --}}
    @stack('after-js')