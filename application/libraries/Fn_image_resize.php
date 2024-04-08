<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fn_image_resize{

	function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = ''){
		/* read the source image */
		$source_image = FALSE;
		
		if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
			$source_image = imagecreatefromjpeg($path1);
		}
		elseif (preg_match("/png|PNG/", $file_type)) {
			
			if (!$source_image = @imagecreatefrompng($path1)) {
				$source_image = imagecreatefromjpeg($path1);
			}
		}
		elseif (preg_match("/gif|GIF/", $file_type)) {
			$source_image = imagecreatefromgif($path1);
		}		
		if ($source_image == FALSE) {
			$source_image = imagecreatefromjpeg($path1);
		}
	
		$orig_w = imageSX($source_image);
		$orig_h = imageSY($source_image);
		
		if ($orig_w < $new_w && $orig_h < $new_h) {
			$desired_width = $orig_w;
			$desired_height = $orig_h;
		} else {
			$scale = min($new_w / $orig_w, $new_h / $orig_h);
			$desired_width = ceil($scale * $orig_w);
			$desired_height = ceil($scale * $orig_h);
		}
				
		if ($squareSize != '') {
			$desired_width = $desired_height = $squareSize;
		}
	
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		// for PNG background white-----------
		$kek = imagecolorallocate($virtual_image, 255, 255, 255);
		imagefill($virtual_image, 0, 0, $kek);
		
		if ($squareSize == '') {
			/* copy source image at a resized size */
			imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
		} else {
			$wm = $orig_w / $squareSize;
			$hm = $orig_h / $squareSize;
			$h_height = $squareSize / 2;
			$w_height = $squareSize / 2;
			
			if ($orig_w > $orig_h) {
				$adjusted_width = $orig_w / $hm;
				$half_width = $adjusted_width / 2;
				$int_width = $half_width - $w_height;
				imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
			}
	
			elseif (($orig_w <= $orig_h)) {
				$adjusted_height = $orig_h / $wm;
				$half_height = $adjusted_height / 2;
				imagecopyresampled($virtual_image, $source_image, 0,0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
			} else {
				imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
			}
		}
		
		if (@imagejpeg($virtual_image, $path2, 90)) {
			imagedestroy($virtual_image);
			imagedestroy($source_image);
			return TRUE;
		} else {
			return FALSE;
		}
	}
    
    function createCrop($target,$newcopy,$file_type, $w, $h) {
        
        list($w_orig, $h_orig) = getimagesize($target);
        $src_x = ($w_orig / 2) - ($w / 2);
        $src_y = ($h_orig / 2) - ($h / 2);
        $ext = strtolower($ext);
        $img = "";
        
        if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
            $img = imagecreatefromjpeg($target);
        }
		elseif (preg_match("/png|PNG/", $file_type)) {
			if (!$img = @imagecreatefrompng($target)) {
				$img = imagecreatefromjpeg($target);
			}
		}
		elseif (preg_match("/gif|GIF/", $file_type)) {
			$img = imagecreatefromgif($target);
		}
        else{
            $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
        if (preg_match("/gif|GIF/", $file_type)){ 
            @imagegif($tci, $newcopy);
        } else if(preg_match("/png|PNG/", $file_type)){
            @imagepng($tci, $newcopy);
        } else { 
            @imagejpeg($tci, $newcopy, 90);
        }
    }
    
    
}
?>