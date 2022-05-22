<?php

require 'include.php';

$path = '/home/simon/Downloads/cd.png';

$url = sendToImgur($path);

$submission = createSubmission(1, 1, $url);

?>
<img src="<?php echo htmlspecialchars($url) ?>" height="300">
