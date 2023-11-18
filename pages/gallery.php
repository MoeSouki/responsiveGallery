<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/galleryStyles.css" />
    <title>Image Gallery</title>
</head>
<body>
<div class="topnav">
      <a href="index.html">Home</a>
      <a href="../cv.html">CV</a>
      <a class="active" href="gallery.php">Gallery</a>
      <a href="../contact-me.html">Contact Me</a>
</div>
<div id="gallery">
    <?php
    $jsonPath = '../paths.json';
    $jsonContent = file_get_contents($jsonPath);

    if ($jsonContent === false) {
      die('Error reading JSON file.');
    }

    $images = json_decode($jsonContent, true);

    if ($images === null) {
      die('Error decoding JSON.');
    }
    $index = 0;
    foreach ($images as $image) {
      if ($index % 3 == 0) {
        if ($index > 0) {
          echo "</div>";
        }
        echo "<div class='image-row'>";
      }

      echo "
            <a href='#lightbox{$index}'>
                <img src='../images/$image' alt='Image'>
            </a>
            <div id='lightbox{$index}' class='lightbox'>
                <a href='#gallery' class='close'>&times;</a>
                <img src='../images/$image' alt='Image'>
            </div>";
      $index++;
    }

    if ($index % 3 != 0) {
      echo "</div>";
    }
    ?>
</div>
</body>
</html>
