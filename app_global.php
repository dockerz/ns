<?php	

	session_start ();

	// client specific constants
	define ('DEV', TRUE);
	define ('USER_INFO', TRUE);
	define ('ROOT', '../'); // this can be removed
	define ('CLIENT', 'Cinefex');
	define ('POLICY_LIMIT', '5'); // how many max promo codes a user is allowed
	define ('DOMAIN', 'munumunu.com');
	define ('LOGIN', 'http://www.' . DOMAIN . '/admin/'); // where the new admin link takes new admins from invitation email
	define ('DELIMITER', ','); // delimiter for db queries
	
	// email constants
	// set the webmaster's email account to webmaster@foo.com. this email address must actually exist.
	// if this address doesn't exist, someone may not get an email, as it may be rendered spam by the receiving isp.
	define ('MESSAGE_HEADERS', "From: webmaster@" . DOMAIN . "\nReply-To: webmaster@" . DOMAIN . "\nX-Mailer: PHP/" . phpversion()) ;

	// db setup
	define ('DB_USER', 'dockerz2');
	define ('DB_PASSWORD', 'p!gl3t$!');
	define ('DB_HOST', 'scribbler-host.donaldzrainwater.com');
	define ('DB_NAME', 'scribbler_db_dzr');

	$mysqli = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// data sanitizer
	function escape_data ($data) {
		global $mysqli;
		if (ini_get ('magic_quotes_gpc')) {
			$data = stripslashes ($data);
		}
		return mysqli_real_escape_string ($mysqli, trim (strip_tags ($data)));
	}

	// salt for password encryption / decryption
	function salty ($p) { // sha1 & md5 double encryption for extra security
		return sha1 (escape_data ($p)) . md5 (escape_data ($p));		
	}

	function indexof ($needle, $haystack) {
		if ($needle == (preg_replace ('/' . DELIMITER . '.*/', '', $haystack))): return TRUE; endif;
		if (strpos ($haystack, DELIMITER . $needle . DELIMITER)): return TRUE; endif;
		if ($needle == (preg_replace ('/.*' . DELIMITER . '/', '', $haystack))): return TRUE; endif;
		return FALSE;
	}

?>