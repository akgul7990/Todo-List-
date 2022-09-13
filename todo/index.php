
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="shortcut icon" href="https://cdn-icons.flaticon.com/png/512/5483/premium/5483896.png?token=exp=1650571390~hmac=e0592481f5d3d815d718140e12c03c19" type="image/x-icon">

   

  <title>TODO LİST</title>
</head>

<body>
  
  
<div class="container d-flex ">
  <div class="col-md-8 mx-auto">
  
  <div class="d-grid gap-2 d-md-block">
  <?php
    session_start();

    if (isset($_SESSION['auth'])) {
        echo '<a href="profile.php" class="btn btn-primary" type="button" >Profile </a>
        <a href="logout.php" class="btn btn-danger" type="button">Logout </a>';
        
    } else {
        echo '<a href="login.php" class="btn btn-primary" type="button" >Login</a>
        <a href="register.php" class="btn btn-success" type="button" >Register</a>';
    }
  ?>

    </div>
    <h1 class="text-center ">TODO LİST</h1>
    

   
  </div>
  
</div>
<div class="container">
        
        <div class="bd-example mt-5 ">
            
            <div class="container">
              
            <table class="table ">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">İsim</th>
                  <th scope="col">Durum</th>
                  <th scope="col">Tarih</th>
                  <th scope="col">Kullanıcı</th>
                </tr>
              </thead>
              
              
              <tbody>
              <?php
                include 'db/db_connection.php';

                if (isset($_GET['query'])) {
                  $query_get = $_GET['query'];
                  $sql ="SELECT * FROM todos WHERE `task_name`=?";
                  $query = $db->prepare($sql);
                  $query->execute(array($query_get));

                }else {
                  $sql = "SELECT * FROM todos";
                  $query = $db->prepare($sql);
                  $query->execute();
                }
                

                while ($row = $query->fetch()) {
                  $task_ID = $row["ID"];
                  $task_name = $row["task_name"];
                  $status = $row["status"];
                  $date = $row["date"];
                  $person = $row["person"];
                  if ($status==1) {
                    $task_status = "Başarılı !";
                  }else {
                    $task_status = "Başarısız !";
                  }
                  echo "<tr>
                  <td scope='row'> {$task_name} </td>
                  <td>{$task_status}</td>
                  <td>{$date}</td>
                  <td>{$person}</td>
                </tr>";
              }
              ?>
              </tbody>
            </table>
            </div>
    </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
