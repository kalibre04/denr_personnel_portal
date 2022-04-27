@extends('template')
@section('content')
<div class="container-fluid">

              <h3 class="card-title">Travel Orders</h3>
              
              <!-- /.card-header -->
              <a href="{{ route('travel.create', 'createtravel') }}" class="nav-link active">Create</a>
                <table id ="travelTable" class="display">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>T.O. #</th>
                      <th>Status</th>
                      <th>Destination</th>
                      <th>Departure Date</th>
                      <th>Arrival Date</th>
                      <th>Purpose</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>11-7-2014</td>
                      <td>11-7-2014</td>
                      <td>DATLAEFG</td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      <td>Action</td>
                    </tr>
                    <tr>
                      <td>219</td>
                      <td>Alexander Pierce</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>11-7-2014</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                      <td>Action</td>
                    </tr>                 
                  </tbody>
                </table>
 
            <!-- /.card -->
</div>
@endsection