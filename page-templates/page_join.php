<?php
/* Template Name: Join Us */
/**
 * The template for displaying pages
 */
 
 /* Clean collected form data prior to building email message to reduce risk of script attacks */
	function check_input($data)	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}	

/* Email addresses to send this information to */
$sendto = 'nancy.maclean@duke.edu,lawcha@duke.edu';
/* Subject line of the email message */
$subject = '[LAWCHA] New Member Information';
/* Email address to set as the "from" info */
$from = 'lawcha@duke.edu';


if($_REQUEST['submitinfo']=='Submit') {
	/* Process the form */
	$thename = check_input($_REQUEST['thename']);
	$affiliation = check_input($_REQUEST['affiliation']);
	$info = check_input($_REQUEST['info']);
	$expectations = check_input($_REQUEST['expectations']);
	$contact = check_input($_REQUEST['contact']);
	$position = check_input($_REQUEST['position']);
	$interests = check_input($_REQUEST['interests']);
	$interests_other = check_input($_REQUEST['interests_other']);
	$how_hear = check_input($_REQUEST['howhear']);
	
	$message = '';
	
	/* AT THE LEAST a name must be entered for it to submitted */
	$all = trim($thename);
	if(!empty($all) && $_REQUEST['last'] == '') {
		$message =	wordwrap("A possible new member has submitted some information on the LAWCHA join page.\n\n".
					"- Name: " . $thename . "\n\n".
					"- Contact\n" . $contact . "\n\n".
					"- Affiliation: " . $affiliation . "\n\n".
					"- Position: " . $position . "\n\n".
					"- Info\n".$info."\n\n".
					"- Interests: " . $interests . "\n\n".
					"- Interests (other): " . $interests_other . "\n\n".
					"- How Did They Hear: " . $how_hear . "\n\n" .
					"- Expectations\n".$expectations."\n\n",70);
		$headers = 	'From: ' . $from . "\r\n" .
					'Reply-To: ' . $from . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		mail($sendto, $subject, $message, $headers);
		
		// Process the contents to be CSV safe
		$row = array($thename, $contact, $affiliation, $position, $info, $interests, $interests_other, $how_hear, $expectations, date("Y-m-d"));
		$row = str_replace(array("\r","\n","\r\n", "\t"), ' ', $row);
		foreach($row as $key => $val) $row[$key] = '"'.$val.'"';

		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/private/new_members.csv', implode(",\t",$row)."\n", FILE_APPEND);
		
		/* Redirect them to the DUP join website */
		header('Location: http://dukeupress.edu/lawcha');
		
		//echo '<strong>Thank you for the information!</strong> We value our members and appreciate the opportunity to learn more about them.';
		//echo '<br /><br />You are being redirected to the Duke University Press website that will allow you to join LAWCHA. ';
		//echo 'If you are not redirected soon, <a href="http://www.dukeupress.edu/Societies/societyDetail.php?societyid=8">click here</a> to navigate there.';
		$message = '<div class="success message"><p>Your information has been submitted. To fully register for membership, please navigate to our <a href="http://dukeupress.edu/lawcha">Duke University Press Membership Page</a>.</p><p style="text-align:center"><a href="http://dukeupress.edu/lawcha">Continue to Step 2 &rarr;</a></p></div><hr />';
					
	} else {
		$message = '<div class="error message"><p>You must enter a name for the form to be submitted!</p></div><hr />';
	}
}
 
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main type" role="main">
		<?=$message?>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part('content', 'page');

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
