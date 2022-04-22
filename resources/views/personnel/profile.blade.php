@extends('template')

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
                        <center class="m-t-30">
                            <!-- <img src="/public/assets/images/users/10_avatar-512.png" class="rounded-circle" width="150" /> -->
                            <h4 class="card-title m-t-10">{{ $user->firstname." ". substr(Auth::user()->middlename, 0, 1). " " .$user->lastname }}</h4>
                            <h6 class="card-subtitle">{{ $user->gender }}</h6>
                            <h6 class="card-subtitle">{{ $user->date_of_birth }}</h6>
                        </center>
                    </div>
                    <div>
                        <hr> </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{ $user->email }}</h6> 
                        <small class="text-muted p-t-30 db">Account Type</small>
                        <h6>{{ $user->account_type }}</h6> 
                        <small class="text-muted p-t-30 db">Current Department</small>
                        <!-- <h6>{{ $user->department }}</h6> -->
                        
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
                            <li class="nav-item">
                                <a href="#tab3" data-toggle="tab" class="nav-link">Promotions</a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab4" data-toggle="tab" class="nav-link">Department</a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane active" id="tab1">
                                {!! Form::model($user, ['route' => ['personnel.profile.update',$user->id], 'method' => 'PATCH', 'files' => true]) !!}
                                    <div class="form-group">
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('firstname', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Middle Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('middlename', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('lastname', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date of birth</label>
                                        <div class="col-md-12">
                                            {{ Form::date('date_of_birth', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contact No.</label>
                                        <div class="col-md-12">
                                            {{ Form::number('contact_no', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-12">Username</label>
                                        <div class="col-md-12">
                                            {{ Form::text('username', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div> -->
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
                                {!! Form::model($user, ['route' => ['personnel.password.update',$user->id], 'method' => 'PATCH', 'files' => true]) !!}
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
                            <div class="tab-pane" id="tab3">
                                            <div class="row">
                                            <div class="col-12">
                                            <div class="card">
                                            <div class="card-header">
                                            <h3 class="card-title">Promotions History</h3>
                                            <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                            </button>
                                            </div>
                                            </div>
                                            </div>
                                            </div>

                                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                                <table class="table table-head-fixed text-nowrap">
                                                    <thead>
                                                    <tr>
                                                    <th>ID</th>
                                                    <th>Plantilla</th>
                                                <!-- <th>Salary Step</th> -->
                                                    <th>Date Promoted</th>
                                                    
                                                    </tr>
                                                    </thead>
                                                        <tbody>
                                                        @foreach($promotion as $promotions)
                                                        <tr>
                                                        <td>{{ $promotions->id }}</td>
                                                        <td>{{ $promotions->plantilla->plantilla_position }}</td>
                                                        <!-- <td>11-7-2014</td> -->
                                                        <!-- <td><span class="tag tag-success">Approved</span></td> -->
                                                        <td>{{ $promotions->datePromoted }}</td>
                                                        
                                                        <td><a href='delete/{{ $promotions->id }}'>Delete</a></td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                        </tbody>
                                                </table>
                                            </div>
                                            </div>
                                            </div>
                                            </div>

                                            {!! Form::model($user, ['route' => ['promotion.add',$user->id], 'method' => 'POST', 'files' => true]) !!}
                                                    <div class="form-group">
                                                        <label class="col-md-12">Plantilla</label>
                                                        <div class="col-md-12">
                                                            {{ Form::select('plantilla', $plantillas, null,['class' => 'form-control select2']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">From Date</label>
                                                        <div class="col-md-12">
                                                            {{ Form::date('datePromoted', null,['class' => 'form-control form-control-line']) }}
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            {{ Form::submit('Add Position',['class' => 'btn btn-success']) }}
                                                        </div>
                                                    </div>
                                            {!! Form::close() !!}
                            </div>
                            <div class="tab-pane" id="tab4">
                                {!! Form::model($user, ['route' => ['personnel.profile.update',$user->id], 'method' => 'PATCH', 'files' => true]) !!}
                                    <div class="form-group">
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('firstname', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Middle Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('middlename', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            {{ Form::text('lastname', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date of birth</label>
                                        <div class="col-md-12">
                                            {{ Form::date('date_of_birth', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contact No.</label>
                                        <div class="col-md-12">
                                            {{ Form::number('contact_no', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-12">Username</label>
                                        <div class="col-md-12">
                                            {{ Form::text('username', null,['class' => 'form-control form-control-line']) }}
                                        </div>
                                    </div> -->
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection