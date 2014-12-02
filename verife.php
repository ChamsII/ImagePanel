<?php
// verife.php for fonctions_utils in /home/alimou_c/image_panel/erroui_b
// 
// Made by ALI MOUIGNI Chamsoudine
// Login   <alimou_c@etna-alternance.net>
// 
// Started on  Sat Nov  8 14:49:40 2014 ALI MOUIGNI Chamsoudine
// Last update Sat Nov  8 17:21:17 2014 ALI MOUIGNI Chamsoudine
//

function check_option($params)
{
 $option = "";
  if (strlen($params)>=2 && $params[0]== '-')

  for ($i=1; $i< strlen($params);  $i++)
    if(!$option)
      $option .=$params[$i];
else 
  {
    if (check_char($option,$params[$i])==0 && ($params[$i] != '-'))
      $option .= $params[$i];
  }
  return ($option);
}

function check_char($param,$c)
{
  $i = 0;
  while ($i < strlen($param))
    {
      if ($param[$i] == $c )
	return (1);
      else 
	$i++;
    }
  return (0);
}
