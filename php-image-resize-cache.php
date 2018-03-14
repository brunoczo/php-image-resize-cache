<?php
/*
Createad by Bruno Oliveira(brunoczo@hotmail.com) 14/03/2018
*/

$FILE_BASE = "img-rezise/";
$RESIZE_VALUE = 600;


function resize_image($file, $w, $h,$type, $crop=FALSE) {

    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    if($type == "PNG"){
        $src = imagecreatefrompng($file);
    }else{
        $src = imagecreatefromjpeg($file);
    }

    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
function cleanText($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function saveFile($filename,$dataBin){

    imagejpeg($dataBin,$filename);

}
function isPNG($url){
   $ret = exif_imagetype($url);

   if($ret==3){

     return true;
   }

   return false;
}



$url =$_GET['url'];
if(empty($url)){

  exit(0);
}


if (!file_exists($FILE_BASE)) {
    mkdir($FILE_BASE, 0755, true);
}

$filename = cleanText($url) . md5($url) ;
$file_path = $FILE_BASE . $filename;

if(file_exists($file_path)){
  header('Content-type: image/jpeg');
  echo file_get_contents($file_path);

}else{

  if( isPNG($url) ){
    $img = resize_image($url ,$RESIZE_VALUE, $RESIZE_VALUE,"PNG");
  }else{
        $img = resize_image($url ,$RESIZE_VALUE, $RESIZE_VALUE,"JPG");
  }

  saveFile($file_path,$img);

  header('Content-type: image/jpeg');
  imagejpeg($img);

}

?>
