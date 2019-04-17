<?php
include('dbconf.php');
$eventId = $_GET['event_id'];


$get_event_query = "SELECT * FROM events WHERE event_id={$eventId}";
$the_event = $pdo->query($get_event_query)->fetch(PDO::FETCH_ASSOC);
$eventId = $the_event["event_id"];
$eventName = $the_event["event_name"];
$eventPrice = $the_event["event_price"];

$data =  [
    "id" => (int)$eventId,
    "title" => $eventName,
    "itemPrice" => $eventPrice,
    "qty" => 1  
];
$formattedData = json_encode($data);
$filename = 'data.json';

//open or create the file
$handle = fopen($filename,'w+');

//write the data into the file
fwrite($handle,$formattedData);

//close the file
fclose($handle);

?>


<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<meta charset="utf-8">
    <style>
        *{ 
            padding: 0; 
            margin: 0; 
        }
        html {
            box-sizing: border-box;
            font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Helvetica Neue", "Arial", sans-serif; 
            font-size: calc(1.5vh + 1vw + 1%); 
            line-height: 1.5; 
            -moz-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        *, *::before, *::after {
            box-sizing: inherit;
        }
        body{ 
            overflow: auto; 
            min-height: 100vh; 
            width: 100%; 
        }
        main, header{
            padding: 1rem 2rem;
        }
        p{
            padding: 0.5rem 0;
        }
        main{
            border-top: 5px solid #bada55;
            display:flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            min-width: 600px;
        }
        #products{
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 1rem;
            
            flex:1 1 auto;
        }
        #cart{
            flex: 1 1 20%;
        }
        .card{
            border: 1px solid #999;
            padding: 1rem;
            box-sizing: content-box;
            max-width: 200px;
            position: relative;
        }
        .card img{
            width: 100%;
            filter: contrast(0.3);
        }
        .card .price{
            position: absolute;
            top: 3rem;
            left: 2rem;
            transform: rotate(30deg);
            text-shadow: 2px 2px 2px #333, 1px 1px 2px #eee;
            color: #bada55;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .card h2{
            font-size: 1.2rem;
        }
        .card p{
            font-size: 0.8rem;
        }
        .card .btn{
            border: 2px solid cornflowerblue;
            padding: 0.25rem 1rem;
            color: cornflowerblue;
            cursor: pointer;
        }
        
        .cart-item{
            border-bottom: 1px solid #666;
            padding:1rem;
            width: 100%;
            position: relative;
        }
        .cart-item .price{
            position: absolute;
            top: 2rem;
            bottom: 1rem;
            right: 1rem;
            width: 30%;
            font-size: 0.8rem;
            color: #AAA;
            transform: rotate(30deg);
        }
        .cart-item .title{
            font-size: 1rem;
            color: #999;
            line-height: 1.5rem;
            height: 1.5rem;
            width: 70%;
        }
        .cart-item .controls{
            height: 1.5rem;
            cursor: pointer;
            width: 70%;
            display: flex;
            justify-content: space-between;
            background-color: #eee;
        }
        .cart-item span:nth-child(1),
        .cart-item span:nth-child(3){
            border: 1px solid cornflowerblue;
            color: cornflowerblue;
            background: #fff;
            font-size: 1rem;
            line-height: 1.5rem;
            padding: 0 0.5rem;
            display: block;
        }
    </style> 
	<title><?php echo $the_event['event_name']; ?></title>

</head>

<body>

    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container">
            <ul class="right hide-on-med-and-down">
                <li><a href="create_event.php">Create an event</a></li>
            </ul>
        </div>
    </nav>

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row center"><br><br>
                <h1 class="header col s12 light">Book the Event to <?php echo "<span style='color:green'>" .$the_event['event_name'] ."</span>";?></h1><br><br>
            </div>
            <?php
$get_event_query = "SELECT * FROM events WHERE event_id={$eventId}";
$the_event = $pdo->query($get_event_query)->fetch(PDO::FETCH_ASSOC);

