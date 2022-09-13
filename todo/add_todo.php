
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


if (isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit;
    
}
?>
<div class="container d-flex ">
  <div class="col-md-8 mx-auto">
    <h1 class="text-center "> Todo Ekle</h1>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">İsim</label>
            <input type="text" name="task_name" class="form-control" require>
        </div>
        <div class="mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="status" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Başarılı !
            </label>
        </div>
        <button type="submit" class="btn-primary">Ekle </i></button>
    </form>

    <?php 
              include 'db/db_connection.php';
                
              session_start();

              if (isset($_POST["task_name"])) {
                $task_name = $_POST["task_name"];
                $current_user = $_SESSION['auth']['username'];
                $time = date("Y/m/d");
                echo is_int(1);
                htmlspecialchars($task_name);
                    if (isset($_POST["status"]) && isset($_POST["status"])==1) {
                        $query = $db->prepare("INSERT INTO todos(task_name, status, date, person) VALUES('$task_name', 1, '$time', '$current_user')");
                        
                    }else {
                        $query = $db->prepare("INSERT INTO todos(task_name, status, date, person) VALUES('$task_name', 0, '$time', '$current_user')");

                    }
                    $query->execute();
                        header('Location: profile.php?msg=2');
                        exit;
                
               
                   
            }
      ?>

  </div>
</div>

    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  
</body>

</html>
