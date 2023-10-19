<?php include 'connect.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Flight Search</title>
    <link rel="stylesheet" type="text/css" href="main.css">    
    
</head>
<body>
    <div class="container">
        <div class="search-container">
            <h2>Flight Search</h2>
            <form id="submit_form" method="post">                
                <div class="form-group">
                    <label>Select Origin</label>
                    <select name="origin" id="originAirportId">
                        <option value="">--Select--</option>
                        <option value="1">PNQ</option>
                        <option value="2">DEL</option>                        
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Destination</label>
                    <select name="destination" id="destAirportId">
                        <option value="">--Select--</option>
                        <option value="1">PNQ</option>
                        <option value="2">DEL</option>                        
                    </select>                    
                </div>
                <div class="form-group">
                    <label >Departure Date</label>
                    <input type="date" name="departureDate" id="departureDate" >
                </div>
                <div class="form-group">
                    <label >Passengers</label>
                    <input type="number" name="passengers" id="passengers"  min="1">
                </div>
                <div class="form-group">
                    <input type="submit" value="Search" id='search'>                                        
                </div>
            </form>
        </div>
        <div class="display-container" id="displayResult">
            <h1>Flight Search Results</h1>
            <table id="loadTableData">                
            </table>
        </div>
    </div>
</body>
</html>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    
    $(document).ready(function() {       
        $('#submit_form').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var originAirportId = $("#originAirportId").val();
            var destAirportId = $("#destAirportId").val();
            var departureDate = $("#departureDate").val();            
            var passengers = $("#passengers").val();

            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var todayDate = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;           

            console.log(originAirportId,destAirportId,departureDate,passengers,todayDate);
            if(originAirportId == "" || destAirportId == "" || departureDate =="" ||  passengers=="" ){
                alert("Please fill all the fields.");
                return ;                
            }
            else if(originAirportId ==  destAirportId ){
                alert("Please check the airports you have selected!");
                return ;
            }else if(departureDate < todayDate ){
                alert("Please check the date you have selected!");
                return ;
            }
            else{    
                console.log($('#submit_form').serialize());            
                $.ajax({
                    url: "searchFlight.php",
                    type: "POST",
                    data: $('#submit_form').serialize(),
                    success: function(data) {
                        $('#loadTableData').html(data);                                      
                    }
                });
            }
        });
    });
</script>
