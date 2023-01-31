<?php
    include("./configuration.php");
    if(isset($_POST['submitR']))
    {
        //$name=$_POST['typeNameR'] does not accept ' so wont insert it in db for example whereas mysqli_real_escape_string does
        $name = mysqli_real_escape_string($conn, $_POST['typeNameR']);
        $email = mysqli_real_escape_string($conn, $_POST['typeEmailR']);
        $password = $_POST['typePasswordR']; 
        $confirmedPass=$_POST['typePasswordConfR'];
        $userType = $_POST['user_type'];
        //echo $name." ".$email." ",$password." ".$userType; used for error checking

        //check to see if email entered already exists
        $query = "SELECT * from users where email='$email'";
        $result = mysqli_query($conn, $query);//same as: $result = mysqli_query($conn, "select....");
        if(mysqli_num_rows($result)>0)
        {
            $error[] = 'This user already exists';
        }
        elseif($password!=$confirmedPass)
        {
            $error[] = 'The passwords do not match';
        }
        else
        {
            $sql = "INSERT INTO users (name,email,password,userType) VALUES('$name', '$email', '$password', '$userType')";

            if($conn->query($sql) === TRUE)
            {
                //echo 'Successfully added into database';
                header('location:login.php');

            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }

    }
    $conn->close();
?>