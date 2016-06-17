@if($errors->all())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <h4>
            <i class="glyphicon glyphicon-exclamation-sign"></i>
            Error
        </h4>
        @foreach($errors->all() as $error)
            <i class="glyphicon glyphicon-remove"></i> {{ $error }}<br>
        @endforeach
    </div>
@endif