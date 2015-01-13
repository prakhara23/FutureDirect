<form action="FutureDirectProcessing.php" method="POST">
<html>
	<head>
	<style>
		body
		{background-color:white;}
		p
		{font-family:"century gothic";}
	</style>
	</head>
	<p>
<?php	
$db=mysql_connect("localhost","root") or die('Not connected : ' . mysql_error());
mysql_select_db("futuredirectdatabase",$db) or die (mysql_error());

function black()
{ echo "<table border='0' align='center'>
			<tr>
				<td width='1920000px' bgcolor='black'>FUTURE DIRECT</td>
			</tr>	
		</table>"; }
function login()
	{$error1="";
	$error2="";
	
		if (isset($_GET['error1']))
			{if(isset($_SESSION['error1']))
				{$error1=$_SESSION['error1'];}
			unset($_SESSION['error1']);	
			if(isset($_SESSION['error2']))
				{$error2=$_SESSION['error2'];}
			unset($_SESSION['error2']);}
			
		if (isset($_SESSION['user']))
			{ 
				echo	'<table border="0" align="center">
							<tr>
								<td width="20%"></td>
								<td width="60%" align="center" colspan="2"><a href="FutureDirectOutput.php"><img src="Images/sitelogo.jpg" width="480px"></a></td>';
				
				$SQL1="SELECT * FROM `clients` WHERE `id`='".$_SESSION['user']."'";
				$result1=mysql_query($SQL1) or die(mysql_error());
				$num_results1=mysql_num_rows($result1);	
				$row=mysql_fetch_array($result1);
				
				echo "<td width='20%' align='right'>Hello, ".ucfirst($row['firstname']).".<br>";
				if (isset($_GET['cart']))
					{ echo "";}
				else
					{ echo '<a href="FutureDirectOutput.php?cart">Cart</a><br>'; }
				if (isset($_GET['order']))
					{ echo "";}
				else
					{ echo "<a href='FutureDirectOutput.php?order'>Order History</a><br>"; }	
				if (isset($_GET['account']))
					{ echo "";}
				else
					{ echo '<a href="FutureDirectOutput.php?account">Account Info</a><br>'; }			
				echo "<input type='submit' name='logout' value='Logout'></td></tr>
				</table>";
			}
		if (!isset($_SESSION['user']))	
			{	echo'<table border="0" align="center">
					<tr>
						<td width="20%"></td>
						<td width="60%" align="center" colspan="2"><a href="FutureDirectOutput.php"><img src="Images/sitelogo.jpg" width="480px"></a></td>';
			
				echo
					'<td width="10%">
						<b>Login:</b><br>
						<input type="text" name="ulogin" placeholder="Username"><br>
						<input type="password" name="plogin" placeholder="Password"><br>
						<input type="submit" name="login" value="Login"><br>
						<font size="2x" color="red">'.$error1.$error2.'</font>
					</td>
					<td width="10%">
						<b>Are You New Here?</b><br>
						<a href="FutureDirectOutput.php?signup"><p><b>Sign Up NOW!</b></p></a>';
					if (isset($_GET['cart']))
						{ echo "";}
					else
						{ echo '<a href="FutureDirectOutput.php?cart"><p><b>Cart</b></p></a>'; }
				echo	'</td>	
					</tr>
					</table>';
			}
	}			

session_start();



if (!isset($_GET['signup']) and 
	!isset($_GET['products']) and 
	!isset($_GET['pid']) and 
	!isset($_GET['cart']) and 
	!isset($_GET['confirm']) and 
	!isset($_GET['loginregis']) and 
	!isset($_GET['order']) and 
	!isset($_GET['reciept']) and 
	!isset($_GET['oid']) and 
	!isset($_GET['account']))			
{
	$_SESSION['url']="FutureDirectOutput.php?";
	login();	
	
	black();
			
	echo "<table border='0' align='center'>
			<tr>
				<td width='33%'><a href='FutureDirectOutput.php?phones&products'><img src='Images/category2.jpg' width='350px' height='350px'></a></td>
				<td width='33%'><a href='FutureDirectOutput.php?videogames&products'><img src='Images/category1.gif' width='350px' height='350px'></a></td>
				<td width='33%'><a href='FutureDirectOutput.php?laptops&products'><img src='Images/category3.png' width='350px' height='350px'></a></td>
			</tr>
			<tr>
				<td align='center'><a href='FutureDirectOutput.php?phones&products'><b>Phones</b></a></td>
				<td align='center'><a href='FutureDirectOutput.php?videogames&products'><b>Video Games</b></a></td>
				<td align='center'><a href='FutureDirectOutput.php?laptops&products'><b>Laptops</b></a></td>
			</tr>	
	
		 </table>";
		 
	black();
}	
		
if (isset($_GET['signup']) or isset($_GET['loginregis']))
{ 
	$e1="";
	$e2="";
	$e3="";
	$e4="";
	$first="";
	$last="";
	$user="";
	$ccardnum="";
	$email="";
	$ccardexm="";
	$ccardexy="";
	
	if (isset($_GET['loginregis']))
		{ $_SESSION['url']="FutureDirectOutput.php?loginregis"; 
		  $_SESSION['cartsend']=true;}
	else
		{ $_SESSION['url']="FutureDirectOutput.php?signup"; }
	
	echo	'<table border="0" align="center">
				<tr>
					<td width="20%"></td>
					<td width="60%" align="left" colspan="4"><a href="FutureDirectOutput.php"><img src="Images/sitelogo.jpg"></a></td>';
	echo '</tr><tr><td></td>';
	
	if (isset($_GET['error']))
		{	if(isset($_SESSION['first']))	
				{$first=$_SESSION['first'];}
			unset($_SESSION['first']);
			if(isset($_SESSION['last']))	
				{$last=$_SESSION['last'];}
			unset($_SESSION['last']);
			if(isset($_SESSION['user']))	
				{$user=$_SESSION['user'];}
			unset($_SESSION['user']);
			if(isset($_SESSION['ccnum']))	
				{$ccardnum=$_SESSION['ccnum'];}
			unset($_SESSION['ccnum']);
			if(isset($_SESSION['email']))	
				{$email=$_SESSION['email'];}
			unset($_SESSION['email']);
			if(isset($_SESSION['cardm']))	
				{$ccardexm=$_SESSION['cardm'];}
			unset($_SESSION['cardm']);
			if(isset($_SESSION['cardy']))	
				{$ccardexy=$_SESSION['cardy'];}
			unset($_SESSION['cardy']);
	
			if(isset($_SESSION['e1']))
				{$e1=$_SESSION['e1'];}
			unset($_SESSION['e1']);	
			if(isset($_SESSION['e2']))
				{$e2=$_SESSION['e2'];}
			unset($_SESSION['e2']);	
			if(isset($_SESSION['e3']))
				{$e3=$_SESSION['e3'];}
			unset($_SESSION['e3']);	
			if(isset($_SESSION['e4']))
				{$e4=$_SESSION['e4'];}
			unset($_SESSION['e4']);	
		}
	
	if (isset($_SESSION['user']))
		{	header ('Location: FutureDirectOutput.php');
			exit(); }
	if (isset($_GET['loginregis']))
		{	
			$error1="";
			$error2="";
	
			if (isset($_GET['error1']))
				{if(isset($_SESSION['error1']))
					{$error1=$_SESSION['error1'];}
				unset($_SESSION['error1']);	
				if(isset($_SESSION['error2']))
					{$error2=$_SESSION['error2'];}
				unset($_SESSION['error2']);}
				
			
			
			echo '<td rowspan="6" width="10%">
					<b>Login:</b><br>
					<input type="text" name="ulogin" placeholder="Username"><br>
					<input type="password" name="plogin" placeholder="Password"><br>
					<input type="submit" name="login" value="Login"><br>
					<font size="2x" color="red">'.$error1.$error2.'</font>
				</td>
				<td rowspan="6" bgcolor="black"></td>';
		}
	echo '
				
				<td>
					<p><b>Register Here:</b></p>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>	
					<input type="text" name="firstname" value="'.$first.'" placeholder="First Name">
				</td>
				<td> 
					<input type="text" name="lastname" value="'.$last.'" placeholder="Last Name">
					<font size="2x" color="red">'.$e1.'</font>
				</td>	
			</tr>

			<tr>
				<td></td>
				<td>
					<input type="text" name="username" value="'.$user.'" placeholder="Username">
				</td>
				<td> 
					<input type="password" name="password" placeholder="Password"><font size="2x">*case-sensitive *minimum 6 characters</font>
				</td>	
				<td>
					<font size="2x" color="red">'.$e2.'</font>
				</td>	
			</tr>

			<tr>
				<td></td>
				<td>
					<input type="text" name="ccardnum" value="'.$ccardnum.'" placeholder="Credit Card Number" maxlength="16">
				</td>
				<td>
					<select name="ccardexm">
						<option value="x">Month</option>';
						for ($i=1;$i<13;$i++)
							{ echo "<option value=".$i."";
							if ($i==$ccardexm)
								{ echo ' selected';}
	echo							">".$i."</option>";}
	echo			'</select>
					<select name="ccardexy">
						<option value="x">Year</option>';
						$year= date("Y");
						$lastyear=$year+10;
						for ($i=$year;$i<$lastyear;$i++)
							{ echo "<option value=".$i."";
							if ($i==$ccardexy)
								{ echo ' selected';}
	echo							">".$i."</option>";}
	echo			'</select>
					<font size="2x" color="red">'.$e3.'</font>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="text" name="email" value="'.$email.'" placeholder="Email Address">
				</td>
				<td>	
					<font size="2x" color="red">'.$e4.'</font>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="register" value="Register">
					<input type="submit" name="cancel" value="Cancel">
				</td>
			</tr>		
			</table>';
	
}			
if (isset($_GET['products']))
{
	login();				
	black();
	
	if (isset($_GET['videogames']))
		{ 	
			$_SESSION['url']="FutureDirectOutput.php?videogames&products";
			$SQL1="SELECT * FROM `products` WHERE `id`<='4'"; 
		}
	if (isset($_GET['phones']))
		{ 	
			$_SESSION['url']="FutureDirectOutput.php?phones&products";
			$SQL1="SELECT * FROM `products` WHERE `id`>'4' and `id`<='7'"; 
		}	
	if (isset($_GET['laptops']))
		{ 	
			$_SESSION['url']="FutureDirectOutput.php?laptops&products";
			$SQL1="SELECT * FROM `products` WHERE `id`>'7'"; 
		}		
		
	echo "<table border='0' align='center'>
			<tr>
				<td></td>
				<td align='center'><b>NAME</b></td>			
				<td align='center'><b>PRICE</b></td>
			</tr>
			<tr>
				<td colspan='6' bgcolor='black'></td>
			</tr>";			
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);	
	for ($i=0;$i<$num_results1;$i++)
		{
			$row=mysql_fetch_array($result1);
			echo "<tr><td><img src='Images/".$row['picture']."' width='100px' length='100px'></td>
				<td><a href='FutureDirectOutput.php?pid=".$row['id']."'><b>".$row['name']."</b></a></td>
				<td>$".$row['price']."</td></tr>
				<tr><td colspan='6' bgcolor='black'></td></tr>";
		}	
	echo "<tr>
			<td align='center' colspan='3'><input type='submit' name='shopping' value='Home'></td>
		</tr>
	</table><br>";
	
	black();
}

