<!-- Javascript -->
<script src="{{asset('assets/backend/bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('assets/backend/bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('assets/backend/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('assets/backend/bundles/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
<script src="{{asset('assets/backend/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob-->

<script src="{{asset('assets/backend/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('assets/backend/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/backend/js/pages/tables/jquery-dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/js/index8.js')}}"></script>

<!-- Summernote Plugin -->
<script src="{{asset('assets/backend/vendor/summernote/dist/summernote.js')}}"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
</script>

<script>
    setTimeout(function () {
        $('#alert').slideUp();
    }, 4000);

</script>

@yield('scripts')