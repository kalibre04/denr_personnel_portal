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
                width: 50%;
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

            
            <div class="column">
                <p>Name: <u>{{ $fullname }}</u> </p>
            </div>
            <div class="column">
                <p>Salary: <u>{{ $salary }}</u></p>
            </div>


</body>
</html>