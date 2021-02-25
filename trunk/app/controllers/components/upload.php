<?php

/**
 * Upload Component, responsible for uploading images .
 * @package
 */
class UploadComponent extends Object {

   public $PbTempFile;
   public $PbDestinationDirFile;
   public $PbDestinationDir;
   public $PbNewFileName;

   public function uploadNewFile() {
	  //print $_SERVER["DOCUMENT_ROOT"]; die();

	  $data     = $this->PbTempFile;
	  $dest     = $this->PbDestinationDirFile;
	  $destPath = $this->PbDestinationDir;
	  $output   = $this->PbNewFileName;

	  $MAX_WIDTH  = 200;
	  $MAX_HEIGHT = 400;

	  $pic_width  = 200;
	  $pic_height = 400;

	  if (!is_dir($destPath)) {
		 mkdir($destPath, 0777);
	  }

	  $imagePath = substr($output, 0, 6) . "/";
	  $filename  = $data;
	  $setLogo   = 2; // 1 - text / 2 - image

	  /*
	  list($width, $height) = getimagesize($filename);
	  // ............. defaul values.........................
			 $dsizew = 200;
	  //................resize process.......................
			 $divider = $width / $dsizew;
			 $newwidth =  $dsizew;
			 $newheight = $height / $divider;
	  //.....................................................
	  */

	  // NEW  Dimension
	  list($width, $height) = getimagesize($filename);
	  $scale = min($MAX_WIDTH / $width, $MAX_HEIGHT / $height);

	  $new_width  = round($scale * $width);
	  $new_height = round($scale * $height);

	  if ($pic_width) {
		 $newwidth = $new_width;
	  }
	  else {
		 $newwidth = 100;
	  }
	  if ($pic_height) {
		 $newheight = $new_height;
	  }
	  else {
		 $newheight = 70;
	  }
	  //.....................................................
	  $thumb = imagecreatetruecolor($newwidth, $newheight);

	  if (strstr($_FILES['data']['type']['images']['File'], "jpeg")) {
		 //image/jpeg
		 $source = imagecreatefromjpeg($filename);
	  }
	  else if (strstr($_FILES['data']['type']['images']['File'], "gif")) {
		 //image/jpeg
		 $source = imagecreatefromgif($filename);
	  }
	  else if (strstr($_FILES['data']['type']['images']['File'], "png")) {
		 //image/jpeg
		 $source = imagecreatefrompng($filename);
	  }

	  //imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	  imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	  if ($this->isNude) {
		 /*
		 imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
		 imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
		 imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
		 imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
		 imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
		 */
		 imagefilter($thumb, IMG_FILTER_CONTRAST, -15);
	  }

	  imagefilter($thumb, IMG_FILTER_CONTRAST, -15);
	  //imagefilter($thumb, IMG_FILTER_CONTRAST, -10);

	  ////////////////////////////////////////////////////////////////////////////
	  //
	  //	* Set text as logo
	  //
	  ////////////////////////////////////////////////////////////////////////////

	  if ($setLogo == 1) {
		 $iOut = imagecreatetruecolor(($newwidth), ($newheight));
		 // Set a White & Transparent Background Color
		 imagesavealpha($iOut, true); //keep transparency
		 $bg = ImageColorAllocateAlpha($iOut, 255, 255, 255, 127);

		 $black   = ImageColorAllocate($iOut, 0, 0, 0);
		 $turq    = ImageColorAllocate($iOut, 75, 200, 150);
		 $red     = ImageColorAllocate($iOut, 255, 0, 0);
		 $green   = ImageColorAllocate($iOut, 0, 192, 0);
		 $blue    = ImageColorAllocate($iOut, 0, 0, 255);
		 $yellow  = ImageColorAllocate($iOut, 255, 255, 0);
		 $white   = ImageColorAllocate($iOut, 255, 255, 255);
		 $orange  = ImageColorAllocate($iOut, 247, 74, 0);
		 $reddark = ImageColorAllocate($iOut, 196, 17, 0);

		 imageString($thumb, 6, 3, 0, "www.publion.ro", $orange);
		 //ImageString($image, $font_size, $x, $y, $string, $color);
	  }

	  ////////////////////////////////////////////////////////////////////////////
	  //
	  //	* Set image as logo
	  //
	  ////////////////////////////////////////////////////////////////////////////

	  if ($setLogo == 2) {
		 $linkLogoPub = "../../app/webroot/img/publognt2.png";
		 $iTmp        = imagecreatefrompng($linkLogoPub);
		 imagealphablending($iTmp, true);
		 imagesavealpha($iTmp, true);
		 //imagefilter($iTmp, IMG_FILTER_CONTRAST, -10);

		 //imagecopymerge($iOut, $imgBuf[$hk], $arPos[3],$arPos[0], 0, 0, imagesx($imgBuf[$hk]),imagesy($imgBuf[$hk]), 99);
		 //$image, $font_size, $x, $y, $string, $color
		 imagecopy($thumb, $iTmp, 0, 0, 0, 0, imagesx($iTmp), imagesy($iTmp));
		 imagedestroy($iTmp);
	  }

	  ////////////////////////////////////////////////////////////////////////////
	  //
	  //	* Save the final image
	  //
	  ////////////////////////////////////////////////////////////////////////////

	  imagejpeg($thumb, $dest, 100);
	  //..........................................................................................
	  return true;
   }

}

/*
print "<pre>";	print_r($_FILES);	die();

D:\xampp\tmp\php9404.tmpArray
(
    [data] => Array
        (
            [name] => Array
                (
                    [images] => Array
                        (
                            [File] => audi-A6-1941741.jpg
                        )

                )

            [type] => Array
                (
                    [images] => Array
                        (
                            [File] => image/jpeg
                        )

                )

            [tmp_name] => Array
                (
                    [images] => Array
                        (
                            [File] => D:\xampp\tmp\php9404.tmp
                        )

                )

            [error] => Array
                (
                    [images] => Array
                        (
                            [File] => 0
                        )

                )

            [size] => Array
                (
                    [images] => Array
                        (
                            [File] => 49061
                        )

                )

        )

)

*/

