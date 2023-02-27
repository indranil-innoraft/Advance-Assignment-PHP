<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="container flex">
    <form action="sendEmail.php" method="post">
      <div class="mb-3">
        <input name="email" type="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <div class="message-section">
      <?php

      //Session start for using session variable.
      session_start();

      //Check if message is set or not.
      if(isset($_SESSION['Msg'])) {
        echo $_SESSION['Msg'];

        //On reload message should not displayed on the screen.
        unset($_SESSION['Msg']);
      }

      ?>
      </div>
    </form>
  </div>
</body>
</html>
