<?php


    if(isset($_POST['submit'])){
        $FullName = $_POST['FullName'];
        $UserName = $_POST['UserName'];
        $Password = $_POST['Password'];

        $sql = "INSERT INTO `users`(`ID`, `Username`, `Password`, `FullName`, `UserRole`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')";

        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: index.php?msg=New record created successfully");
        }
        else{
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>