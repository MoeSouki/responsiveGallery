<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Gallery</title>
    <link rel="stylesheet" href="../styles/galleryStyles.css">
</head>
<body>

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
</div>

</body>
</html>
