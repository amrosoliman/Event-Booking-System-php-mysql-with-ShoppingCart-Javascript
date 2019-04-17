<?php 
include('dbconf.php');

function generatePIN($digits = 4){
    $i = 0;
    $pin = ""; 
    while($i < $digits){
        
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}
 
$pin = generatePIN();



if(isset($_POST['submit'])){
$eventId = $_POST['id'];
$ticketQty = $_POST['qty'];}
$ticketHolder = 1;    
    
        
            $sql = "INSERT INTO tickets (event_name, ticket_pin, ticket_holder) VALUES (?, ?, ?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$eventId, $pin, $ticketHolder]);          

        
    
if($stmt){

    echo 'succes';

}