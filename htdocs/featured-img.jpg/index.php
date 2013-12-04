<?php


// Get RSS Content
$rss = new DOMDocument();
$rss->load('http://www.fishgate.co.za/category/our-work/feed');
$feed = array();
foreach ($rss->getElementsByTagName('item') as $node) {
    $item = array(
        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
        'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'img' => $node->getElementsByTagName('image')->item(0)->nodeValue
    );
    array_push($feed, $item);
}

// Pick Random Entry gyqqkx540
$random_key = array_rand($feed);

// Determine Image Type
$image_info = getimagesize($feed[$random_key]['img']);
$mime = $image_info['mime'];

switch ($mime){
    case "image/png":
        header('Content-type: image/png');
        $featured_image = imagecreatefrompng($feed[$random_key]['img']);
        imagepng($featured_image);
        break;
    case "image/jpeg":
        header('Content-type: image/jpeg');
        $featured_image = imagecreatefromjpeg($feed[$random_key]['img']);
        imagejpeg($featured_image);
        break;
    case "image/gif":
        header('Content-type: image/gif');
        $featured_image = imagecreatefromgif($feed[$random_key]['img']);
        imagegif($featured_image);
        break;
}

/*
// Prepare Description String
preg_match('/<img .*?(?=src)src=\"([^\"]+)\"/si',$feed[$random_key]['content'], $result);

// Determine Image Type
$image_info = getimagesize($result[1]);
$mime = $image_info['mime'];

// Create Image
switch ($mime){
    case "image/png":
        $featured_image = imagecreatefrompng($result[1]);
        break;
    case "image/jpeg":
        $featured_image = imagecreatefromjpeg($result[1]);
        break;
    case "image/gif":
        $featured_image = imagecreatefromgif($result[1]);
        break;
}

$im = imagecreatetruecolor(285, 250);

$thumb_width = 285;
$thumb_height = 126;

$width = imagesx($featured_image);
$height = imagesy($featured_image);

$original_aspect = $width / $height;
$thumb_aspect = $thumb_width / $thumb_height;

if ( $original_aspect >= $thumb_aspect )
{
   // If image is wider than thumbnail (in aspect ratio sense)
   $new_height = $thumb_height;
   $new_width = $width / ($height / $thumb_height);
}
else
{
   // If the thumbnail is wider than the image
   $new_width = $thumb_width;
   $new_height = $height / ($width / $thumb_width);
}

$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

// Resize and crop
imagecopyresampled($thumb,
                   $featured_image,
                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   0, 0,
                   $new_width, $new_height,
                   $width, $height);


// The text to draw
$text = 'Testing...';
// Replace path by your own font path
$font = '../arial.ttf';

$black = imagecolorallocate($im, 0, 0, 0);

// Add the text
imagettftext($im, 20, 0, 0, 135, $black, $font, $text);

imagejpeg($thumb);

// Output Image
//imagejpeg($featured_image);
*/
?>
