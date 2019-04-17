<?php 
include('dbconf.php');

$ticketHolder = 1;    
$pdo = $pdo;

if(isset($_GET['pin'])){
    $pin = $_GET['pin'];
    
}
function isPin($pin)
{
    $pdo =  $GLOBALS['pdo'];
    $stmt = $pdo->query("SELECT ticket_pin FROM tickets WHERE ticket_pin = $pin");
    $stmt->execute();
    $rowcount = $stmt->rowCount();
    $pinExist = ($rowcount = 1);
    if ($pinExist) {
        $data = $stmt->fetchColumn();
                if($data){
                    return TRUE;
                }else{ return FALSE;}
                               
                }
                
}

function getUserID($pin)
    {
        $pdo =  $GLOBALS['pdo'];
 
        $stmt = $pdo->query("SELECT ticket_holder FROM tickets WHERE ticket_pin = $pin");
        $stmt->execute();
        $rowcount = $stmt->rowCount();
        $data = ($rowcount = 1);
        
        if ($data) {
            $data = $stmt->fetchColumn();
        
               }
        
 
        return $data;
    }

function activateAccount($ticketHolder)
{
    $pdo =  $GLOBALS['pdo'];
    $pin = $GLOBALS['pin'];
   
    $stmt = $pdo->query("UPDATE tickets SET status = 'Used' WHERE ticket_holder = $ticketHolder AND ticket_pin = $pin");
    $stmt->execute();
    if ($stmt) {
        return true;
    }else{

    return FALSE;
}
}
if(isPin($pin)){
    getUserID($pin);
    activateAccount($ticketHolder);

    echo "The Status has been changed";
}else{
    echo "the provided pin does NOT exist in the database";
}

