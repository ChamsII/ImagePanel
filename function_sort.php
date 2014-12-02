<?php
// function_sort.php for fonction_sort in /home/alimou_c/image_panel/erroui_b
// 
// Made by ALI MOUIGNI Chamsoudine
// Login   <alimou_c@etna-alternance.net>
// 
// Started on  Sat Nov  8 17:21:43 2014 ALI MOUIGNI Chamsoudine
// Last update Sat Nov  8 18:11:39 2014 ALI MOUIGNI Chamsoudine
//
include_once 'function_utils.php';

function	sort_images($nb, $param)
{
  $tamp;
  $arg = $param;
  for ($i = 0; $i < $nb; $i++)
    {
      for ($j = $i + 1; $j < $nb; $j++)
	{
	  if (my_strcmp($arg[$i], $arg[$j]) == 1)
	    {
	      $tamp = $arg[$i];
	      $arg[$i] = $arg[$j];
	      $arg[$j] = $tamp;
	    }
	}
      calcul_tbarre($i, count($param));
    }
  return ($arg);
}


function	my_strcmp($s1, $s2)
{
  $i = 0;
  while (strlen($s1) > $i && strlen($s2) > $i)
    {
      if (ord($s1[$i]) == ord($s2[$i]))
	$i += 1;
      else
	break;
    }
  if ($i == strlen($s1))
    return (0);
  while ($i < strlen($s1) && $i < strlen($s2))
    {
      if (ord($s1[$i]) > ord($s2[$i]))
	return (1);
      if (ord($s1[$i]) < ord($s2[$i]))
	return (-1);
      else
	$i += 1;
    }
  return ($i == strlen($s1) ? -1 : 1);
}