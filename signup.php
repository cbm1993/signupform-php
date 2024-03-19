<?php
include("connection.php");

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert data into database with hashed password
    $sql = "INSERT INTO signup(username, email, password) VALUES('$username', '$email', '$hashed_password')";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        header("Location: welcome.php");
        exit(); // Stop further execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Check if username or email already exists
    $sql_username = "SELECT * FROM signup WHERE username='$username'";
    $result_username = mysqli_query($conn, $sql_username);  
    $count_user = mysqli_num_rows($result_username);

    $sql_email = "SELECT * FROM signup WHERE email='$email'";
    $result_email = mysqli_query($conn, $sql_email);  
    $count_email = mysqli_num_rows($result_email);

    if($count_user == 0 && $count_email == 0){
        // Insert data into database
        $sql_insert = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
        if(mysqli_query($conn, $sql_insert)){
            echo '<script>
                alert("Signup successful");
                window.location.href="index.php";
                </script>';
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    } else {
        if($count_user > 0){
            echo '<script>
                alert("Username already exists");
                window.location.href="index.php";
                </script>';
        }
        if($count_email > 0){
            echo '<script>
                alert("Email already exists");
                window.location.href="index.php";
                </script>';
        }
    }
}
?>
