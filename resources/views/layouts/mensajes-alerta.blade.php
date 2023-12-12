<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('inf'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.info("{{ session('inf') }}");
    @endif


    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.warning("{{ session('warning') }}");
    @endif
    @if (Session::has('status'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.success("{{ session('status') }}");
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.error("{{ $error }}");
        @endforeach

    @endif
</script>
{{--
"toast-top-left"
"toast-top-right"
"toast-top-center"
"toast-top-full-width"
"toast-bottom-left"
"toast-bottom-right"
"toast-bottom-center"
"toast-bottom-full-width"
--}}
