<?php ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta author="Sergey Smirnov">
	<title>Browse events</title>
</head>

<body>
    



    <div class="container">
    <form method="POST" action="process_data.php" class="col s12">
        <label>Choose an option</label>
        <select class="browser-default" name="sort_method">
            <option value="" disabled>Choose an option...</option>
            <option value="1">See events sorted by date</option>
            <option value="2">See events sorted by alphabetically</option>
            <option value="3">See events sorted by event ID</option>
        </select><br />
    	<div class="row center">
            <button class="btn-large waves-effect waves-light green" type="submit" name="action">Sök</button>
        </div>
    </div>
    <br />

    <footer class="page-footer blue">
    	<div class="container">
    		<div class="row">
    			<div class="col l6 s12">
    			</div>
				<div class="col l3 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="white-text" href="login.php">Login</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>

</body>

</html>