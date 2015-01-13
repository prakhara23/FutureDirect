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

if(!isset($_POST['register']) 
	and !isset($_POST['cancel']) 
	and !isset($_POST['login']) 
	and !isset($_POST['logout']) 
	and !isset($_POST['cart']) 
	and !isset($_POST['cartupdate'])
	and !isset($_POST['yesout']) 
	and !isset($_POST['noout']) 
	and !isset($_POST['shopping']) 
	and !isset($_POST['checkout']))
		{
			header('Location: FutureDirectOutput.php');
			exit ();
		}	

$db=mysql_connect("localhost","root") or die('Not connected : ' . mysql_error());
mysql_select_db("futuredirectdatabase",$db) or die (mysql_error());

session_start();

if (isset($_POST['cancel']))
	{ header ("Location: FutureDirectOutput.php");
	exit();}
	
if(isset($_POST['register']))
{
	$SQL1="SELECT * FROM `clients`";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);	
	
	$firstname=trim($_POST['firstname']);	
	$lastname=trim($_POST['lastname']);	
	$username=trim($_POST['username']);
	$username = preg_replace('/\s+/', '', $username);	
	$password=trim($_POST['password']);	
	$password = preg_replace('/\s+/', '', $password);
	$ccardnum=trim($_POST['ccardnum']);
	$ccardexm=$_POST['ccardexm'];
	$ccardexy=$_POST['ccardexy'];
	$email=trim($_POST['email']);
	$valid="true";
		
	if (empty($firstname) or empty($lastname) or !ctype_alpha($firstname) or !ctype_alpha($lastname))
		{ $e1="Name fields must be filled in and alphabetical.<br>";
		$valid="false";}
	if (empty($username) or empty($password))
		{ $e3="Username and Password fields must be filled in.<br>";
		$valid="false";}
	if (strlen($password)<6)
		{ $e8="Password must be 6 characters long.<br>";
		$valid="false";}	
	for ($i=0;$i<$num_results1;$i++)
		{
			$row=mysql_fetch_array($result1);
			if ($username==$row['username'])
				{ $e4="Unavailable Unsername.<br>";
				$valid="false";}
		}			
	if (empty($ccardnum) or !ctype_digit($ccardnum) or strlen($ccardnum)!=16)
		{ $e5="Enter valid credit card number.<br>";
		$valid="false";}
	if ($ccardexm=="x" or $ccardexy=="x")
		{ $e6="Select credit card expiry date.<br>";
		$valid="false";}
	if ($ccardexy < date("Y"))
		{ $e9="Credit card is expired.";
		$valid="flase";}
	if ($ccardexm<=date("m") and $ccardexy==date("Y"))
		{ $e9="Credit card is expired.";
		$valid="false";}
	if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL))
		{ $e7="Enter a valid email adress.<br>";
		$valid="false";}
	if ($valid=="false")
		{$_SESSION['e1']=$e1;
		 $_SESSION['e2']=$e3.$e4.$e8;
		 $_SESSION['e3']=$e5.$e6.$e9;
		 $_SESSION['e4']=$e7;
		 $_SESSION['first']=$firstname;
		 $_SESSION['last']=$lastname;
		 $_SESSION['user']=$username;
		 $_SESSION['ccnum']=$ccardnum;
		 $_SESSION['email']=$email;
		 $_SESSION['cardm']=$ccardexm;
		 $_SESSION['cardy']=$ccardexy;
		header("Location: ".$_SESSION['url']."&error");
		exit();}
	
	$SQL="INSERT INTO `clients`(`id`, `lastname`, `firstname`, `credit card number`, `credit card date`, `username`, `password`, `email`) 
	VALUES (NULL,'".$lastname."','".$firstname."','".$ccardnum."','".$ccardexm.$ccardexy."','".$username."','".$password."','".$email."')";
	mysql_query($SQL,$db) or die(mysql_error());
	$id=mysql_insert_id();
	
	$_SESSION['user']=$id;
	if (isset($_SESSION['cartsend']))
		{ 	header('Location: FutureDirectOutput.php?cart'); }
	else
		{header('Location: FutureDirectOutput.php');}
	exit();
}

if(isset($_POST['login']))
{
	$username=$_POST['ulogin'];
	$password=$_POST['plogin'];
		
	if (empty($username))
		{$_SESSION['error1']="Username not found.<br>";
		header ("Location: ".$_SESSION['url']."&error1");
		exit();}

	$SQL1="SELECT * FROM `clients` WHERE `username`='".$username."'";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);	
	
	if ($num_results1=="0")
		{$_SESSION['error1']="Username not found.<br>";
		header ("Location: ".$_SESSION['url']."&error1");
		exit();}
	for ($i=0;$i<$num_results1;$i++)
		{
			$row=mysql_fetch_array($result1);
			if ($password!=$row['password'])
				{$_SESSION['error2']="Incorrect Password or Username.<br>";
				header ("Location: ".$_SESSION['url']."&error1");
				exit();}
			if ($password==$row['password'])
				{ $_SESSION['user']=$row['id'];
				if (isset($_SESSION['cartsend']))
					{ header('Location: FutureDirectOutput.php?cart'); }
				else
					{header('Location: '.$_SESSION['url']);}
				}					
		}	
	
}	

