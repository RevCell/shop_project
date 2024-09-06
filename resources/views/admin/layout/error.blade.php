@if(count($errors->all())>0)
    <div class="alert alert-danger text-center">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
