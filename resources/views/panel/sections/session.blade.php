@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success" role="alert">
        <span class="alert-inner--text">{{session()->get('success')}}</span>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        <span class="alert-inner--text">{{session()->get('error')}}</span>
    </div>
@endif
