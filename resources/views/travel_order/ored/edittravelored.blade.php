@extends('template')

@section('content')
<div class="container-fluid">    

        <div id="app">
    	  	<edittravelored
                      :to-number="{{ json_encode($travel_order->to_number) }}"
                      :destination="{{ json_encode($travel_order->destination) }}"
                      :purpose="{{ json_encode($travel_order->purpose) }}"
                      :current-dept="{{ json_encode($travel_order->office) }}"
                      :datedepart="{{ json_encode($travel_order->date_depart) }}"
                      :datearrive="{{ json_encode($travel_order->date_arrived) }}"
                      :expenses="{{ json_encode($travel_order->expenses) }}"
                      :assist_labor_allowed="{{ json_encode($travel_order->assist_labor_allowed) }}"
                      :travel_type="{{ json_encode($travel_order->travel_type) }}"
                      :instructions="{{ json_encode($travel_order->instructions) }}"
                      :id="{{ json_encode($travel_order->id) }}"
                      :salary="{{ json_encode($travel_order->salary) }}"
                ></edittravelored>
        </div>
</div>
@endsection