if(isset($_POST['logout']))	
{ 
	session_destroy();
	$SQL="DELETE FROM `cart` ";
	mysql_query($SQL,$db) or die(mysql_error());
	
	header ('Location: '.$_SESSION['url']);
	exit();
}	

if (isset($_POST['cart']))
{
	$product=$_SESSION['product'];
	$pic=$_SESSION['pic'];
	$quantity=$_POST['quantity'];
	
	if (!isset($_SESSION['cartcheck']))
		{ $SQL="DELETE FROM `cart` ";
		mysql_query($SQL,$db) or die(mysql_error());
		$_SESSION['cartcheck']=true;}
	
	$SQL1="SELECT * FROM `products` WHERE `id`='".$product."'";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);	
	$row=mysql_fetch_array($result1);
	
	$SQL2="SELECT * FROM `cart` WHERE `product_id`='".$product."'";
	$result2=mysql_query($SQL2) or die(mysql_error());
	$num_results2=mysql_num_rows($result2);	
	if ($num_results2!=0)
		{ 
			$SQL="UPDATE `cart` SET `total_units_sold`='".$quantity."' WHERE `product_id`='".$product."'";
			mysql_query($SQL,$db) or die(mysql_error());	
			header ("Location: FutureDirectOutput.php?cart");
			exit();
		}	
	else
		{
			$SQL="INSERT INTO cart
					(`product_id`, `total_units_sold`, `picture`) 	
					VALUES ('".$product."', '".$quantity."', '".$pic."')";
			mysql_query($SQL,$db) or die(mysql_error());	
			header ("Location: FutureDirectOutput.php?cart");
			exit();	
		}	
		
}

if (isset($_POST['cartupdate']))
{
	$deletecool=array();
	$quantitycool=array();
	$id=$_SESSION['quantityid'];
	
	if (isset($_POST['delete']))
		{
		foreach ($_POST['delete'] as $array)
			{ $deletecool[]=$array;}
		}
				
	foreach ($deletecool as $deleteid)
		{
			$SQL="DELETE FROM `cart` WHERE `product_id`='".$deleteid."'";
			mysql_query($SQL,$db) or die(mysql_error());	
				
		}	
		
	$SQL="SELECT * FROM `cart`";
	$result=mysql_query($SQL) or die(mysql_error());
	$num_results=mysql_num_rows($result);	
	for ($i=0;$i<$num_results;$i++)
		{
			$row=mysql_fetch_array($result);
			
			$quantitycool=$_POST['quantitycart'.($i+1)];
			$SQL1="UPDATE `cart` SET `total_units_sold`='".$quantitycool."' WHERE `product_id`='".$row['product_id']."'";
			mysql_query($SQL1,$db) or die(mysql_error());
		}	
	
	header ("Location: FutureDirectOutput.php?cart");
	exit();
}

if (isset($_POST['checkout']))
{
	if (!isset($_SESSION['user']))
		{ header ('Location: FutureDirectOutput.php?loginregis'); 
		 exit(); }
	else	 
		{header ('Location: FutureDirectOutput.php?confirm');
		exit();}
}

if (isset($_POST['shopping']))
{
	header ('Location: FutureDirectOutput.php');
	exit();
}

if (isset($_POST['noout']))
{
	header ('Location: FutureDirectOutput.php?cart');
	exit();
}

if (isset($_POST['yesout']))
{
	$SQL="INSERT INTO `orders`(`id`, `client_id`, `subtotal`, `tax`, `total`) 
		VALUES (NULL, '".$_SESSION['user']."', '".$_SESSION['subtotalprice']."','".$_SESSION['taxprice']."','".$_SESSION['totalprice']."')";
	mysql_query($SQL,$db) or die(mysql_error());
	$orderid=mysql_insert_id();

	$SQL1="SELECT * FROM cart";
	$result1=mysql_query($SQL1) or die(mysql_error());
	$num_results1=mysql_num_rows($result1);
	for ($i=0;$i<$num_results1;$i++)
		{
			$row=mysql_fetch_array($result1);
			$SQL2="INSERT INTO `purchase`(`id`, `order_id`, `product_id`, `unit_number`) 
				VALUES (NULL,'".$orderid."', '".$row['product_id']."', '".$row['total_units_sold']."')";
			mysql_query($SQL2,$db) or die(mysql_error());	
		}	
		
	$SQL="DELETE FROM `cart` ";
	mysql_query($SQL,$db) or die(mysql_error());	
	
	$_SESSION['orderidnum']=$orderid;
	header ('Location: FutureDirectOutput.php?reciept');
	exit();	
}
?>
</p>