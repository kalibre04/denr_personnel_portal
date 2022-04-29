@extends('template')

@section('content')
<div class="container-fluid">    

        <div id="app">
    	  	<createtravel 
                      :to-number="{{ json_encode($rounded) }}"
                      :current-dept="{{ json_encode($office_assigned->office->officename) }}"
                ></createtravel>
        </div>
</div>
@endsection