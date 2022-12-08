@extends('template')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php $i = $j = 1; ?>
                        <form class="form needs-validation" action="{{url('/address/'.$address->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row align-items-center mb-0">
                                <label for="name"
                                       class="col-2 control-label col-form-label">Name</label>
                                <div class="col-6 border-left pb-2 pt-2">
                                    <input required type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" value="{{$address->name}}">
                                </div>
                            </div>
                            @foreach($address->emails as $email)
                            <div class="form-group row align-items-center mb-0" id="inputFormEmail">
                                <label for="email"
                                       class="col-2 control-label col-form-label">Email</label>
                                <div class="col-6 border-left pb-2 pt-2 input-group">
                                    <input required type="email" class="form-control" id="email" name="emails[]"
                                           placeholder="Email" value="{{$email->email}}">
                                    @if($i>1)
                                    <div class="input-group-append">
                                        <button id="removeEmail" type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                                <?php $i++; ?>
                            @endforeach
                            <div id="newEmail"></div>
                            <button id="addEmail" type="button" class="btn btn-info mb-3">Add Email</button>

                            @foreach($address->phones as $phone)
                            <div class="form-group row align-items-center mb-0" id="inputFormPhone">
                                <label for="phone"
                                       class="col-2 control-label col-form-label">Phone</label>
                                <div class="col-6 border-left pb-2 pt-2 input-group">
                                    <input required type="text" class="form-control" id="phone" name="phones[]"
                                           placeholder="Phone" value="{{$phone->number}}">
                                    @if($j>1)
                                    <div class="input-group-append">
                                        <button id="removePhone" type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                                <?php $j++; ?>
                            @endforeach

                            <div id="newPhone"></div>
                            <button id="addPhone" type="button" class="btn btn-info mb-3">Add Phone</button>

                            <div class="form-group row align-items-center mb-0">
                                <label for="location"
                                       class="col-2 control-label col-form-label">Location</label>
                                <div class="col-6 border-left pb-2 pt-2">
                                    <input required type="text" class="form-control" id="location" name="location"
                                           placeholder="Location" value="{{$address->location}}">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i
                                        class="fa fa-check"></i>Save</button>
                                <a class="btn btn-outline-dark" role="button"
                                   href="{{url('/')}}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
