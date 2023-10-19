<?php
include 'connect.php';
error_reporting(E_ERROR | E_PARSE);

$originAirportId = $_POST['origin'];
$destAirportId = $_POST['destination'];
$departureDate = $_POST['departureDate'];
$passengers = $_POST['passengers'];

$airport = "SELECT * FROM tbl_airports  WHERE id in('$originAirportId','$destAirportId')" ;

$flight = "SELECT f.id,f.originAirportId,f.destAirportId,al.airline,al.airlineCode,f.departureDate,f.arrivalDate,f.price,f.flightNumber,f.duration FROM `tbl_flights` as f 
        left join tbl_airports as ap on ap.id= f.originAirportId 
        left join tbl_airlines as al on al.id = f.airlineId
        WHERE originAirportId = '$originAirportId' and destAirportId = '$destAirportId' and f.departureDate >= CURDATE() and  date_format(f.departureDate,'%Y-%m-%d') = '$departureDate' and f.availableSeats >= '$passengers' 
        ORDER by f.departureDate ASC;";

$flightData = mysqli_query($conn, $flight) or die("SQL Query Failed.");
$airportData = mysqli_query($conn, $airport) or die("SQL Query Failed.");

while ($row = $airportData->fetch_assoc()) {  
    $airportName[$row["id"]] = $row["name"];    
}
$output = "";
if(mysqli_num_rows($flightData) > 0 ){
    $output = '<table>  
                    <tr>                       
                        <th>Airline</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th width="90px">Depart</th>                        
                        <th width="90px">Arrive</th>
                        <th>Price</th>
                        <th width="90px">Flight Number</th>
                        <th width="90px">Duration</th>                        
                    </tr>';
    while ($row = $flightData->fetch_assoc()) { 
        $departureDate = $row["departureDate"];
        $depart = date('h:i A', strtotime($departureDate));          
        $arrivalDate = $row["arrivalDate"];
        $arrival = date('h:i A', strtotime($arrivalDate));
        
        $output .="<tr>
                    <td>{$row["airline"]}</td>
                    <td>{$airportName[$row["originAirportId"]]}</td>
                    <td>{$airportName[$row["destAirportId"]]}</td>
                    <td>{$depart}</td>
                    <td>{$arrival}</td>
                    <td>{$row["price"]}</td>
                    <td>{$row["flightNumber"]}</td>
                    <td>{$row["duration"]}</td>                   
                      ";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
}
else{
    echo "Sorry there is no flight on the date you have searched!";
}

?>