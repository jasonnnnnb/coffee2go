<!DOCTYPE html>

<html>
<head>
	<style> /*style for header and footer*/
		header, footer {
			padding: 1em;
    		
    		clear: left;
    		text-align: center;
        }
        button {
            box-shadow: 0 4px #999;
            padding:10px;
        }
        .motto {
            font-family: "Palatino", "Garamond", "Times", serif
        }
	</style>
	<title> Start an order </title>
	<link href="main.css" type="text/css" rel="stylesheet"/>
</head>

<body>
    <h1>Order some coffee!</h1>
    <form id="order" type="POST" action="checkout.php"> 
    <!-- redirect to the controller, which will redirect to the right view 
    make sure form -->

        <fieldset>
            <legend>Customer information</legend>
            Name: <input type="text" placeholder="First and Last"></input>
            Email: <input type="email" placeholder="@scrippscollege.edu"></input>
            <br/>
            Phone number: <input type="phone" placeholder="(909) 555-5555"></input>
            Carrier: <input type="text" placeholder="to receive texts"></input>
        </fieldset>
        <fieldset>
            <legend>Order</legend>
            <select>
                <option value="coffee">Coffee</option>
                <option value="tea">Tea</option>
                <option value="smoothie">Smoothie</option>
            </select>
            <p><span id="drinklist">Drinks will be inserted here</span></p>
        </fieldset>
        
        <p></p>
        <button class="brown" type="submit" value="submit">Go to cart</button>
    </form>
    <p>Thank you for your order!</p>

    <footer>
        <hr/>
        <p class='motto' style="font-weight:bold;">The Motley Coffeehouse</p>
        <p class="motto"> - an intersectional, political, and feminist coffeehouse run by the students of Scripps College - </p>
        <p>345 E. 9th Street <br/> Scripps College <br/> Claremont, CA 91711</p>
        <p>(909) 607-3967 </p>
    </footer>
</body>

</html>