@if(Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {!! Session::get('error_message') !!}
    </div>
@endif
@if(Session::has('success_message'))
    <div class="alert alert-success" role="alert">
        {!! Session::get('success_message') !!}
    </div>
@endif
@if(Session::has('warning_message'))
    <div class="alert alert-warning" role="alert">
        {!! Session::get('warning_message') !!}
    </div>
@endif
@push('js')
    <script>
        $(document).ready(function (){
            $('.alert').alert();
        });
    </script>
@endpush
