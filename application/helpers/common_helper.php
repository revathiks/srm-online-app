<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_captcha'))
{
	function get_captcha_bk($from_path = false) {
		// $ci &= get_instance();
		// header ('Content-type: image/png');

		$chars = "012345678901234567abcdefghijklmnopqrstuvwxyz
		ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$captcha_text = '';
		 
		for ($i = 0; $i < CAPTCHA_WORD_LENGTH; $i++) 
		{
		    $captcha_text .= $chars[rand(0, strlen($chars)-1)];
		}	
		
		$captcha_bg = imagecreatefrompng(FCPATH.'assets\common\uploads\captcha\captcha.png'); 
			echo 'captcha_bg => '.$captcha_bg;
		imagettftext( $captcha_bg, 30, 0, 0, 40, imagecolorallocate ($captcha_bg, 0, 0, 0),
		 FCPATH.'assets\common\uploads\captcha\fonts\verdana.ttf', $captcha_text );

		// $_SESSION['captcha'] = $captcha_text;
		// $ci->session->set_userdata($from_path.'_captcha_expected',$captcha_text);
		imagepng($captcha_bg, NULL, 0);
		imagedestroy($captcha_bg);
		die;
	}

	function get_captcha($from_path = false) {
		$ci =& get_instance();

		$img_width = CAPTCHA_IMAGE_WIDTH;
		$img_height = CAPTCHA_IMAGE_HEIGHT;
		$captcha_word_length = CAPTCHA_WORD_LENGTH;
		$captcha_font_path = CAPTCHA_FONT_PATH;
		$my_img = imagecreate( $img_width, $img_height );
	    $background = imagecolorallocate( $my_img, 255, 255, 255 );
	    // $text_colour = imagecolorallocate( $my_img, 70, 128, 116 );
	    $text_colour = imagecolorallocate( $my_img, 68, 82, 204 );
	    $line_colour = imagecolorallocate( $my_img, 126, 168, 158 );

	    $chars = "012345678901234567abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$captcha_text = '';
		 
		for ($i = 0; $i < $captcha_word_length; $i++) 
		{
		    $captcha_text .= $chars[rand(0, strlen($chars)-1)];
		}

		// -----------------------------------
		// Determine angle and position
		// -----------------------------------
		$length	= strlen($captcha_text);
		$angle	= ($length >= $captcha_word_length) ? mt_rand(-($length-$captcha_word_length), ($length-$captcha_word_length)) : 0;
		$x_axis	= mt_rand($captcha_word_length, (360/$length)-16);
		$y_axis = ($angle >= 0) ? mt_rand($img_height, $img_width) : mt_rand($captcha_word_length, $img_height);

		// Create the rectangle
		ImageFilledRectangle($my_img, 0, 0, $img_width, $img_height, $background);
		$captcha_font_size = 40;
		$text_box = imagettfbbox(
			$captcha_font_size,
			0,
			$captcha_font_path,
			$captcha_text
			); 
		$x = ($img_width - $text_box[4])/2;
		$y = ($img_height - $text_box[5])/2;

		imagettftext( $my_img, $captcha_font_size, 0, $x, $y, $text_colour, $captcha_font_path, $captcha_text );

		$ci->session->set_userdata($from_path.'_captcha_expected',$captcha_text);

	    // imagestring( $my_img, 4, 30, 25, $captcha_text, $text_colour );
	    // imagestring( $my_img, 4, 30, 25, "thesitewizard.com", $text_colour );
	    imagesetthickness ( $my_img, 5 );
	    // imageline( $my_img, 30, 45, 165, 45, $line_colour );

	    

	    // -----------------------------------
		//  Create the spiral pattern
		// -----------------------------------
		/*$theta		= 0.1;
		$thetac		= 7;
		$radius		= 10;
		$circles	= 20;
		$points		= 5;

		for ($i = 0, $cp = ($circles * $points) - 1; $i < $cp; $i++)
		{
			$theta += $thetac;
			$rad = $radius * ($i / $points);
			$x = ($rad * cos($theta)) + $x_axis;
			$y = ($rad * sin($theta)) + $y_axis;
			$theta += $thetac;
			$rad1 = $radius * (($i + 1) / $points);
			$x1 = ($rad1 * cos($theta)) + $x_axis;
			$y1 = ($rad1 * sin($theta)) + $y_axis;
			imageline($my_img, $x, $y, $x1, $y1, $line_colour);
			$theta -= $thetac;
		}*/
	    // $my_img2 = imagecreatefromjpeg(base_url('assets/common/images/captcha_bg.jpg'));
	    // Merge the stamp onto our photo with an opacity (transparency) of 50%
		// imagecopymerge($my_img, $my_img2);

	    ob_start();
	    imagepng( $my_img );
	    $image_string = ob_get_flush();
	    $imageb64 = base64_encode($image_string);
	    // imagecolordeallocate( $line_color,0 );
	    // imagecolordeallocate( $text_color,0 );
	    // imagecolordeallocate( $background,0 );
	    imagedestroy( $my_img );
	    ob_end_clean();
	    $url = "data:image/png;base64,".$imageb64;
	    return $url;
	}
}
if ( ! function_exists('get_current_session_name'))
{
	function get_current_session_name() {
		$ci =& get_instance();
		$session_name = [];
		// get current directory name
		$script_name = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
		$session_name[] = str_replace('/', '', $script_name);
		// get current domain name
		$session_name[] =  $_SERVER['SERVER_NAME'];
		$session_name = array_filter($session_name);	
		$session_name = implode('_',$session_name);
		$ci->load->helper('security');
		$session_name = $ci->security->sanitize_filename($session_name);
		// echo 'session_name => '.$session_name;
		$session_name = do_hash($session_name);
		// echo 'script_name => '.$script_name."\n";
		// echo 'server_name => '.$server_name."\n";
		// return ($server_name !== false)?$server_name:$script_name;
		return $session_name;
	}
}

if ( ! function_exists('remove_file_separator'))
{
	function remove_file_separator($filename = false, $truncate = false) {
		if($filename) {
			$upload_file_separator = UPLOAD_FILE_SEPARATOR;
			$upload_file_separator_len = strlen($upload_file_separator);
		    if(strpos($filename, $upload_file_separator) !== false) {
		    	$filename = substr($filename, (strpos($filename, $upload_file_separator)+$upload_file_separator_len));
		    	if($truncate == true) {
		    		$filename = truncate_filename($filename);	
		    	}
		    }	
		}
		return $filename;
	}
}

if( ! function_exists('truncate_filename'))
{
	function truncate_filename($longString = false) {
		// $longString = 'abcdefghijklmnopqrstuvwxyz0123456789z.jpg';
		$separator = '...';
		$longStringlength = strlen($longString) ;
		$separatorlength = strlen($separator) ;
		if($longStringlength >= 25) {
			$maxlength = 25 - $separatorlength;
			$start = $maxlength / 2 ;
			$trunc =  strlen($longString) - $maxlength;
			return substr_replace($longString, $separator, $start, $trunc);		
		} else {
			return $longString;
		}
	}
}

if( ! function_exists('allow_extension'))
{
	function allow_extension($file_allowed_type = false){
		$allowed_type = false;
		if($file_allowed_type) {
			$allowed_type = '.'.str_replace('|',', .',$file_allowed_type);
		}
		return $allowed_type;
	}
}