<?php
$success = 0; 
$user = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM registration WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $user = 1; 
    } else {
        $stmt = $con->prepare("INSERT INTO registration (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $result = $stmt->execute();
        
        if($result){
            $success = 1;
            header('location:login.php');
        } else {
            die("Data insertion failed: " . $con->error);
        }
    }
    $stmt->close();
    $con->close();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup page</title>
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>

    <?php
        if($user){
            echo '
            <div class="alert alert-danger alert-primary" role="alert">
                <strong>Error: </strong>User already exists
            </div>
            ';
        }
    ?>

    <?php
        if($success){
            echo '
            <div class="alert alert-success alert-primary" role="alert">
                Signup successful
            </div>
            ';
        }
    ?>

    <div class="container mt-5">
        <h1 class="text-center">
            Sign Up Page
        </h1>
        <form action="sign.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <form action="login.php">
            <button type="submit" class ="btn btn-primary mt-4">Already have an account</button>
        </form>
    </div>
  </body>
</html>
