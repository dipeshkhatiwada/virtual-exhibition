<?php

namespace App;
use Image;
use Illuminate\Database\Eloquent\Model;
use App\library\MyImage;

class Imagetool extends Model
{

 



  
	 

    public static function resize($filename, $width, $height) {
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . $filename . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
					Image::make(DIR_IMAGE .$old_image)->resize($width, $height)->save(DIR_IMAGE.$new_image);
				
				
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		
			return 'image/' . $new_image;
		
	}

	public static function crop($filename, $width, $height) {
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . $filename . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
					Image::make(DIR_IMAGE .$old_image)->crop($width,$width,$height,$height)->save(DIR_IMAGE.$new_image);
				
				
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		
			return 'image/' . $new_image;
		
	}




	public static function mycrop($myfilename, $width, $height, $default = '') {

			if (!is_file(DIR_IMAGE . $myfilename)) {
			return;
		}
		$quality = 80;


		$extension = pathinfo($myfilename, PATHINFO_EXTENSION);

		$old_image = $myfilename;
		$new_image = 'cache/' . $myfilename . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE . $old_image);
				 
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return DIR_IMAGE . $old_image;
			}
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

		if ($width_orig != $width || $height_orig != $height) {
				$image = new MyImage(DIR_IMAGE . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}
		
		$new_image = str_replace(' ', '%20', $new_image);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		
		return 'image/' . $new_image;
		
	}




}
