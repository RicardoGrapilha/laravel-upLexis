@if(session()->has('message-error'))
    <div class="alert alert-danger alert-dismissible">
        <h4>
            <i class="glyphicon glyphicon-exclamation-sign"></i>
            Error
        </h4>
        <i class="fa fa-exclamation-circle"></i> {!! session()->get('message-error') !!}
    </div>
    <div class="clearfix"></div>
@endif