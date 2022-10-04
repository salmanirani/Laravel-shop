<div class="alert alert-danger" align="center">
    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
