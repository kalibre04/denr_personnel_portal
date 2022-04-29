@extends('template')
@section('content')
<div class="container-fluid">
              
              <!-- <h3 class="card-title">Travel Orders</h3> -->
              
              <!-- /.card-header -->
              <div class="card card-primary card-outline">
                  <div class="card-header">
                        <h3>Travel Orders</h3>
                  </div>
                  <div class="card-header">  
                  
                        <a href="{{ route('travel.create', 'createtravel') }}" class="btn btn-primary">Create</a>
                        <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                  </div>
                  <div class="card-body pad table-responsive">
                      <table id ="travelTable" class="display">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>T.O. #</th>
                            <th>Office/Department</th>
                            <th>Status</th>
                            <th>Destination</th>
                            <th>Departure Date</th>
                            <th>Arrival Date</th>
                            <th>Purpose</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($travels as $travel)
                          <tr>
                            <td>{{ $travel->id }}</td>
                            <td>{{ $travel->to_number }}</td>
                            <td>{{ $travel->office }}</td>
                            <td><span class="tag tag-success">{{ $travel->application_status }}</span></td>
                            <td>{{ $travel->destination }}</td>
                            <td>{{ $travel->date_depart }}</td>
                            <td>{{ $travel->date_arrived }}</td>
                            <td>{{ $travel->purpose }}</td>
                            <td>Action</td>
                          </tr>
                        @endforeach         
                        </tbody>
                      </table>
                  </div>
              </div>
            <!-- /.card -->
</div>
@endsection