if (isset($_GET['pid']))
{
	$_SESSION['url']="FutureDirectOutput.php?pid=".$_GET['pid'];
	
	login();
	black();				
	echo "<table border='0' align='center'>";
	
	$SQL1="SELECT * FROM `products` WHERE `id`='".$_GET['pid']."'";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);	
	$_SESSION['product']=$_GET['pid'];
	for ($i=0;$i<$num_results1;$i++)
		{
			$row=mysql_fetch_array($result1);
			echo "<tr>
				<td><img src='Images/".$row['picture']."' width='300px' length='300px'></td>
				<td><b>".$row['name']."&nbsp&nbsp$".$row['price']."</b><br><br>
				".$row['description']."<br><br>
				<b>Quatity:</b>
				<select name='quantity'>";
					//<option value='x'>Select</option>";
				for ($i=1;$i<11;$i++)
					{ echo "<option value=".$i.">".$i."</option>"; }
	echo		"</select><br><br>
				<input type='submit' name='cart' value='Add to Cart'>
				</td>
				</tr>";
				$_SESSION['pic']=$row['picture'];
		}	
	echo "<tr>
			<td align='center' colspan='3'><input type='submit' name='shopping' value='Home'></td>
		</tr>
	</table>";
	
	black();
}

if (isset($_GET['cart']))
{
	$_SESSION['url']="FutureDirectOutput.php?cart";

	login();
	black();
	
	if (!isset($_SESSION['cartcheck']))
		{ $SQL="DELETE FROM `cart` ";
		mysql_query($SQL,$db) or die(mysql_error());
		$_SESSION['cartcheck']=true;}
	
	$id=array();
	
	$subtotal="0";
	
	$SQL="SELECT *
		FROM cart
		INNER JOIN products
		ON cart.product_id=products.id";
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	
	if ($num_results=="0")
		{ echo "<table>
					<tr>
						<td align='center' width='1920000px' height='300px'>
							<b>Cart is Empty.</b><br><br>
							<b><a href='FutureDirectOutput.php'>Start Buying NOW</a></b>					
						</td>
					</tr>
				</table>"; 
		}
	else
		{	
			echo "<table align='center'>
			<tr>
				<td align='center'><b>DELETE</b></td>
				<td></td>
				<td align='center'><b>NAME</b></td>
				<td align='center'><b>UNITS</b></td>
				<td align='center'><b>PRICE</b></td>
			</tr>
			<tr>
				<td colspan='6' bgcolor='black'></td>
			</tr>";
			
			for ($i=0;$i<$num_results;$i++)
				{
					$row=mysql_fetch_array($result);
					$totalprice=$row['total_units_sold']*$row['price'];
					echo "<tr>
							<td align='center'><input type='checkbox' name='delete[]' value='".$row['id']."'></td>
							<td><img src='Images/".$row['picture']."' width='100px' length='100px'></td>
							<td><a href='FutureDirectOutput.php?pid=".$row['id']."'><b>".$row['name']."</b></a></td>
							<td align='center'>
								<select name='quantitycart".($i+1)."'>";
								for ($j=1;$j<11;$j++)
									{ echo "<option value='".$j."'";
									if ($j==$row['total_units_sold'])
										{ echo " selected"; }
									 echo ">".$j."</option>";
									}	
					
					echo		"</select>					
							</td>
							<td align='center'>$".$totalprice."</td><td>($".$row['price']."/unit)</td>
						</tr>
						<tr>
							<td colspan='6' bgcolor='black'></td>
						</tr>";
					
					array_push($id, $row['product_id']);
					$subtotal+=$totalprice;
						
				}
							
			$_SESSION['quantityid']=$id;
			$tax=$subtotal*0.13;
			$total=$subtotal+$tax;	
			echo "<tr>
					<td colspan='4' align='right'><b>Subtotal:</b></td>
					<td align='right'>$".$subtotal."</td>
				<tr>
				<tr>
					<td colspan='4' align='right'><b>Tax (HST):</b></td>
					<td align='right'>$".number_format($tax, 2, '.', '')."</td>
				<tr>
				<tr>
					<td colspan='4' align='right'><b>Total:</b></td>
					<td align='right'>$".number_format($total, 2, '.', '')."</td>
				<tr>
				<tr>
					<td colspan='4' align='right'><input type='submit' name='cartupdate' value='Update Cart'></td>
					<td align='center'><input type='submit' name='checkout' value='Checkout'></td>
					<td align='center'><input type='submit' name='shopping' value='Continue Shopping'></td>
				<tr>
				</table>";
			
			$_SESSION['totalprice']=$total;
			$_SESSION['subtotalprice']=$subtotal;
			$_SESSION['taxprice']=$tax;		
			
		}		
	black();
	
}	

