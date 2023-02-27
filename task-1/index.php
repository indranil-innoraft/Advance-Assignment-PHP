<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Innoraft</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <!-- Creating the object and call its methods. -->
  <?php require './action.php'; ?>

  <div class="container">
    <?php for ($i = 0; $i < 6; $i++) { ?>
      <div class="flex-between">
        <div class="left flex">
          <img src="<?php echo $fetchingData->image[$i]; ?>" alt="image" />
        </div>
        <div class="right">
          <div class="contents">
            <h2><?php echo $fetchingData->title[$i]; ?></h2>
            <p>
              <?php echo $fetchingData->list[$i]; ?>
            </p>
          </div>
          <span><a href="<?php echo $fetchingData->button[$i]; ?>">Explore Now</a></span>
        </div>
      </div>

    <?php } ?>

  </div>
</body>
</html>
