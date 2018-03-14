# php-image-rezise-cache
Fast php resizing image with cache.(Can by used with apache or other server php)

# Rezise Value
Default resize value is 600px.
To change this, modify the variable $REZISE_VALUE = 600;

Example:
http://localhost/php-image-rezise-cache.php?url=https://upload.wikimedia.org/wikipedia/commons/b/bb/Doctor_Who_Experience_Cardiff_-_Rise_and_evolution_of_the_Daleks_%2814602025621%29.jpg

Note: The width/height of this image is 4000px/3000px, the first call is slow because the image is too large, but the second call is very fast.