?>
            <h2 class="header center blue-text"><?php echo $the_event['event_name']; ?></h2><br>
            
        </div>
    </div>

    <div class="container">
    	<div class="section">
            <div class="card-panel medium card-content">
                <h3>What</h3>
                
                <?php echo "<h5 id='event_name'>" . $the_event['event_name']. "</h5"; ?></h5>
                <p><?php echo $the_event['event_description']; ?></p><br />
                <?php echo "<h4 id='event_price'>" . "Costs: " . $the_event['event_price']; ?> 
                <h3>Where</h3>
                <?php
              
                    $location_query = "SELECT * FROM locations WHERE loc_id={$the_event['event_location']}";
                    $location_result = $pdo->query($location_query)->fetch(PDO::FETCH_ASSOC);
                ?>
                <h5><?php echo $location_result['street']; ?><br /><?php echo $location_result['city'] . ", " . $location_result['state'] . " " . $location_result['zip']; ?></h5><br />
                <h3>When</h3>
                <?php
                    $date_query = "SELECT DATE_FORMAT(event_date, '%W, %e %M %Y, %T') AS 'date' FROM events WHERE event_id={$the_event['event_id']}";
                    $date_result = $pdo->query($date_query)->fetch(PDO::FETCH_ASSOC);
                    
                ?>
                <h5><?php echo $date_result['date']; ?></h5></br>
               <br />
                
                <h4><a href="rsv.php?event_id=<?php echo $the_event['event_id']; ?>&event_price=<?php echo $the_event['event_price'];?>&event_name=<?php echo $the_event['event_name'];?>">To Cart </a></h4>
                
                </form>
            </div>
    	</div>
    </div>

    <footer class="page-footer blue">
    	<div class="container">
        <main>
        <section id="products"></section>
        <section id="cart">
        <section >
      
        </section>
        <div id="formend"></div>
    </main>    
    
    		<div class="row">
    			<div class="col l6 s12">
    			</div>
				
			</div>
		</div>
	</footer>

