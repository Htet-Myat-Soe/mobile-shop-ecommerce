<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                @foreach ($contacts as $contact)
                    <div class="card my-3">
                        <div class="card-header">
                            <h3>{{$contact->name}}</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$contact->comment}} <br>
                                <strong>{{$contact->email}}</strong> <br>
                                <strong>{{$contact->phone}}</strong>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
