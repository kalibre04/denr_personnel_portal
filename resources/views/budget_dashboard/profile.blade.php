@extends('budget_dashboard.main')

@section('content')
<div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="alert alert-success spacing"><i class="fa fa-thumbs-up"></i>
                <em>
                {!! session('flash_message') !!}
                </em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="/public/assets/images/users/10_avatar-512.png" class="rounded-circle" width="150" />
                            <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                            <h6 class="card-subtitle">{{ $user->status }}</h6>
                        </center>
                    </div>
                    <div>
                        <hr> </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{ $user->email }}</h6> 
                        <small class="text-muted p-t-30 db">Account Type</small>
                        <h6>{{ $user->status }}</h6> <small class="text-muted p-t-30 db">Department</small>
                        <h6>{{ $user->department }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#tab1" data-toggle="tab" class="nav-link active">Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab2" data-toggle="tab" class="nav-link">Change Password</a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane active" id="tab1">
                                {!! Form::model($user, ['route' => ['budget.profile.update',$user->id], 'method' => 'PATCH', 'files' => true]) !!}
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('name', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Username</label>
                                        <div class="col-md-12">
                                            {{ Form::text('username', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            {{ Form::email('email', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{ Form::submit('Update Profile',['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane" id="tab2">
                                {!! Form::model($user, ['route' => ['budget.password.update',$user->id], 'method' => 'PATCH', 'files' => true]) !!}
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="confirm_password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            {{ Form::submit('Update Profile',['class' => 'btn btn-success']) }}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection