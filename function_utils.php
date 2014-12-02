<?php
// function_utils.php for fonctions_utils in /home/alimou_c/image_panel/erroui_b
// 
// Made by ALI MOUIGNI Chamsoudine
// Login   <alimou_c@etna-alternance.net>
// 
// Started on  Sat Nov  8 14:49:40 2014 ALI MOUIGNI Chamsoudine
// Last update Sat Nov  8 17:21:17 2014 ALI MOUIGNI Chamsoudine
//

function        check_find_url($param)
{
  if (substr($param, 0, 4) == "www."
      or substr($param, 0, 7) == "http://"
      or substr($param, 0, 8) == "https://")
    return (0);
  else
    return (1);
}

function        check_url($param)
{
  $p = $param;
  $url = @fopen($p, "r");
  if($url)
    return (true);
  else
    return (false);
}

function options_and_aff($param)
{
  if ($param == "help")
    {
      echo "\n ------------------------------------------------------------------\n";
      echo " ./imagepanel.php -[options] [taille] ./mon_site/index.html name_image \n";
      echo "\n\n";
      echo "-g  : La ou les images gÃ©nÃ©rÃ©es doivent Ãªtre en GIF \n";
      echo "-j  : La ou les images gÃ©nÃ©rÃ©es doivent Ãªtre en JPEG\n";
      echo "-l  : L'argument suivant est le nombre maximum d'images incrustÃ©es dans la mÃ©ta-image\n";
      echo "-n  : Afficher sous les images le nom de celles-ci (sans l'extension)\n";
      echo "-N  : Afficher sous les images le nom de celles-ci (avec l'extension)\n";
      echo "-p  : La ou les images gÃ©nÃ©rÃ©es doivent Ãªtre en PNG\n";
      echo "-s  : Trier les images par ordre alphabÃ©tique\n";
      echo "\n ------------------------------------------------------------------\n";
    }
  else if ($param == "error")
    echo "Erreur d'arguments ... \n ./imagepanel.php -[options] [taille] ./mon_site/index.html name_image \n\n";
  else if ($param == "dir")
    echo "Erreur base name is directory ... \n ./imagepanel.php -[options] [taille] ./mon_site/index.html name_i\
mage \n\n";
  else if ($param == "error20")
    echo "Erreur taille max : 20 ... \n ./imagepanel.php -[options] [taille] ./mon_site/index.html name_image \n\
\n";
  else echo "Error liens \n";

  exit();
}

function calcul_tbarre($level, $tail)
{
  $pourcent = intval($level / 20);
  if (($level + 1) == intval($tail / 4))
    echo "***********25%";
  if (($level + 1) == intval($tail / 2))
    echo "***********75%";
  if (($level + 1) == intval($tail / 3))
    echo "***********50%";
  if (($level + 1) == $tail)
    echo "************100% \n";
}



function        get_name($param)
{
  $path = pathinfo($param);
  return $path['filename'];
}

function        name_ext($param)
{
  $path_parts = pathinfo($param);
  $retur = $path_parts['filename'].".".$path_parts['extension'];
  return $retur;
}


function url_not($url)
{
  $headers = @get_headers($url);
  if(substr($headers[0], 9, 3) === true)
      return (1);
  else
    return (0);
}