</body>
<script>
var qty = '';
    const CART = {
            KEY: 'Localhost',
            contents: [],
            
            init(){
                let _contents = localStorage.getItem(CART.KEY);

                if(_contents){
                    CART.contents = JSON.parse(_contents);
              
                }
                
            },
            async sync(){
                let _cart = JSON.stringify(CART.contents);
                await localStorage.setItem(CART.KEY, _cart);
                
            },
            find(id){
                let match = CART.contents.filter(item=>{
                    if(item.id == id)
                        return true;
                });
                if(match && match[0])
                    return match[0];
            },
            add(id){
                let PRODUCTS = JSON.parse(<?php echo json_encode($formattedData);?>);
                if(CART.find(id)){
                    CART.increase(id, 1);
                }else{
                    let productid = PRODUCTS.id;
                        if(productid == id){
                            let obj = {
                            id: PRODUCTS.id,
                            title: PRODUCTS.title,
                            qty: 1,
                            itemPrice: PRODUCTS.itemPrice
                        };
                        CART.contents.push(obj);
                        CART.sync();
                            let data = true;
                            return data;
                        
                    
                    }else{
                        console.error('Invalid Product');
                    }
                }
            },
            increase(id, qty=1){
                CART.contents = CART.contents.map(item=>{
                    if(item.id === id)
                        item.qty = item.qty + qty;
                    return item;
                });
                CART.sync()
            },
            reduce(id, qty=1){
                CART.contents = CART.contents.map(item=>{
                    if(item.id === id)
                        item.qty = item.qty - qty;
                    return item;
                });
                CART.contents.forEach(async item=>{
                    if(item.id === id && item.qty === 0)
                        await CART.remove(id);
                });
                CART.sync()
            },
            remove(id){
                CART.contents = CART.contents.filter(item=>{
                    if(item.id !== id)
                        return true;
                });
                CART.sync()
            },
            empty(){
                CART.contents = [];
                CART.sync()
            },
            sort(field='title'){
                let sorted = CART.contents.sort( (a, b)=>{
                    if(a[field] > b[field]){
                        return 1;
                    }else if(a[field] < a[field]){
                        return -1;
                    }else{
                        return 0;
                    }
                });
                return sorted;
                
            },
            logContents(prefix){
                console.log(prefix, CART.contents)
            }
        };
        
        document.addEventListener('DOMContentLoaded', ()=>{
            
            getProducts( showProducts, errorMessage );
            
            CART.init();
            
            showCart();
        });
        
     function showCart(){
        let PRODUCTS = JSON.parse(<?php echo json_encode($formattedData);?>);

        let cartSection = document.getElementById('cart');
        let cartitem = document.createElement('div');
        cart.innerHTML = '';
            let form = document.createElement('form');
            form.action = "tickets.php";
            form.method = "post";
            cartSection.appendChild(form);
        

            let s = CART.sort('qty');
            s.forEach( item =>{
                let cartitem = document.createElement('div');
                cartitem.className = 'cart-item';
                
                let title = document.createElement('h3');
                title.textContent = item.title;
                title.className = 'title';
                cartitem.appendChild(title);

                
                let controls = document.createElement('div');
                controls.className = 'controls';
                cartitem.appendChild(controls);
                
                let plus = document.createElement('span');
                plus.textContent = '+';
                plus.setAttribute('data-id', item.id)
                controls.appendChild(plus);
                plus.addEventListener('click', incrementCart)
                
                let qty = document.createElement('span');
                qty.textContent = item.qty;
                controls.appendChild(qty);
                
                let minus = document.createElement('span');
                minus.textContent = '-';
                minus.setAttribute('data-id', item.id)
                controls.appendChild(minus);
                minus.addEventListener('click', decrementCart)
                
                let price = document.createElement('div');
                price.className = 'price';
                let cost = new Intl.NumberFormat('en-CA', 
                                {style: 'currency', currency:'CAD'}).format(item.qty * item.itemPrice);
                price.textContent = cost;
                cartitem.appendChild(price);
                
                cartSection.appendChild(cartitem);
                
                input1 = document.createElement('input');
                input1.type = "hidden";
                input1.name = 'id';
                input1.id = 'itemID';
                input1.value = PRODUCTS.id;
                form.appendChild(input1);
                input2 = document.createElement('input');
                input2.type = "hidden";
                input2.name = 'qty[]';
                input2.value = PRODUCTS.qty;
                
                form.appendChild(input2);

          
            })
            let button = document.createElement('input');
            button.type = 'submit';
            button.name = 'submit';
            button.value = 'submit';
            form.appendChild(button);
           
        }
        function incrementCart(ev){
            ev.preventDefault();
            let id = parseInt(ev.target.getAttribute('data-id'));
            CART.increase(id, 1);
            let controls = ev.target.parentElement;
            let qty = controls.querySelector('span:nth-child(2)');
            let item = CART.find(id);
            if(item){
                qty.textContent = item.qty;
            }else{
                document.getElementById('cart').removeChild(controls.parentElement);
            }
        }
        
        function decrementCart(ev){
            ev.preventDefault();
            let id = parseInt(ev.target.getAttribute('data-id'));
            CART.reduce(id, 1);
            let controls = ev.target.parentElement;
            let qty = controls.querySelector('span:nth-child(2)');
            let item = CART.find(id);
            if(item){
                qty.textContent = item.qty;
            }else{
                document.
                getElementById('cart').removeChild(controls.parentElement);
            }
        }
        
        function getProducts(success, failure){
            const URL = "data.json";
            fetch(URL, {
                method: 'GET',
                mode: 'cors'
            })
            .then(response=>response.json())
            .then(showProducts)
            .catch(err=>{
                errorMessage(err.message);
            });
        }
        function showProducts( product ){
            
            let PRODUCTS = product;

            let productSection = document.getElementById('products');
            productSection.innerHTML = "";
                let card = document.createElement('div');
                card.className = 'card';
                let price = document.createElement('p');
                let cost = new Intl.NumberFormat('en-CA', 
                                        {style:'currency', currency:'CAD'}).format(product.itemPrice);
                price.textContent = cost;
                price.className = 'price';
                card.appendChild(price);
                
                let title = document.createElement('h2');
                title.textContent = product.title;
                card.appendChild(title);
                let btn = document.createElement('button');
                btn.className = 'btn';
                btn.textContent = 'Add Item';
                btn.setAttribute('data-id', product.id);
                btn.addEventListener('click', addItem);
                card.appendChild(btn);
                productSection.appendChild(card);
            
        }
        
        function addItem(ev){
            ev.preventDefault();
            let id = parseInt(ev.target.getAttribute('data-id'));
            console.log('add to cart item', id);
            CART.add(id, 1);
            showCart();
        }
        
        function errorMessage(err){
            console.error(err);
        }
    
        </script>
</html>