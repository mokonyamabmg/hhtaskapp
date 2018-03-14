<?php
session_start();
date_default_timezone_set('Africa/Johannesburg'); 
$value = ' ';
$result="";
if(isset($_GET['value']))
{
$value=$_GET['value'];	
}
	

////************save record**********
// require a file that has our class
	require_once("libs/validator.php");
 $validator = new Validator();
if($value=='save')
{
	$validator->addField('dueDate');
	$validator->add_rule_to_field('dueDate', array('emptyDate'));
	//"Todays Date: ". date('o:m:d'); 
			$todaysDate= date('o-m-d', strtotime(date('o-m-d')));
	$validator->add_rule_to_field('dueDate', array('min_date', $todaysDate));


	$validator->addField('taskTitle');
	$validator->add_rule_to_field('taskTitle', array('empty'));
	$validator->add_rule_to_field('taskTitle', array('min_length', 2));
    $validator->add_rule_to_field('taskTitle', array('max_length', 30));
	
	
	
if($validator->form_valid()== TRUE)
	{
	$dueDate=mysql_real_escape_string($_POST['dueDate']);
	$taskTitle=mysql_real_escape_string($_POST['taskTitle']);

include 'connect.php';
$sql_check=mysql_query("SELECT * FROM task WHERE title='$taskTitle' AND dueDate='$dueDate'") or die (mysql_error());


if(mysql_num_rows($sql_check) ==0)
{
$sql1="INSERT INTO `taskmanagementtool_db`.`task` (`title`, `dueDate`, `status`, `created`, `lastUpdated`) VALUES ('$taskTitle', '$dueDate', 'Opened', NOW(), NOW())";
         $db =mysqli_connect("localhost", "root", "", "taskmanagementtool_db");
		 mysqli_query($db, $sql1);
		header("location:index.php?value=Opened");	
	
}else
{
	$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." Already exist";
}


		
 	
		
 }
    

		 
  	
}

if($value=='delete')
{

$id = $_GET['id'];
	
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	
	
include 'connect.php';

$sql_check=mysql_query("SELECT * FROM task WHERE id='$id'") or die (mysql_error());


if(mysql_num_rows($sql_check) > 0)
{
       $delete_sql=mysql_query("DELETE FROM task WHERE id=$id");
	if(delete_sql)
		header("location: index.php?value=opened.php");
	else
		$_SESSION['message']='Error: '.mysql_error();
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." does not exist";	
}	
    



	

  
		 }
	
	
}


if($value=='close')
{

$id = $_GET['id'];
	
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	
	
include 'connect.php';

$sql_check=mysql_query("SELECT * FROM task WHERE id='$id'") or die (mysql_error());


if(mysql_num_rows($sql_check) > 0)
{
      
	   $update_sql=mysql_query("UPDATE task
	   SET status='Closed', lastUpdated=NOW() WHERE id=$id");
	if($update_sql)
		header("location: index.php?value=closed");
	else
		$_SESSION['message']='Error: '.mysql_error();
	
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." does not exist";	
}	
    



	

  
		 }
	
	
}

if($value=='finish')
{

$id = $_GET['id'];
	
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	
	
include 'connect.php';

$sql_check=mysql_query("SELECT * FROM task WHERE id='$id'") or die (mysql_error());


if(mysql_num_rows($sql_check) > 0)
{
      
	   $update_sql=mysql_query("UPDATE task
	   SET status='Finished', lastUpdated=NOW() WHERE id=$id");
	if($update_sql)
		header("location: index.php?value=finished");
	else
		$_SESSION['message']='Error: '.mysql_error();
	
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." does not exist";	
}	
    



	

  
		 }
	
	
}

if($value=='cancel')
{

$id = $_GET['id'];
	
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	
	
include 'connect.php';

$sql_check=mysql_query("SELECT * FROM task WHERE id='$id'") or die (mysql_error());


if(mysql_num_rows($sql_check) > 0)
{
      
	   $update_sql=mysql_query("UPDATE task
	   SET status='Cancelled', lastUpdated=NOW() WHERE id=$id");
	if($update_sql)
		header("location: index.php?value=cancelled");
	else
		$_SESSION['message']='Error: '.mysql_error();
	
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." does not exist";	
}	
    



	

  
		 }
	
	
}
if($value=='reOpen')
{

$id = $_GET['id'];
	
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	
	
include 'connect.php';

$sql_check=mysql_query("SELECT * FROM task WHERE id='$id'") or die (mysql_error());


if(mysql_num_rows($sql_check) > 0)
{
      
	   $update_sql=mysql_query("UPDATE task
	   SET status='Opened', lastUpdated=NOW() WHERE id=$id");
	if($update_sql)
		header("location: index.php?value=Opened");
	else
		$_SESSION['message']='Error: '.mysql_error();
	
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." does not exist";	
}	
    



	

  
		 }
	
	
}

