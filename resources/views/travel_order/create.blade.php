@extends('template')

@section('content')
<div class="container-fluid">    

        <div id="app">
    	  	<createtravel 
                      :to-number="{{ json_encode($rounded) }}"
                      :current-dept="{{ json_encode($office_assigned->office->officename) }}"
                      :current-deptid="{{ json_encode($office_assigned->office->id) }}"
                      :accounttype="{{ json_encode($account_type) }}"
                ></createtravel>
        </div>
</div>
@endsection