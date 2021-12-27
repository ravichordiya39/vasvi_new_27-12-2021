@if(Session::has('error'))
    <script type="text/javascript">
        swal({
            title: "Error",
            text: "{{{ Session::get('error') }}}",
            type: "error",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            title: "Success",
            text: "{{{ Session::get('success') }}}",
            type: "success",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif
@if(Session::has('warning'))
    <script type="text/javascript">
        swal({
            title: "Warning",
            text: "{{{ Session::get('warning') }}}",
            type: "warning",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif