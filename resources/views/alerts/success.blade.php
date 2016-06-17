@if(Session::has('message-success'))
    <div class="alert alert-success alert-dismissible">
        <h4>
            <strong>
                <i class="glyphicon glyphicon-thumbs-up"></i>
                Solicitação concluída!
            </strong>
        </h4>
        <ul>
            <li>{!! Session::get('message-success') !!}</li>
        </ul>
    </div>
@endif