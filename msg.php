<!DOCTYPE html>
<html>
<head>
	<title>MESSAGE BRODCASTER</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		@media only screen and (max-width: 992px) {
			.container label{
				text-align:left;

			}
		}
		@media only screen and (min-width: 992px) {
			.container label{
				text-align:right;

			}
		}
		.container{
			margin-top: 50px;
		}
		.card{
			padding: 20px;
		}
	</style>
	
</head>
<body>

	<div class="container">
		<h1 align="center" style="font-family:serif;">CUSTOM MESSAGE BRODCASTER</h1><br>
		<div class="card">
			<form  method="post" action="<?=($_SERVER['PHP_SELF'])?>">
				<div class="form-group row">
					<label for="MESSAGE" class="col-md-3 col-form-label " >APIKEY</label>
					<div class="col-md-9">
						<input class="form-control"  type="text" name="APIKEY" placeholder="ENTER your 22 letter API key here" size="30">
					</div>
				</div>
				<div class="form-group row">
					<label for="MESSAGE" class="col-md-3 col-form-label " >SENDER ID</label>
					<div class="col-md-4">
						<input class="form-control" type="text" name="SENDER_ID" placeholder="SENDER ID" size="10" value="IITPLS">
					</div>
				</div>
				<div class="form-group row">
					<label for="MESSAGE" class="col-md-3 col-form-label " >CHANNEL</label>
					<div class="col-md-4">
						<input class="form-control" type="text" name="CHANNEL" placeholder="ENTER channel id" size="5" value="1">
					</div>
				</div>
				<div class="form-group row">
					<label for="MESSAGE" class="col-md-3 col-form-label " >Route</label>
					<div class="col-md-4">
						<input class="form-control" type="text" name="ROUTE" placeholder="ENTER route" size="5" value="1">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-3 col-form-label ">Send to</label>
					<div class="col-md-4">
						<select class="form-control"  name="receiver">
							<option value="10">10</option>
							<option value="11" disabled>11</option>
							<option value="12" disabled>12</option>
							<option value="13" disabled>13</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="MESSAGE" class="col-md-3 col-form-label ">MESSAGE</label>
					<div class="col-md-7">
						<textarea id="msg_textarea"class="form-control" rows="4" cols="60" class="form-control" name="msg" id="msg" placeholder="input your message/message template">Hello Mr. {name} congratulations for completing your course {class} on date {test_date}. You have scored  {marks} in this course</textarea>
					</div>
					<script>
						
						// $(document).ready(function(){
						// 	var length = $('#msg_textarea').val().length;
						// 	$('#chars').addClass("btn btn-info");
						// 	$('#chars').append("char : ");
						// });
						// $('#msg_textarea').keyup(function(){
						// 	var length = $('#msg_textarea').val().length;
						// 	$('#chars').text(length).append(" char used");
						// });
						$(document).ready(function(){
							var length = $('#msg_textarea').val().length;
							$('#char').text(length);
						});
						$('#msg_textarea').keyup(function(){
							var length = $('#msg_textarea').val().length;
							$('#char').text(length);
						});
					</script>
					<div class="col-md-2 align-self-end" id="chars" >
						<button class="btn btn-info btn-sm"> Char : <span id="char" ></span> / 160</button>
					</div>

				</div>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-3 col-form-label ">LIVE TEST MESSAGE NOW</label>
					<div class="col-md-4">
						<select class="form-control"  name="test_msg">
							<option value="N" selected>No</option>
							<option value="Y">Yes</option>
						</select>
					</div>
				</div>
				<div align="center" style="color: red;">If checked "YES" it will currently send message to Yash Sir(888xxxxx46), Chirag Sir(772xxxxx40) & Sumit Kr Singh (992xxxxx77)</div> 
				<br>
				<div align="center">
					<button class="btn btn-success" type="submit" name="submit" style="margin: 10px;">SEND &nbsp;<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>

<?php
if(isset($_REQUEST['submit'])){

	include 'config.php';
	define('APIKey',$_POST['APIKEY']);
	define('SENDER_ID',$_POST['SENDER_ID']);
	define('CHANNEL',$_POST['CHANNEL']);
	define('DCS','0');
	define('FLASH_SMS','0');
	define('ROUTE',$_POST['ROUTE']);

	$sql ="SELECT * FROM studentdata WHERE class=10";
	$query_result=mysqli_query($db,$sql);
	while($data = mysqli_fetch_array($query_result)){
	// $template ="Hello Mr. {name} congratulations for completing your course {class} on date {test_date}. You have scored  {marks} in this course.";
		$template = $_POST['msg'];
		$msg=$template;
		foreach ($data as $key => $value) {
			$msg=str_replace("{{$key}}",$value, $msg);
		}
		urlencode($msg);
		echo "YOUR MESSAGE:-<br>".$msg;
		echo "<br>";

		$url="https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=".APIKey."&senderid=".SENDER_ID."&channel=".CHANNEL."&DCS=".DCS."&flashsms=".FLASH_SMS."&number=".$data['mob_no']."&text=".urlencode($msg)."&route=".ROUTE;
		echo "YOUR URL:-<br>".$url;
		echo "<br><br><br>";
		if($_POST['test_msg']=='Y'){
			$cSession = curl_init(); 

			curl_setopt($cSession,CURLOPT_URL,$url);
			curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cSession,CURLOPT_HEADER, false); 

			$result=curl_exec($cSession);

			curl_close($cSession);

			echo $result;	
		}



	}
}
?>