if (isset($_GET['confirm']))
{ 
	if (!isset($_SESSION['user']))
		{ header ("Location: FutureDirectOutput.php");
		  exit();}

	$subtotal="0";
	
	$SQL="SELECT *
		FROM cart
		INNER JOIN products
		ON cart.product_id=products.id";
	
	echo login();
	echo black();
	
	echo "<table align='center'>
			<tr>
				<td></td>
				<td align='center'><b>NAME</b></td>
				<td align='center'><b>UNITS</b></td>
				<td align='center'><b>PRICE</b></td>
			</tr>
			<tr>
				<td colspan='6' bgcolor='black'></td>
			</tr>";
				
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	for ($i=0;$i<$num_results;$i++)
		{
			$row=mysql_fetch_array($result);
			$totalprice=$row['total_units_sold']*$row['price'];
			echo "<tr>
					<td><img src='Images/".$row['picture']."' width='100px' length='100px'></td>
					<td>".$row['name']."</td>
					<td align='center'>".$row['total_units_sold']."</td>
					<td align='center'>$".$totalprice."</td>
				</tr>
				<tr>
					<td colspan='6' bgcolor='black'></td>
				</tr>";
		}
			
		echo "<tr>
				<td colspan='3' align='right'><b>Subtotal:</b></td>
				<td align='right'>$".$_SESSION['subtotalprice']."</td>
			<tr>
			<tr>
				<td colspan='3' align='right'><b>Tax (HST):</b></td>
				<td align='right'>$".number_format($_SESSION['taxprice'], 2, '.', '')."</td>
			<tr>
			<tr>
				<td colspan='3' align='right'><b>Total:</b></td>
				<td align='right'>$".number_format($_SESSION['totalprice'], 2, '.', '')."</td>
			<tr>
			<tr>
				<td colspan='2' align='right'><b>Proceed with Checkout?</b></td>
				<td align='right'><input type='submit' name='yesout' value='Yes'></td>
				<td align='center'><input type='submit' name='noout' value='No'></td>
			<tr>
		</table>";
	
	echo black();
}

