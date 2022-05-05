@extends('template')

@section('content')
<div class="container-fluid">    

        <div id="app">
    	  	<edittraveldivchief
                      :to-number="{{ json_encode($travel_order->to_number) }}"
                      :destination="{{ json_encode($travel_order->destination) }}"
                      :purpose="{{ json_encode($travel_order->purpose) }}"
                ></edittraveldivchief>
        </div>
</div>
@endsection