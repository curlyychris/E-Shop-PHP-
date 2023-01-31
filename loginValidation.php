<?php
include('./configuration.php');
session_start();
if(isset($_POST['submitL']))
    {
        
        //$email = mysqli_real_escape_string($conn, $_POST['typeEmailL']); 
        $email = $_POST['typeEmailL'];
        $password = $_POST['typePasswordL']; 
        

            $sql = "SELECT * from users where email='$email' AND password='$password'";
            $result = $conn->query($sql);//returns a table
            //user exists
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();//gets the row of the table  where email='$email' AND password='$password'
                $_SESSION['userID'] = $row['id'];//stores userid from database and i can use it anywhere i want but i must put session_start
                                                //anywhere i use the session  (userID is a random name you give)
                $_SESSION['userType'] = $row['userType'];
                $_SESSION['usersName'] = $row['name'];

                if($_SESSION['userType']=="Customer")
                {
                    header("Location: ./customerPage.php");
                }
                else
                {
                    // ./ means current directory
                    header("Location: ./sellerPageAdd.php");
                }

            }
            //user either doesn't exist or a wrong email or password was entered
            else
            {
                $error[] = 'Incorrect email or password';  
            }
    }
    
$conn->close();
?>