if (isset($_GET['order']))
{
	if (!isset($_SESSION['user']))
		{ header ("Location: FutureDirectOutput.php");
		  exit();}
	
	login();
	black();
	
	$SQL="SELECT * FROM `orders` WHERE `client_id`='".$_SESSION['user']."'";
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	
	if ($num_results=="0")
		{
			echo "<table>
					<tr>
						<td align='center' width='1920000px' height='300px'>
							<b>No Orders Placed.</b><br><br>
							<b><a href='FutureDirectOutput.php'>Start Buying NOW</a></b>					
						</td>
					</tr>
				</table>"; 
		}
		
	else
	{echo "<table align='center'>
			<tr>
				<td align='center'><b>ORDER #</b></td>
				<td align='center'><b>TIME</b></td>
				<td align='center'><b>SUBTOTAL</b></td>
				<td align='center'><b>TAX</b></td>
				<td align='center'><b>TOTAL PRICE</b></td>
				<td></td>
			</tr>
			<tr>
				<td colspan='6' bgcolor='black'></td>
			</tr>";
	
	
	for ($i=0;$i<$num_results;$i++)
		{
			$row=mysql_fetch_array($result);
			echo "<tr>
					<td align='center'>".$row['id']."</td>
					<td align='center'>".$row['date']."</td>
					<td align='center'>$".$row['subtotal']."</td>
					<td align='center'>$".$row['tax']."</td>
					<td align='center'>$".$row['total']."</td>
					<td align='center'><a href='FutureDirectOutput.php?oid=".$row['id']."'>Details</a><br><br></td>
				</tr>
				<tr>
					<td colspan='6' bgcolor='black'></td>
				</tr>";	
		}	
			
	echo "<tr>
			<td align='center' colspan='6'><input type='submit' name='shopping' value='Home'></td>
		</tr>
		</table>";	
	}
	
	black();

}

