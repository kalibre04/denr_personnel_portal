<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="preconnect" href="https://fonts.gstatic.com">
		<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> -->
        <!-- <link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet"> -->
		<style>
            table, tbody, td,
            {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                font: inherit;
                vertical-align: baseline;
            }
            
			body{
                font-family: 'Roboto', sans-serif;
                font-size: 13px;
            }
            table {
                border: 1px solid black;
                border-collapse: collapse;
	            border-spacing: 0;
            }
            table, th, td {
                border: 1px solid black;
            }

            table.no-spacing {
                border-spacing:0;
                border-collapse: collapse;
            }
            .nobull {
                list-style-type: none;
            }
            .column {
                float: left;
                width: 30%;
            }
            .column-50 {
                float: left;
                width: 50%;
            }
            .column2 {
                float: left;
                width: 80%;
            }
            .column-label {
                float: left;
                width: 15%;
            }
            .column-label2 {
                float: left;
                width: 10%;
            }
            .column-label-aredts {
                float: left;
                width: 30%;
            }
            .column-red {
                float: left;
                width: 40%;
            }
            .column-label-aredts2 {
                float: left;
                width: 10%;
            }
            .column-purpose {
                float: left;
                width: 18%;
            }
            .column-perdiem {
                float: left;
                width: 25%;
            }
            .column-labor {
                float: left;
                width: 30%;
            }
            .column-divider {
                float: left;
                width: 5%;
            }
            .container {
            position: relative;
            text-align: center;
            color: black;
            
            }
            .centered {
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translate(-50%, -50%);
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
		</style>
	    <title>BUMS | Report</title>
    </head>
<body>
    <!-- <div style="position: absolute;">
	        
    </div> -->
            <center><p>
               Republic of the Philippines<br>
               <b>Department of Environment and Natural resources</b><br>
               Office of the Regional Director<br>
               Regional Office XI Km. 7, Lanang, Davao City, 8000 Philippines<br>
               Tel. #: (082) 233-2779 Fax: (082) 234-0811<br>
               Email: oredenrxi@yahoo.com.ph Website: r11.denr.gov.ph
            </p></center>
            <h3><center>TRAVEL ORDER</center></h3>
            <h4><center>No: {{ $to_number }}</center></h4>

            <div class="row">
                    <div class="column-label">
                        <p>Name: </p>
                        <p>Position: </p>
                        <p>Destination</p>
                        <p>Departure Date:</p>
                    </div>
                    <div class="column">
                        <p><u><b>{{ $fullname }}</b></u></p>
                        <p><u>{{ $position->plantilla->plantilla_position }}</u></p>
                        <p><u>{{ $destination }}</u></p>
                        <p><u>{{ $date_depart }}</u></p>
                    </div>
                    <div class="column-divider">
                        <p></p>
                        
                    </div>
                    <div class="column-label">
                        <p>Salary: </p>
                        <p>Div/Sec/Unit: </p>
                        <p>Official Station: </p>
                        <p>Arrival Date: </p>
                    </div>
                    <div class="column">
                        <p><u>{{ $salary }}</u></p>
                        <p><u>{{ $office }}</u></p>
                        <p><u>{{ $official_station->office->location }}</u></p>
                        <p><u>{{ $date_arrived }}</u></p>
                    </div>
            </div>
            <div class="row">
                <div class="column-purpose">
                    <p>Purpose of Travel: </p>
                </div>
                <div class="column2">
                    <p><u>{{ $purpose }}</u></p>
                </div>
            </div> 
            <div class="row">
                <div class="column-perdiem">
                    <p>Per Diems/Expenses Allowed: </p>
                </div>
                <div class="column2">
                    <p><u>{{ $expenses }}</u></p>
                </div>
            </div>
            <div class="row">
                <div class="column-labor">
                    <p>Assistants or Laborers Allowed: </p>
                </div>
                <div class="column2">
                    <p><u>{{ $assist_labor_allowed }}</u></p>
                </div>
            </div>  
            <div class="row">
                <div class="column-labor">
                    <p>Remarks or Special Instructions: </p>
                </div>
                <div class="column2">
                    <p><u>{{ $instructions }}</u></p>
                </div>
            </div>      
            <h4>Certification: </h4>
            <p>This is to certify that the travel is necessary and is connected with the functions of the official/employee of this Division/Section/Unit.</p>
            
            @if($travtype == 'Within AOR')
                        
                        @if($officetype == 'ms')
                                <div class="row">
                                    <div class="column-label2">
                                            
                                    </div>
                                    <div class="column">
                                        <p>Recommending Approval: </p>
                                    </div>
                                    <div class="column-divider">
                                            <p> </p>
                                    </div>
                                    <div class="column-label">
                                            
                                    </div>
                                    <div class="column">
                                        <p>Approved:</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <p> </p>
                                </div> 
                        
                                <div class="row">
                                    <div class="column-label2">
                                            
                                    </div>
                                    <div class="column">
                                        <center><p><u><b>  {{ $aredmsfullname }}</b></u><br>
                                        ARD for Management Services</p></center>
                                    </div>
                                    <div class="column-divider">
                                            <p></p>
                                            
                                    </div>
                                    <div class="column-label">
                                            
                                    </div>
                                    <div class="column">
                                        <center><p><u><b>{{ $redfullname }}</b></u><br>
                                        Regional Executive Director</p></center>
                                    </div>
                                </div>
                        @elseif($officetype == 'ts')
                                <div class="row">
                                    <div class="column-label2">
                                            
                                    </div>
                                    <div class="column">
                                        <p>Recommending Approval: </p>
                                    </div>
                                    <div class="column-divider">
                                            <p> </p>
                                            
                                    </div>
                                    <div class="column-label">
                                            
                                    </div>
                                    <div class="column">
                                        <p>Approved:</p>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                <p> </p>
                                </div> -->
                                <div class="row">
                                    <!-- <div class="column-label2">
                                            
                                    </div> -->
                                    <div class="column-50">
                                        <div class="container">
                                                <img src="{{ asset('/public/img/esign/vbillones.png') }}" width="100px" height="100px">
                                                <div class="centered">        
                                                    <p><u><b>  {{ $aredtsfullname }}</b></u><br>
                                                    ARD for Technical Services</p></center>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- <div class="column-divider">
                                            <p></p>
                                            
                                    </div> -->
                                    <!-- <div class="column-label">
                                            
                                    </div> -->
                                    <div class="column-50">
                                        <div class="container">
                                                <img src="{{ asset('/public/img/esign/vbillones.png') }}" width="100px" height="100px">
                                                <div class="centered">        
                                                    <p><u><b>  {{ $aredmsfullname }}</b></u><br>
                                                    ARD for Management Services</p></center>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p> </p>
                                </div>
                                <div class="row">
                                    <div class="column-label-aredts">
                                            <p> </p>
                                    </div>
                                    <div class="column-red">
                                        <center><p><u><b>{{ $redfullname }}</b></u><br>
                                        Regional Executive Director</p></center>
                                    </div>
                                    <div class="column-label-aredts2">
                                            <p> </p>
                                    </div>
                                </div>


                        @elseif($officetype == 'cenro')

                        @elseif($officetype == 'penro')


                        @endif

            @elseif($travtype == 'Outside AOR')

                        

            @endif
            
</body>
</html>