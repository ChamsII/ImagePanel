#!/usr/bin/env php
<?php
// parse_lien.php for parseliens in /home/alimou_c/image_panel
// 
// Made by ALI MOUIGNI Chamsoudine
// Login   <alimou_c@etna-alternance.net>
// 
// Started on  Fri Nov  7 09:53:53 2014 ALI MOUIGNI Chamsoudine
// Last update Sat Nov  8 18:00:21 2014 ALI MOUIGNI Chamsoudine
//
include_once 'verife.php';
include_once 'creat_image.php';
include_once 'function_utils.php';
include_once 'function_sort.php';
 
$tab_images = [];
$tab_urls = [];
$base_name;
$options = "";
$nb_images = 0;

function	parse_liens($url_name, $base)
{
  global $tab_images;
  $contents = file_get_contents($url_name);
  if (preg_match_all('#<img[^>]+src="([^"]+)"[^>]*>#', $contents, $matches))
    {
      $i = 0;
      while (isset($matches[1][$i]))
	{
	  if(!preg_match('#background#', $matches[1][$i]))
	    {
	      if(!preg_match('#_?bg_?#', $matches[1][$i])){
		if (check_find_url($matches[1][$i]) == 0)
		  $tab_images[] = $matches[1][$i];
		else
		  $tab_images[] = "{$url_name}/{$matches[1][$i]}";
	      }
	    }
	  $i++;
	}
    }
}

function	sans_option($pargc, $pargv)
{
  global $tab_urls;
  global $base_name;
  global $nb_images;
  $i = 1;
  while ($i < $pargc){
    if (check_url($pargv[$i]) === true)
      $tab_urls[] = $pargv[$i];
    $i++;
  }
  if (!check_url($pargv[$i - 1]))
    $base_name = $pargv[$i -1];
      else
        options_and_aff("error");
  /* create_image_and_pannel */
}

function	avec_options($pargc, $pargv)
{
  global $tab_urls;
  global $base_name;
  global $nb_images;
  global	$options;
  $i = 1;
  $j = 1;
  while ($i < $pargc)
    {
      if(preg_match('#(-[gjlnNps]{1,7}){1,7}#', $pargv[$i]))
	{$options .= $pargv[$i];
      if (preg_match('#(-*[l]{1,7}){1,7}#', $pargv[$i]))
	{
	  if (intval($pargv[$i + 1] == 0))
	    options_and_aff("error");
	  else
	    {
	      $i++;
	      $nb_images = intval($pargv[$i]);
	      if ($nb_images > 20)
		options_and_aff("error20");
	    }
	}
	}
      else if (check_url($pargv[$i]) === true)
	$tab_urls[] = $pargv[$i];
      $i++;
    }
  if(!check_url($pargv[$i-1]))
    $base_name = $pargv[$i -1];
  else if (is_dir($pargv[$i-1]))
    /* options_and_aff("dir");*/
    $base_name = $pargv[$i -1];
  else
    options_and_aff("error_");
  /* create_image_and_pannel */

}

function	read_liens($pargc, $pargv)
{
  if ($pargc <= 2 )
     options_and_aff("error");
  else if ($pargv[1] == "help")
    options_and_aff("help");
  else if ($pargc == 1)
      options_and_aff("error");
  else if (check_url($pargv[1]) === true) /* if no options : ./imagepanel.php ./mon_site/index.html mon_site*/
    {
      sans_option($pargc, $pargv);
    }
  else if (check_url($pargv[1]) === false) { /* If options : exempels : ./imagepanel.php -pl 20 ./mon_site/index.html mon_site*/
    avec_options($pargc, $pargv);
  }

}

/********************************* teste **************************************/
read_liens($argc, $argv);
$i = 0;
while ($i < count($tab_urls))
  {
    parse_liens($tab_urls[$i], $base_name);
    $i++;
  }

if (count($tab_urls) >= 2){
echo " ----------------------------- get urls------------------------------\n";
$i = 0;
while (isset($tab_urls[$i]))
  {
    calcul_tbarre($i, count($tab_urls));
    $i++;
  }
}
if (count($tab_images) > 0){
echo " ---------------------------parsing liens for images ----------------------------\n";
$i = 0;
while (isset($tab_images[$i]))
  {
    calcul_tbarre($i, count($tab_images));
    $i++;
  }

if (!is_dir($base_name)) {
  mkdir($base_name);
}
if ($nb_images == 0)
  $nb_images = 20;
if (check_char($options, 's'))
  {
    echo " ---------------------------sort images ----------------------------\n";
    $tab_images = sort_images(count($tab_images), $tab_images);
  }
echo " ---------------------------create images ----------------------------\n";
creat_image($tab_images, $base_name, $options, $nb_images);

$nb_image = count($tab_images);
echo "{$nb_image} images trouvÃ©es\n\n";

}