if (isset($_GET['oid']))
{
	if (!isset($_SESSION['user']))
		{ header ("Location: FutureDirectOutput.php");
		  exit();}

	$orderid=$_GET['oid'];

	login();
	black();
	
	echo "<table align='center'>
			<tr>
				<td></td>
				<td align='center'><b>Products:</b></td>
				<td align='center'><b>Quantity:</b></td>
				<td align='center'><b>Price:</b></td>
			</tr>
			<tr>
				<td colspan='6' bgcolor='black'></td>
			</tr>";		
	
	
	$SQL1="SELECT * 
			FROM purchase
			INNER JOIN orders
			ON purchase.order_id=orders.id
			INNER JOIN products
			ON purchase.product_id=products.id
			WHERE orders.id='".$orderid."'"; 
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);
	for ($i=0;$i<$num_results1;$i++)
		{	
			$row=mysql_fetch_array($result1);
			echo "<tr>
					<td align='center'><img src='Images/".$row['picture']."'  width='100px' length='100px'></td>
					<td align='right'>".$row['name']."</td>
					<td align='center'>".$row['unit_number']."</td>
					<td align='center'>$".($row['price']*$row['unit_number'])."
					($".$row['price']."/Unit)</td>
				</tr>
				<tr>
					<td colspan='6' bgcolor='black'></td>
				</tr>";
		}	
	echo		"<tr>
					<td colspan='3' align='right'><b>Subtotal:</b></td>
					<td align='right'>$".$row['subtotal']."</td>
				</tr>
				<tr>	
					<td colspan='3' align='right'><b>Tax:</b></td>
					<td align='right'>$".$row['tax']."</td>
				</tr>	
				<tr>	
					<td colspan='3' align='right'><b>Total:</b></td>
					<td align='right'>$".$row['total']."</td>
				</tr>		
				<tr>
					<td align='center' colspan='4'><input type='submit' name='shopping' value='Home'></td>
				</tr>
		</table>";		
		
		black();
}

