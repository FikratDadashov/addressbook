@extends('template')
@section('content')
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Address Book</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Address book</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-md-12 text-right d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <a href="{{url('/address')}}" id="btn-add-contact" class="btn btn-info"><i class="mdi mdi-account-multiple-plus font-16 mr-1"></i> Add Contact</a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="card">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th><b>Name</b></th>
                                <th><b>Email</b></th>
                                <th><b>Location</b></th>
                                <th><b>Phone</b></th>
                                <th><b>Operation</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->name}}</td>
                                <td>
                                    @foreach($contact->emails as $email)
                                        <span class="usr-email-addr">{{$email->email}}</span><br>
                                    @endforeach
                                </td>
                                <td>{{$contact->location}}</td>
                                <td>
                                    @foreach($contact->phones as $phone)
                                        <span class="usr-ph-no">{{$phone->number}}</span><br>
                                    @endforeach
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-settings" ></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{url('address/'.$contact->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form class="form" action="{{url('address/'.$contact->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Do you want to delete this contact?')" class="dropdown-item"><i class="fa fa-trash"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>

        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    @endsection



