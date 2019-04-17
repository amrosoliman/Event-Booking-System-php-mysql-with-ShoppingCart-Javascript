<?php
include('dbconf.php');
$user_choice = $_POST['sort_method'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Events</title>
</head>

<body>


    <div class="container">
        <div class="section">
        <h3>Sorting 
        <?php
            if ($user_choice == 1)
            {
                $events_query = "SELECT * FROM events ORDER BY event_date";
                echo "by date</h3>";
            }
            else if ($user_choice == 2)
            {
                $events_query = "SELECT * FROM events ORDER BY event_name";
                echo "alphabetically by name</h3>";
            }
            else if ($user_choice == 3)
            {
                $events_query = "SELECT * FROM tennisevent.events ORDER BY event_id";
                echo "by event ID</h3>";
            }
           $events_result = $pdo->query($events_query)->fetchAll(PDO::FETCH_ASSOC); ?>
           
           <?php foreach($events_result as $event){ ?>
            <div class="card-panel small card-content">
                <h4><a href="event.php?event_id=<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></a></h4>
                <h5><?php echo $event['event_date']; ?></h5>
                <p><?php echo $event['event_description']; ?></p>
            </div>
           <?php } ?>
           
        
          

        </div>
    </div>
    <br />

            
</body>

</html>