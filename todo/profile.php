
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
  
  <?php
      if(!isset($_SESSION)) 
      { 
          session_start(); 
      } 

      if (!isset($_SESSION['auth'])) {
          header('Location: index.php');
          exit;
          
      }
  ?>
  <?php


    include 'db/db_connection.php';
    if (isset($_GET['remove_todo_id'])) {
      $remove_todo_id = $_GET['remove_todo_id'];
      $current_user = $_SESSION['auth']['username'];

      $sql = "DELETE FROM todos WHERE `person`=? AND `ID`=?";
      $query = $db->prepare($sql);
      $query->execute(array($current_user, $remove_todo_id));

      header("Location: profile.php?msg=1");
      die();
    }
    

  ?>
  <?php

  if (isset($_GET['msg']) && $_GET['msg'] == "1") {
      echo '<div class="alert alert-danger text-center" role="alert">
      Todo silindi!
    </div>';
      
  }elseif (isset($_GET['msg']) && $_GET['msg'] == "2") {
    echo '<div class="alert alert-success text-center" role="alert">
    Todo eklendi!
  </div>';
    
  }elseif (isset($_GET['msg']) && $_GET['msg'] == "3") {
    echo '<div class="alert alert-primary text-center" role="alert">
    Todo güncellendi!
  </div>';
    
  }
  ?>
<div class="container d-flex ">
  <div class="col-md-12 mx-auto">
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
    
  <h1 class="text-center ">Profil</h1>
    <small class="lead"><h2>Kullanıcı: <?php  echo $_SESSION['auth']['username']; ?></h2></small>
  
    <form method="GET" class="mt-3">
        
      <div class="d-flex justify-content-center">
        <a href="add_todo.php" class="btn btn-success btn-lg mt-3 text-light ms-3">Todo Ekle <i class="fa-solid fa-add"></i></a>
      </div>
    </form>
  </div>
  
</div>
<div class="container">
        
        <div class="bd-example mt-5 ">
            
            <div class="container-lg text-center">
            
            <table class="table">
              <thead class="thead-light">
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
                $current_user = $_SESSION['auth']['username'];

                if (isset($_GET['query'])) {
                  $query_get = $_GET['query'];
                  $sql ="SELECT * FROM todos WHERE `task_name`=? AND person='$current_user'";
                  $query = $db->prepare($sql);
                  $query->execute(array($query_get));

                }else {
                  $sql = "SELECT * FROM todos WHERE person='$current_user'";
                  $query = $db->prepare($sql);
                  $query->execute();
                }


                while ($row = $query->fetch()) {
                  $task_ID = $row["ID"];
                  $task_name = $row["task_name"];
                  $status = $row["status"];
                  $date = $row["date"];
                  if ($status==1) {
                    $task_status = "Başarılı !";
                  }else {
                    $task_status = "Başarısız !";
                  }
                  echo "<tr>
                  <td scope='row'> {$task_name} </td>
                  <td>{$task_status}</td>
                  <td>{$date}</td>
                  <td>
                    <div class='d-grid gap-2 d-md-block'>
                        <a href='profile.php?remove_todo_id={$task_ID}' class='btn' style='color:rgb(255, 0, 0)'>Sil <i class='fa-solid fa-trash'></i></a>
                        <a class='btn' href='edit_todo.php?todo_id={$task_ID}' style='color:rgb(0, 238, 255)'>Düzenle <i class='fa-solid fa-pen-to-square'></i></a>
                    </div>
                  </td>
                </tr>";
              }
              ?>
                

              </tbody>
            </table>
            </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

 
</body>

</html>
