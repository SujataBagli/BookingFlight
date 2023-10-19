<?php
    include 'connect.php';
    header('Content-Type: application/json');
    header('Acess-Control-Allow-Origin: *');
    
    $response = new stdClass();
    $response->err = 0;
    $response->errMsg = "";
    $date = date("Y-m-d");

    $data = json_decode(file_get_contents("php://input"), true);
    $flightId = $data['flightId'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $phone = $data['phone'];
    $email = $data['email'];
    $fullAddress = $data['fullAddress'];
    $cardType = $data['cardType'];
    $billingAddress = $data['billingAddress'];
    $isBooked = $data['isBooked'];
    $bookingStatus = $data['bookingStatus'];    
    $bookedOn = date("Y-m-d");
    $cancelledOn = $data['cancelledOn'];
    $noOfPassengers = $data['noOfPassengers'];    

    //$flight = "SELECT * FROM flight_bookings as WHERE date_format(bookedOn,'%Y-%m-%d') = '$date'  and email = '$email'";

    $sql = "INSERT INTO flight_bookings (flightId, fname, lname, phone, email, fullAddress,cardType,billingAddress,isBooked,bookingStatus,bookedOn,cancelledOn,noOfPassengers)
             VALUES ('$flightId', '$fname', '$lname', '$phone', '$email', '$fullAddress','$cardType','$billingAddress','$isBooked','$bookingStatus','$bookedOn','$cancelledOn','$noOfPassengers')";
   
    if(mysqli_query($conn, $sql)) {        
        $response->sucessMsg = "Booking done successfully!";

    }else{
        $response->err = 1;
        $response->errMsg = "Record not added";        
    }
    echo json_encode($response);

?>