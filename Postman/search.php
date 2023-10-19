<?php
    include 'connect.php';
    header('Content-Type: application/json');
    header('Acess-Control-Allow-Origin: *');
    error_reporting(E_ERROR | E_PARSE);

    $data = json_decode(file_get_contents("php://input"), true);

    $originAirportId = $data['origin'];
    $destAirportId = $data['destination'];
    $departureDate = $data['departureDate'];
    $passengers = $data['passengers'];

    $response = new stdClass();
    $response->err = 0;
    $response->errMsg = "";

    $airport = "SELECT * FROM tbl_airports  WHERE id in('$originAirportId','$destAirportId')" ;
    $flight = "SELECT f.id,f.originAirportId,f.destAirportId,al.id as arlinId,al.airline,al.airlineCode,f.departureDate,f.arrivalDate,f.price,f.flightNumber,f.duration FROM `tbl_flights` as f left join tbl_airports as ap on ap.id= f.originAirportId left join tbl_airlines as al on al.id = f.airlineId WHERE originAirportId = '$originAirportId' and destAirportId = '$destAirportId' and f.departureDate >= CURDATE() and  date_format(f.departureDate,'%Y-%m-%d') = '$departureDate' and availableSeats >= '$passengers' ORDER by f.departureDate ASC;";
    
    $flightData = mysqli_query($conn, $flight) or die("SQL Query Failed.");
    $airports = mysqli_query($conn, $airport) or die("SQL Query Failed.");
    
    if(mysqli_num_rows($airports) > 0 ){
        while ($row = $airports->fetch_assoc()) {  
            $airportName[$row["id"]] = $row["name"];    
        }    
    }
    $flights=[];
    if(mysqli_num_rows($flightData) > 0 ){
        while ($row = $flightData->fetch_assoc()) {  

            $d=$row['destAirportId'];
            $o=$row['originAirportId'];
            $aid= $row['arlinId'];
            $ariva = $row['arrivalDate'];
            

            $returningFlights = "SELECT f.id,f.originAirportId,f.destAirportId,al.id as arlinId,al.airline,al.airlineCode,f.departureDate,f.arrivalDate,f.price,f.flightNumber,f.duration FROM tbl_flights as f left join tbl_airports as ap on ap.id= f.originAirportId left join tbl_airlines as al on al.id = f.airlineId WHERE originAirportId = '$d' and destAirportId = '$o' and al.id ='$aid' and f.departureDate >= CURDATE() and date_format(f.departureDate,'%Y-%m-%d') >= '$ariva' ORDER by f.departureDate DESC";
            
            $returningFlights = mysqli_query($conn, $returningFlights) or die("SQL Query Failed.");
            if(mysqli_num_rows($returningFlights) > 0 ){
                while ($retFlightRow = $returningFlights->fetch_assoc()) {
                    $returningFlight = $retFlightRow;
                }
            }  

            $departureDate = $row["departureDate"];
            $depart = date('h:i A', strtotime($departureDate));            

            $arrivalDate = $row["arrivalDate"];
            $arrival = date('h:i A', strtotime($arrivalDate));            

            $flight = new stdClass();
            $flight->airline = $row["airline"]; 
            $flight->Origin = $airportName[$row["originAirportId"]]; 
            $flight->destination = $airportName[$row["destAirportId"]]; 
            $flight->departureDate = $row["departureDate"]; 
            $flight->arrivalDate = $row["arrivalDate"]; 
            $flight->depart = $depart; 
            $flight->arrival = $arrival; 
            $flight->price = $row["price"];
            $flight->flightNumber = $row["flightNumber"];         
            $flight->duration = $row["duration"];
            $flight->returningFlight = $returningFlight;       

            $flights[]=  $flight;      
        }
        $response->flights = $flights;
    }else{
        $response->err = 1;
        $response->errMsg = "Sorry there is no flight on the departure date you have selected";    
    }
    echo json_encode($response);
?>