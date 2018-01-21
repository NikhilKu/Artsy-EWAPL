@if(count($errors) > 0)
@foreach($errors->all() as $error)
<script>
    new Noty({
        type: 'error',
        layout: 'topRight',
        text: '{{$error}}'
    }).show();</script>
@endforeach
@endif

@if(session('success'))
<script>
    new Noty({
        type: 'success',
        layout: 'topRight',
        text: '{{session('success')}}'
    }).show();</script>
@endif

@if(session('error'))
<script>
    new Noty({
        type: 'error',
        layout: 'topRight',
        text: '{{session('error')}}'
    }).show();</script>
@endif

