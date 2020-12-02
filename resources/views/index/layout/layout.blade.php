<!DOCTYPE html>
<html>

@include('index.layout.app')

<body class="@yield('body-class')">

<i class="ajax-loader"></i>
@include('index.layout.header')

@include('index.includes.panel')

@yield('content')

@include('index.layout.footer')

<script src="/index/js/libs.min.js"></script>
<script src="/custom/js/custom.js?v=12"></script>

<script>
    @if(isset($error))
    showError('{{$error}}');
    @endif

    @if(isset($message))
    showMessage('{{$message}}');
    @endif

    @if(\Illuminate\Support\Facades\Session::has('message'))
    showMessage('{!! \Illuminate\Support\Facades\Session::get('message') !!}');
    @endif
</script>

@yield('js')

<script type="text/javascript" src="/index/js/common.js"></script>

</body>
</html>
