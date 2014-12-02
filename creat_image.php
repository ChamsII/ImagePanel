<?php
// creat_image.php for creer les images in /home/alimou_c/image_panel/erroui_b
// 
// Made by ALI MOUIGNI Chamsoudine
// Login   <alimou_c@etna-alternance.net>
// 
// Started on  Fri Nov  7 16:57:24 2014 ALI MOUIGNI Chamsoudine
// Last update Sat Nov  8 18:40:54 2014 ALI MOUIGNI Chamsoudine
//
   /* Fonction creer les images */
include_once 'function_utils.php';

function         create_my_image($mode)
{
  $image = "";
  if (url_not($mode) == 0){
  if (preg_match('#.*(jpg)#', $mode))
    {
      try{
	$image = @imagecreatefromjpeg($mode);
      }catch (Exception $e){
	echo "Not a image jpg !\n";
      }
    }
  else if (preg_match('#.*(gif)#', $mode))
    {
      try{
	$image = @imagecreatefromgif($mode);
      }catch(Exception $e){
	echo "Not a image gif !\n";
      }
    }
  else if (preg_match('#.*(png)#', $mode))
    {
      try{
	$image = @imagecreatefrompng($mode);
      }catch(Exception $e){
	echo "Not a png image !\n";
      }
    }
   }
  return ($image);
}

function	has_next($array)
{
  if (is_array($array))
    {
      if (next($array) === false) {
	return false;
      } else {
	return true;
      }
    } else {
    return false;
  }
}

function	creat_image($tab_images, $base_name, $options, $nb_images)
{
  if (!empty($tab_images)){
    $nb = 1;
    $level = 0;
    do{
      $widh = 1560;
      $heig = 1089;
      $nb_im = 1;
      $destination = imagecreatetruecolor($widh, $heig);
      $white = imagecolorallocate($destination, 255, 255, 255);
      $textcolor = imagecolorallocate($destination, 0, 0, 255);
      imagefilledrectangle($destination, 0, 0, $widh, $heig, $white);
      $mode = current($tab_images);
      for ($x = 10; $x < $heig; $x = $x + 270)
	{
	  for ($y = 10; $y < $widh; $y = $y + 310)
	    {
	      calcul_tbarre($level, count($tab_images));
	      $level += 1;
	      $image = create_my_image($mode);
	      if (!empty($image)){
		if ($nb_im <= $nb_images)
		  {
		    imagecopyresampled($destination, $image, $y, $x, 0, 0, 300, 250,  imagesx($image), imagesy($image));
		    if (check_char($options, 'N')){
		      $string = name_ext($mode);
		      imagestring ($destination , 5, ($y+4) ,($x+4) , $string , $textcolor);
		    }
		    if (check_char($options, 'n')){
                      $string = get_name($mode);
                      imagestring ($destination , 5, ($y+4) ,($x+4) , $string , $textcolor);
                    }
		}
		  $nb_im += 1;
	      }else
		$y = $widh;
	    /*	      imagecopy($destination, $image, $x, $y, 0, 0, imagesx($image), imagesy($image));*/
	      if (has_next($tab_images))
		$mode = next($tab_images);
	    }
	  if ($nb_im > $nb_images)
	    $x = $heig;
    }
   if (check_char($options, 'j')){
	if ($nb == 1)
	  imagejpeg($destination, $base_name."/".$base_name.".jpg");
	else
	  imagejpeg($destination, $base_name."/".$base_name."".$nb.".jpg");
      }
   if (check_char($options, 'p')){
	if ($nb == 1)
          imagepng($destination, $base_name."/".$base_name.".png");
	else
          imagepng($destination, $base_name."/".$base_name."".$nb.".png");
      }
   	if (check_char($options, 'g')){
	if ($nb == 1)
          imagegif($destination, $base_name."/".$base_name.".gif");
	else
          imagegif($destination, $base_name."/".$base_name."".$nb.".gif");
      }
    if ($options == "") {
        if ($nb == 1)
          imagejpeg($destination, $base_name."/".$base_name.".jpg");
        else
          imagejpeg($destination, $base_name."/".$base_name."".$nb.".jpg");
      }
      imagedestroy($destination);
      $nb += 1;
    }while (has_next($tab_images));
  }
}