<?php if(isset($_POST["first_name"]))  
{
	// Read the form values
	$success = false;
	$first_name = isset( $_POST['first_name'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['first_name'] ) : "";
	$last_name = isset( $_POST['last_name'] ) ? preg_replace( "/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['last_name'] ) : "";
	$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
	$message = isset( $_POST['contact_message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['contact_message'] ) : "";
	
	//Headers
	$to = "your_email@mail.com";
    $subject = 'Contact Us';
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	//body message
	$message = 
	"First Name: ". $first_name . "<br>
	Last Name: ". $last_name . "<br>
	Email: ". $senderEmail . "<br>
	Message: " . $message . "";
	
	//Email Send Function
    $send_email = mail($to, $subject, $message, $headers);
      
    echo ($send_email) ? '<div class="success">Email has been sent successfully.</div>' : 'Error: Email has not been sent.';
} else {
	echo '<div class="failed">Failed sending your email.</div>';
}
?>