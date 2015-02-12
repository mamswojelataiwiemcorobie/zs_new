<?

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
    if(!isset($pct)){
        return false;
    }
    $pct /= 100;
    // Get image width and height
    $w = imagesx( $src_im );
    $h = imagesy( $src_im );
    // Turn alpha blending off
    imagealphablending( $src_im, false );
    // Find the most opaque pixel in the image (the one with the smallest alpha value)
    $minalpha = 127;
    for( $x = 0; $x < $w; $x++ )
    for( $y = 0; $y < $h; $y++ ){
        $alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF;
        if( $alpha < $minalpha ){
            $minalpha = $alpha;
        }
    }
    //loop through image pixels and modify alpha for each
    for( $x = 0; $x < $w; $x++ ){
        for( $y = 0; $y < $h; $y++ ){
            //get current alpha value (represents the TANSPARENCY!)
            $colorxy = imagecolorat( $src_im, $x, $y );
            $alpha = ( $colorxy >> 24 ) & 0xFF;
            //calculate new alpha
            if( $minalpha !== 127 ){
                $alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha );
            } else {
                $alpha += 127 * $pct;
            }
            //get the color index with new alpha
            $alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha );
            //set pixel with the new color + opacity
            if( !imagesetpixel( $src_im, $x, $y, $alphacolorxy ) ){
                return false;
            }
        }
    }
    // The image copy
    imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);
}

define("ZNAK_WODNY", false);

if (empty($_GET['url']) || empty($_GET['w']) || empty($_GET['h'])) die();

$url = $_GET['url'];
$w = $_GET['w'];
$h = $_GET['h'];
$q = !empty($_GET['q']) ? $_GET['q'] : 80;
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'zoom';

if ($w > 2000 || $h > 2000) die();

$dir = dirname($url);
$minidir = '_gfx/_mini/'.$mode.'/'.$dir;
$file = $_GET['url'];
$minifile = $minidir.'/'.$w.'x'.$h.'x'.$q.'_'.basename($url);
#echo getcwd();
#echo $minidir;
if (is_file($file)) {
	if (is_file($minifile) && (filemtime($minifile) > filemtime($file))) { # jest miniatura i jest starsza od oryginalu
		
		exit ();
	} else {
		if (!is_dir($minidir)) {
			mkdir($minidir,0777,true);
			if (!is_dir($minidir)) die();
		}
		if (sprintf('%o', fileperms($minidir), -4) != '0777') {
			@chmod($minidir, 0777);
		}
		$max_width = $w;
		$max_height = $h;
		$img_info = @getimagesize($file);
		if ($img_info === false) {
			die(); # jak nie ma takiego pliku
			$file = '_gfx/nophotobig.gif';
			$img_info = @getimagesize($file);
		}
		$old_width = $img_info[0];
		$old_height = $img_info[1];
		$mime = $img_info['mime'];
		if ($old_width < $max_width && $old_height < $max_height) {
			$max_width = $old_width;
			$max_height = $old_height;
			/*header ("Content-type: ".$img_info['mime']);
			echo file_get_contents($file);
			exit ();*/
		}
		switch ($mode) {
			case "canvas" :
				$old_rel = $old_width / $old_height;
				$new_rel = $max_width / $max_height;
				if ($old_rel > $new_rel) {
					$tmp = $old_height * $max_width / $max_height;
					$a_width = floor(($old_width-$tmp) / 2);
					$old_width = $tmp;
				} elseif ($old_rel < $new_rel) {
					$tmp = $old_width * $max_height / $max_width;
					$a_height = floor(($old_height-$tmp) / 2);
					$old_height = $tmp;
				} else {
				}
				$new_width = $max_width;
				$new_height = $max_height;
				break;
			case "zoom" :
				$rel_width = $old_width/$max_width;
				$rel_height = $old_height/$max_height;
				if ($rel_height < $rel_width) { $new_width = $max_width; $new_height = $old_height/$rel_width; settype($new_height, "int"); }
				if ($rel_height > $rel_width) { $new_height = $max_height; $new_width = $old_width/$rel_height; settype($new_width, "int"); }
				if ($rel_height == $rel_width) { $new_height = $max_height; $new_width = $max_width; }				
				break;
		}
		$new_img = imagecreatetruecolor($new_width, $new_height);

		switch($img_info['mime'])
		{
			case 'image/jpeg': $old_img = @imagecreatefromjpeg($file); break;
			case 'image/png': $old_img = @imagecreatefrompng($file); break;
			case 'image/gif': $old_img = @imagecreatefromgif($file); break;
		}

		if (ZNAK_WODNY) {
			$src = imagecreatefrompng('znak_wodny.png');
			$src_x = imagesx($src);
			$src_y = imagesy($src);

			// SAME COMMANDS:
			imagecopymerge_alpha($old_img, $src, ($old_width-$src_x)/2, ($old_height-$src_y)/2, 0, 0, $src_x, $src_y, 50);
			imagesavealpha($old_img, true);
		}

		switch ($mode) {
			case "canvas" :
				imagecopyresampled($new_img, $old_img, 0, 0, $a_width, $a_height, $new_width, $new_height, $old_width, $old_height);
				break;
			case "zoom" :
				imagecopyresampled($new_img, $old_img, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
				break;
		}

		switch($img_info['mime'])
		{
			case 'image/jpeg': imagejpeg($new_img, $minifile, $q); break;
			case 'image/png': imagepng($new_img, $minifile); break;
			case 'image/gif': imagegif($new_img, $minifile); break;
		}
		imagedestroy($old_img);
		imagedestroy($new_img);
		header ("Content-type: ".$img_info['mime']);
		$last_modified_time = filemtime($minifile);
		$etag = md5_file($minifile);

		header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
		header("Etag: $etag");
		
		echo file_get_contents($minifile);
	}
} else {
	header("HTTP/1.1 404 Not Found");
	exit;
}

?>