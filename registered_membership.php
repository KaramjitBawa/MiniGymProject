<!DOCTYPE html>
<html lang="en">
 <head>
    <title>FITNESS FREAK::Register Membership</title>
    <link rel="stylesheet" type="text/css" href="gym.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
    
    <div id="wrapper">
        <nav>
        <ul>
        <li><a href="home.html">HOME</a></li>
        <li><a href="locations.html">Locations</a></li>
		<li><a href="Diet-plans.html">Diet Plans</a></li>
        <li><a href="pricing-plans.html">Plans & Pricing</a></li>
        <li><a href="registered_membership.php">Join Us</a>
        </ul>
        </nav>  
        <header>
        
        </header>
        <main id="backcol" style="min-height:400px;">
            <h1 id="align">Register 
			<?php echo (isset($_GET['plan']))?"for '".$_GET['plan']."' membership":"";?></h1>
            <p id="error"></p>
            <p id="success" style="font-size: 1.5em;color:green;"></p>
         <form method="POST" onsubmit="return register()" id="newuserform">
			<?php
			if(!isset($_GET['plan'])){
			
			?>
			<label for="pname">Select Plan:</label>
            <select name="myPlan" id="myPlan">
				<option>Black Card</option>
				<option>Standard Card</option>
				<option>4Less Card</option>
			  </select>
			<?php } else{ echo "<input type='hidden' name='myPlan' value='".$_GET['plan']."' >";}?>
            <label for="pname">Name:</label>
            <input type="text" name="myNAME" id="paname" required pattern="[a-z A-Z]{3,}" title="ENter a Valid Name">
            
            <label for="pmob">Mobile No.:</label>
            <input type="text" name="myMob" id="pmob" required pattern="[0-9]{10}" maxlength=10 title="ENter a Valid Mobile No.">
            
            <label for="pmail">E-mail:</label>
            <input type="email" name="myEmail" id="pmail" required>

            <label for="pass">Password:</label>
            <input type="password" for="pass" name="pass" id="pass" pattern=".{6,}" title="ENter minimim 6 characters">
           
            <label for="cpass">Confirm Password:</label>
            <input type="password" for="cpass" name="cpass" id="cpass">
           
            <input type="submit" value="Register Now" id="mySubmit">
        </form>

        </main>
           <footer>
		<p id="copy"> Copyright &copy; 2021 FITNESS FREAK<br></p>
</footer>
    </div>


    <script>


    function register()
    {
        var pass = document.getElementById("pass").value;
        var cpass = document.getElementById("cpass").value;

        if(pass==cpass)
        {
               // return true;
			var BASE_URL = "http://localhost/fitness";
			$.ajax({
				type: 'post',
				url: BASE_URL + "/function/requestUpdate.php?requestType=RegisterForm",
				data: $("#newuserform").serialize(),
				beforeSend: function () {
					//$("#mySubmit").prop('disabled', true).html("<span>Please Wait..</span>");
				},
				success: function (result) {
					var result = JSON.parse(result);		
					if(result.status == 2) {
						$("#error").html("User already exists.");
					}					
					else if(result.status == 1) {	
						$("#error").html("");
						$("#success").html("Congratulations!!! Please show the reference code '"+result.code+"' at GYM for payment.");
						$("#newuserform").hide();
						$("#newuserform")[0].reset();
						setTimeout(function() {
							window.location.href=BASE_URL;
						}, 5000);	
					} else {
						$("#mySubmit").prop('disabled', false).html("<span>Register Now</span>");
						new PNotify({
							title: 'Error',
							text: result.error,
							type: 'error',
							hide: true
						});
					}		
				}
			});
			return false;
        }
        else
        {
            document.getElementById("error").innerHTML="Password Not Matched";
            //alert('password not matched');
            return false;
        }

    }


$(document).ready(function(){
        $("#pmob").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
       
    });

});
              
    </script>
    </body>
</html>