if($value=='edit')
{

	$validator->addField('dueDate');
	$validator->add_rule_to_field('dueDate', array('emptyDate'));
	//"Todays Date: ". date('o:m:d'); 
			$todaysDate= date('o-m-d', strtotime(date('o-m-d')));
	$validator->add_rule_to_field('dueDate', array('min_date', $todaysDate));


	$validator->addField('taskTitle');
	$validator->add_rule_to_field('taskTitle', array('empty'));
	$validator->add_rule_to_field('taskTitle', array('min_length', 2));
    $validator->add_rule_to_field('taskTitle', array('max_length', 30));
	
	
	 //check if there are errors
		 if($validator->form_valid()== TRUE)
		 {
	$dueDate=mysql_real_escape_string($_POST['dueDate']);
	$taskTitle=mysql_real_escape_string($_POST['taskTitle']);
	
include 'connect.php';
$taskid = $_SESSION['taskID'];
$sql_check=mysql_query("SELECT * FROM task WHERE title='$taskTitle' AND dueDate='$dueDate'") or die (mysql_error());


if(mysql_num_rows($sql_check) ==0)
{
       $update_sql=mysql_query("UPDATE task
	   SET title='$taskTitle', dueDate='$dueDate',lastUpdated=NOW() WHERE id=$taskid");
	if($update_sql)
		header("location: index.php?value=Opened");
	else
		$_SESSION['message']='Error: '.mysql_error();
      
}else
{
$row=mysql_fetch_array($sql_check);
	$_SESSION['newmessage'] = "Task ".$row['id']." Already exist";	
}	
    



	

  
		 }
	
	
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from astritbublaku.com/demos/sweetpick/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 May 2015 04:02:19 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>TASK MANAGEMENT TOOL</title>
	

	<meta charset="utf-8">

	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,800,900,200,100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noticia+Text:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,400,200,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="screen">	

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="css/fullwidth.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/settings.css" media="screen" />

	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
	
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- Style Switch -->
	<link rel="alternate stylesheet" type="text/css" href="css/colors/yellow-black.css" title="yellow" media="screen" />
   	<link rel="alternate stylesheet" type="text/css" href="css/colors/violet-black.css" title="black" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="css/colors/orange-black.css" title="orange" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="css/colors/blue-black.css" title="blue" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors/red-black.css" title="red" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="css/colors/green-black.css" title="green" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="css/colors/pink-black.css" title="pink" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="css/colors/pale-green-black.css" title="pale-green" media="screen" />

</head>
<style type="text/css">
.header{
	background-color: blue;
	color: white;
	text-color: center;
	top:4px;
	width: 100%;
	padding: 0px;
	text-align: center;
	font-size: 13px;
}
	#navigation
{

	border: 3px solid #E3E3E3;
	margin-top: 20px;
	text-shadow: 0.1em 0.1em #333;
	background-color: grey;
}

#nav
{
	list-style: none;
}

#nav ul
{
	margin: 0;
	padding: 0;
	float: left;
	display: none;
	display: block;
}

#nav li
{
	font-size: 18px;
	
	position: relative;
	display: block;
}
#nav a:link, nav a:active, nav a:visited
{
	
	color: black;
	text-decoration: none;
}

#nav a:hover
{
	color: lightblue;
}

#error_msg{
	width: 50%;
	margin: 5px auto;
	height: 30px;
	border: 1px solid red;
	background: red;
	color: black;
	text-align: center;
	padding-top: 0px;
	font-size: 14px;
}

</style>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

	<!-- Container -->
	<div id="container">
		<!-- Header
		    ================================================== -->
		<header class="clearfix">

		
			<div class="">
			<div class="header">
     <h1 align="center">TASK MANAGEMENT TOOL</h1>
</div>
				<div class="container">
					<div class="left-line">
						<ul>
							<li><a href="#addTask-box" class="login-window">
							<input type="submit" name="login_btn" value="ADD TASK" style="height=900px; width:300px;
							color: black; font-size: 18px; background-color: grey;">
							</a></li>
						</ul>

						<div class="mobile-a">
							<a href="#addTask-box" class="login-window"><i class="fa fa-user"></i></a>
							<a href="#"><i class="fa fa-heart"></i></a>
						</div>
					</div>
					<div class="right-line clearfix">
						
						

				        <div id="addTask-box" class="login-popup">
				        	<a href="#" class="close"><img src="images/delete.png" class="btn_close" title="Close Window" alt="Close" /></a>
				         	<form method="post" action='index.php?value=save'>
				                <fieldset class="textbox">
					                <h4 class="login-title">ADD NEW TASK</h4>

					                
     <table align='center'>
	 <p>
		    <label>Task Title:</label>
			<input type="text" name="taskTitle" value="<?php if(isset($_POST['taskTitle'])) echo $_POST['taskTitle']; ?>"/>
			<?php $validator->out_field_error('taskTitle'); ?>
			
		</p>	
   <p>
		    <label>Due Date   : </label>
			<input type="date" name="dueDate" style ="height:30px; width:135px;" value="<?php if(isset($_POST['dueDate'])) echo $_POST['dueDate']; ?>"/>
			<?php $validator->out_field_error('dueDate'); ?>
			
		</p>	

		
					               
					               
    <p></p> <p></p> <p></p>
					               <p> 
								   <a href="index.php?value=save" class="login-window">
								   <input type='submit' name='btn_sumit' value='ADD' class="submit button"/>
								   </a>
								   </p>
					                
					                <div class="clear"></div>
				                	
				                	</table>
				                </fieldset>
				          </form>
						</div>
						
						<?php 
  
  if(isset($_POST['btn_submit']))
  {
	 $id=$_GET['tasksId'];
	 $_SESSION['taskID']=$id;
	 include 'connect.php';
     $row=mysql_query("SELECT * FROM task WHERE id=$id");
      $st_row=mysql_fetch_array($row);
      ?>
						<div id="editTask-box" class="login-popup">
				        	<a href="#" class="close"><img src="images/delete.png" class="btn_close" title="Close Window" alt="Close" /></a>
				         	<form method="post" action='index.php?value=edit'>
				                <fieldset class="textbox">
					                <h4 class="login-title">EDIT TASK</h4>

					                
     <table align='center'>
	 <p>
		    <label>Task Title:</label>
			<input type="text" name="taskTitle" value="<?php if(isset($_POST['taskTitle'])) echo $_POST['taskTitle'];
			else echo $st_row['title'];?>" />
			<?php $validator->out_field_error('taskTitle'); ?>
			
		</p>	
   <p>
		    <label>Due Date   : </label>
			<input type="date" name="dueDate" style ="height:30px; width:135px;" value="<?php if(isset($_POST['dueDate'])) 
				echo $_POST['dueDate'];
			else echo $st_row['dueDate'];?>"/>
			<?php $validator->out_field_error('dueDate'); ?>
			
		</p>	

		
					               
					               
    <p></p> <p></p> <p></p>
					               <p> 
								   <a href="index.php?value=save" class="login-window">
								   <input type='submit' name='btn_sumit' value='SAVE' class="submit button"/>
								   </a>
								   </p>
					                
					                <div class="clear"></div>
				                	
				                	</table>
				                </fieldset>
				          </form>
  <?php }?>
						</div>

					</div>
					<div class="clear"></div>
				</div>
			</div>
			<nav id="navigation">
			
		      <table id="nav">
			  <tr>
			  <td width="130px" style="padding-left: 50px; font-size: 28px;"><a href="index.php?value=Opened">Opened</a></td>
		      <td width="130px" style="padding-left: 50px; font-size: 28px;"><a href="index.php?value=closed">Closed</a></td>
			   <td width="130px" style="padding-left: 50px; font-size: 28px;"><a href="index.php?value=cancelled">Cancelled</td>
			   <td width="130px" style="padding-left: 50px; font-size: 28px;"><a href="index.php?value=finished">Finished</td>
			   </tr>
			
			  </table>
			</nav>
			<!-- end topline -->

			<div class="upper-header">
				<div class="container">
				
				<?php
    if(isset($_SESSION['newmessage'])){
		echo "<div id='error_msg'>".$_SESSION['newmessage']."</div>";
		unset($_SESSION['newmessage']);
	}
?>

				<?php $validator->output_all_field_errors(); ?>
               
			   <?php
			   if($value=='Opened')
{ 
include 'connect.php';
$sql_query = mysql_query("SELECT  id, title, dueDate, created, lastUpdated FROM task WHERE status='Opened' ORDER BY dueDate ASC");
while($row=mysql_fetch_array($sql_query))
{
	
$result=$result."<thead>
<th>Title</th>
<th>Due Date</th>
<th>Created</th>
<th>Last Updated</th>
<th>Action</th>
</thead><tr>
<td>".$row['1']."</td>
<td>".$row['2']."</td>
<td>". $row['3']."</td>
<td>".$row['4']."</td>


<td align='center'>
   <a href='#editTask-box' class='login-window'>        
<form method='post' >
							<input type ='text' name='tasksId'  value='".$row['0']."' style='visibility:hidden;'/>
							 <a href='#editTask-box' class='login-window'><input type='submit' name='btn_submit' value='Edit' style='height=400px; width:100px;
							color: blue; font-size: 18px; border: none; background-color: white;' >
							</a></form></a>
							
<a href='index.php?value=delete&id=".$row['0']."'><input type='button' name='delete_btn' value='Delete'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
<a href='index.php?value=close&id=".$row['0']."'><input type='button' name='close_btn' value='Close'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
<a href='index.php?value=cancel&id=".$row['0']."'><input type='button' name='cancel_btn' value='Cancel'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
 <a href='index.php?value=finish&id=".$row['0']."'><input type='button' name='finish_btn' value='Finished'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
</td>
		 
	     </tr>";
}
?>
			   <h2 align="Center">Opened Tasks</h2>

<?php }else if($value=='closed')
{
	include 'connect.php';
$sql_query = mysql_query("SELECT  id, title, dueDate, created, lastUpdated FROM task WHERE status='Closed' ORDER BY dueDate DESC");
while($row=mysql_fetch_array($sql_query))
{
	
$result=$result."<thead>
<th>Title</th>
<th>Due Date</th>
<th>Created</th>
<th>Last Updated</th>
<th>Action</th>
</thead><tr>
<td>".$row['1']."</td>
<td>".$row['2']."</td>
<td>". $row['3']."</td>
<td>".$row['4']."</td>


<td align='center'>

<a href='index.php?value=reOpen&id=".$row['0']."'><input type='button' name='delete_btn' value='Re-open'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>						
<a href='index.php?value=delete&id=".$row['0']."'><input type='button' name='delete_btn' value='Delete'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
<a href='index.php?value=cancel&id=".$row['0']."'><input type='button' name='cancel_btn' value='Cancel'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>
</td>
		 
	     </tr>";
}
	?>


  <h2 align="Center">Closed Tasks</h2>
<?php }else if($value=='cancelled')
{
	include 'connect.php';
$sql_query = mysql_query("SELECT  id, title, dueDate, created, lastUpdated FROM task WHERE status='Cancelled' ORDER BY dueDate DESC");
while($row=mysql_fetch_array($sql_query))
{
	
$result=$result."<thead>
<th>Title</th>
<th>Due Date</th>
<th>Created</th>
<th>Last Updated</th>
<th>Action</th>
</thead><tr>
<td>".$row['1']."</td>
<td>".$row['2']."</td>
<td>". $row['3']."</td>
<td>".$row['4']."</td>


<td align='center'>
					
<a href='index.php?value=delete&id=".$row['0']."'><input type='button' name='delete_btn' value='Delete'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>

</td>
		 
	     </tr>";
}
	?>
<h2 align="Center">Cancelled Tasks</h2>
<?php }else if($value=='finished')
{?>
<h2 align="Center">Finished Tasks</h2>
<?php

	include 'connect.php';
$sql_query = mysql_query("SELECT  id, title, dueDate, created, lastUpdated FROM task WHERE status='Finished' ORDER BY dueDate DESC");
while($row=mysql_fetch_array($sql_query))
{
	
$result=$result."<thead>
<th>Title</th>
<th>Due Date</th>
<th>Created</th>
<th>Last Updated</th>
<th>Action</th>
</thead><tr>
<td>".$row['1']."</td>
<td>".$row['2']."</td>
<td>". $row['3']."</td>
<td>".$row['4']."</td>


<td align='center'>
					
<a href='index.php?value=delete&id=".$row['0']."'><input type='button' name='delete_btn' value='Delete'
 style='height=900px; width:100px; color: black; font-size: 18px; background-color: grey;'></a>

</td>
		 
	     </tr>";
}
 }

 ?>

<table align="center" border="1" cellspacing="10" cellpadding="1" width="1000">

<?php echo $result;?>


</table>

					<div class="clear"></div>

				</div>
				<!-- End container -->	
			</div>
			<!-- End Upper-header -->		
			
			
			</div>
		

		</header>
		<!-- End Header -->


		<!-- content -->
		<div id="content">
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<div></div>
<div class="header">
     <h1 align="center">BY BMG 212100661</h1>
</div>
		</div>

	


        

		</div>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.superfish.js"></script>
	<script type="text/javascript" src="js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/retina-1.1.0.min.html"></script>
	<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="js/plugins-scroll.html"></script>
  	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.imagesloaded.min.js"></script>
	<script type="text/javascript" src="js/jquery.appear.js"></script>
	<script type="text/javascript" src="js/jquery.countTo.js"></script>
	<script src="js/jquery.parallax.html"></script>
     <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

 	<!-- include jQuery + carouFredSel plugin -->
    <script type="text/javascript" src="js/jquery.carouFredSel.js"></script>

    <!-- optionally include helper plugins -->
    <script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
	
   
</body>

<!-- Mirrored from astritbublaku.com/demos/sweetpick/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 May 2015 04:02:20 GMT -->
</html>