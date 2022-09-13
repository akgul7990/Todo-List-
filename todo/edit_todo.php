
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
   <h1 class="text-center ">Todo Düzenle</h1>

    

    <?php 
              include 'db/db_connection.php';
                
              session_start();

              if (isset($_GET["todo_id"])) {
                $current_user = $_SESSION['auth']['username'];
                $todo_id = $_GET["todo_id"];

                $sql ="SELECT * FROM todos WHERE `ID`=? AND `person`=?";
                $query = $db->prepare($sql);
                $query->execute(array($todo_id, $current_user));
                while ($row = $query->fetch()) {
                    $task_name = $row["task_name"];
                    $status = $row["status"];
                    if ($status==1) {
                        $task_status = "checked";
                    }else {
                        $task_status="";
                    }
                    echo "<form method='post'>
                    <div class='mb-3'>
                        <label class='form-label'>İsim</label>
                        <input type='text' name='task_name' value='{$task_name}' class='form-control' require>
                    </div>
                    <div class='mb-3'>
                        <input class='form-check-input' type='checkbox' value='{$status}' name='status' id='flexCheckDefault' {$task_status}>
                        <label class='form-check-label' for='flexCheckDefault'>
                            Başarılı !
                        </label>
                    </div>
                    <button type='submit' class='btn-primary'>Güncelle</button>
                </form>";
            }
            }
            if (isset($_POST["task_name"])) {
                $task_name = $_POST["task_name"];
                $current_user = $_SESSION['auth']['username'];
                $todo_id = $_GET["todo_id"];
                htmlspecialchars($task_name);
                htmlspecialchars($todo_id);

                if (isset($_POST["status"]) && isset($_POST["status"])==1) {
                    $query = $db->prepare("UPDATE todos SET task_name='$task_name', status= 1 WHERE ID= '$todo_id' AND person='$current_user'");
                    
                }else {
                    $query = $db->prepare("UPDATE todos SET task_name='$task_name', status= 0 WHERE ID= '$todo_id' AND person='$current_user'");

                }
                $query->execute();
                    header('Location: profile.php?msg=3');
                    exit;
                   
            }
        
      ?>

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