if (isset($_GET['reciept']))
{
	$orderid="15";
	
	if (!isset($_SESSION['orderidnum']))
		{ header ("Location: FutureDirectOutput.php");
		  exit();}
	
	if (isset($_SESSION['orderidnum']))
		{ $orderid=$_SESSION['orderidnum'];}
		
	$email="<table border='0' align='center'>
					<tr>
						<td align='center' colspan='4'><img src='Images/sitelogo.jpg'></td>
					</tr>
					<tr>
						<td align='center' colspan='4' bgcolor='black'></td>
					</tr>";
					
	$SQL="SELECT * 
			FROM orders
			INNER JOIN clients
			ON orders.client_id=clients.id
			WHERE orders.id='".$orderid."'"; 
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	for ($a=0;$a<$num_results;$a++)
		{	
			$row=mysql_fetch_array($result);
			$email=$email.
					"<tr>	
						<td align='center' colspan='5'><b>Reciept</b></td>
					</tr>
					<tr>	
						<td align='center'><b>Order #:</b></td>
						<td align='center' colspan='4'>".$orderid."</td>
					</tr>	
					<tr>	
						<td align='center'><b>Name:</b></td>
						<td align='center' colspan='4'>".$row['lastname'].", ".$row['firstname']."</td>
					</tr>
					<tr>	
						<td align='center'><b>Email:</b></td>
						<td align='center' colspan='4'>".$row['email']."</td>
					</tr>	
					<tr>
						<td align='center'><b>Credit Card:</b></td>
						<td align='center' colspan='4'>".str_repeat("*", (strlen($row['credit card number']) - 4)).substr($row['credit card number'],-4,4)."</td>
					</tr>
					<tr>	
						<td align='center'><b>Date:</b></td>
						<td align='center' colspan='4'>".$row['date']."</td>
					</tr>";
				$emailaddress=$row['email'];				
		}	
		
	$email=$email.
		"<tr>
			<td align='center'><b>Products:</b></td>
			<td align='center'><b>Quantity:</b></td>
			<td align='center'><b>Price:</b></td>
		</tr>";		
				
		
	$SQL1="SELECT * 
			FROM purchase
			INNER JOIN orders
			ON purchase.order_id=orders.id
			INNER JOIN products
			ON purchase.product_id=products.id
			WHERE orders.id='".$orderid."'"; 
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);
	for ($i=0;$i<$num_results1;$i++)
		{	
			$row=mysql_fetch_array($result1);
			$email=$email.
				"<tr>
					<td align='right'>".$row['name']."</td>
					<td align='center'>".$row['unit_number']."</td>
					<td align='center'>$".($row['price']*$row['unit_number'])."
					($".$row['price']."/Unit)</td>
				</tr>";
		}	
	$email=$email.
				"<tr>
					<td colspan='2' align='right'><b>Subtotal:</b></td>
					<td align='center'>$".$row['subtotal']."</td>
				</tr>
				<tr>	
					<td colspan='2' align='right'><b>Tax:</b></td>
					<td align='center'>$".$row['tax']."</td>
				</tr>	
				<tr>	
					<td colspan='2' align='right'><b>Total:</b></td>
					<td align='center'>$".$row['total']."</td>
				</tr>		
		</table>";		
	echo $email;
	//mail($emailaddress, 'Product Reciept', $email); 
	
	echo "<table border='0' align='center'>
			<tr><td><a href='FutureDirectOutput.php'><b>Home Page<b></a></p></td></tr>
		</table>";
}

