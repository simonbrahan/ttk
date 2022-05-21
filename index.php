<?php

require 'include.php';

$path = '/home/simon/Downloads/PXL_20220519_080308928.jpg';

$url = sendToImgur($path);

printf('<img src="%s">', $url);
