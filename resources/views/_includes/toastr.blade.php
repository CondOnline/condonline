<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if (Session::has('toastr'))
        @foreach(Session::get('toastr') as $toastr)

            @switch($toastr['type'])
                @case('error')
                    toastr.error('{{ $toastr['message'] }}', '@if(isset($toastr["title"])) {{ $toastr["title"] }} @endif', @if(isset($toastr['important']) && $toastr['important'] == true) { timeOut: 0, extendedTimeOut: 0 } @endif);
                @break
                @case('warning')
                    toastr.warning('{{ $toastr['message'] }}', '@if(isset($toastr["title"])) {{ $toastr["title"] }} @endif', @if(isset($toastr['important']) && $toastr['important'] == true) { timeOut: 0, extendedTimeOut: 0 } @endif);
                @break
                @case('info')
                    toastr.info('{{ $toastr['message'] }}', '@if(isset($toastr["title"])) {{ $toastr["title"] }} @endif', @if(isset($toastr['important']) && $toastr['important'] == true) { timeOut: 0, extendedTimeOut: 0 } @endif);
                @break
                @case('success')
                    toastr.success('{{ $toastr['message'] }}', '@if(isset($toastr["title"])) {{ $toastr["title"] }} @endif', @if(isset($toastr['important']) && $toastr['important'] == true) { timeOut: 0, extendedTimeOut: 0 } @endif);
                @break
            @endswitch

        @endforeach
    @endif


</script>