if (isset($_GET['account']))
{
	if (!isset($_SESSION['user']))
		{ header ("Location: FutureDirectOutput.php");
		  exit();}
	
	login();
	black();
	
	$link1="";
	$link2="";
	
	echo "<table align='center'>
			<tr><td colspan='6' align='center'><b>ACCOUTN INFO</b></td></tr>
			<tr><td colspan='6' bgcolor='black'></td></tr>";
	
	$SQL="SELECT * FROM `clients` WHERE `id`='".$_SESSION['user']."'";
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);
	for ($i=0;$i<$num_results;$i++)
		{	
			$row=mysql_fetch_array($result);
			if (strlen($row['credit card date'])=="5")
				{ $row['credit card date']="000".$row['credit card date']; }
			else 
				{ $row['credit card date']="00".$row['credit card date']; }
			if (!isset($_GET['password']))
				{ $row['password']=str_repeat("*",(strlen($row['password'])));
				$link1="<a href='FutureDirectOutput.php?account&password'>Show</a>";}
			if (!isset($_GET['credit']))
				{ $row['credit card number']=str_repeat("*", (strlen($row['credit card number']) - 4)).substr($row['credit card number'],-4,4);
				$link2="<a href='FutureDirectOutput.php?account&credit'>Show</a>";}	
			
			echo "<tr>
					<td align='right'><b>Name:</b></td>
					<td align='left'>".$row['lastname'].", ".$row['firstname']."</td>
				  </tr>	
				  <tr><td colspan='6' bgcolor='black'></td> </tr>
				  <tr>
					<td align='right'><b>Userame:</b></td>
					<td align='left'>".$row['username']."</td>
				  </tr>
					 <tr><td colspan='6' bgcolor='black'></td> </tr>
				  <tr>
					<td align='right'><b>Password:</b></td>
					<td align='left'>".$row['password']."</td>
					<td align='left'>".$link1."</td>
				  </tr>
				  <tr><td colspan='6' bgcolor='black'></td></tr>
				   <tr>
					<td align='right'><b>Email:</b></td>
					<td align='left'>".$row['email']."</td>
				  </tr>	
				   <tr><td colspan='6' bgcolor='black'></td></tr>
				   <tr>
					<td align='right'><b>Credit Card:</b></td>
					<td align='left'>".$row['credit card number']."</td>
					<td align='left'>".$link2."</td>
				  </tr>
				   <tr><td colspan='6' bgcolor='black'></td></tr>
				  <tr>
					<td align='right'><b>Expiry Date:</b></td>
					<td align='left'>".substr(chunk_split($row["credit card date"], 4, '/'), 2, -1)."</td>
				  </tr>";	
		}
		
	$SQL1="SELECT * FROM `orders` WHERE `client_id`='".$_SESSION['user']."'";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);
	
	echo "<tr><td colspan='6' bgcolor='black'></td></tr>
		  <tr>
			<td align='right'><b>Total Orders:</b></td>
			<td align='left'>".$num_results1."</td>
		  </tr>
		  <tr>
			<td align='center' colspan='2'><input type='submit' name='shopping' value='Home'></td></td>
		 </tr>";
			
	echo "</table>";	
	
	black();		
}

?>
<table align='center'>
	<tr>
		<td align='center'><font color='gray'>© <?php echo date("Y") ; ?> Prakhar Adhikary Ltd. All rights reserved. For personal, noncommercial use only.</font></td>
	</tr>
</table>	
</p>