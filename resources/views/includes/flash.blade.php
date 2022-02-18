@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">{{$message }}</div>
@endif

@if ($message = Session::get('danger'))
<div class="alert alert-danger">{{$message }}</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning">{{$message }}</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info">{{$message }}</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <ul>
            <li>{{ $error }}</li>
        </ul>
    @endforeach
</div>
@endif
