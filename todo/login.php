<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="shortcut icon" href="https://cdn-icons.flaticon.com/png/512/5483/premium/5483896.png?token=exp=1650571390~hmac=e0592481f5d3d815d718140e12c03c19" type="image/x-icon">



  <title>TODO LİST</title>
</head>

<body>


  <div class="container d-flex ">
    <div class="col-md-8 mx-auto">

      <div class="d-grid gap-2 d-md-block">
        <?php
        

        if (isset($_SESSION['auth'])) {
          echo '<a href="profile.php" class="btn btn-primary" type="button" >Profile </a>
          <a href="logout.php" class="btn btn-danger" type="button">Logout </a>';
        } else {
          echo '<a href="login.php" class="btn btn-primary" type="button" >Login</a>
          <a href="register.php" class="btn btn-success" type="button" >Register</a>';
        }
        ?>

      </div>
      <h1 class="text-center ">GİRİŞ YAP</h1>





      <form method="post">
        <div class="mb-3">
          <label class="form-label ">Kullanıcı Adı</label>
          <input type="text" name="username" class="form-control" require>
        </div>
        <div class="mb-3">
          <label class="form-label">Şifre</label>
          <input type="password" name="passwd" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <?php
      session_start();

      if (isset($_SESSION['auth'])) {
        header("Location: index.php");
        die();
      }

      try {
        include 'db/db_connection.php';
      } catch (PDOException $error) {
        echo $error;
      }


      if (isset($_POST['username']) && isset($_POST['passwd'])) {
        $username = trim($_POST['username']);
        $passwd = hash("sha256", trim($_POST['passwd']));

        $sql = "SELECT * FROM users WHERE `username`=? AND `password`=?";
        $query = $db->prepare($sql);
        $query->execute(array($username, $passwd));

        $result = $query->fetch();

        if (isset($result[0])) {

          $_SESSION['auth'] = array(
            "username" => $result['username'],
          );
          session_start();
          header("Location: index.php");
          die();
        } else {
          echo '<div class="alert alert-danger" role="alert">
                Check username or password!
            </div>';
        }
      }
      ?>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>