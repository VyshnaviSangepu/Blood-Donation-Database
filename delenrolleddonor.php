

<!DOCTYPE html>
<html>
    <head>
        <style>
            body
            {
                background-color: pink;
            }
            p
            {
                font-size: 25px;
                text-align: center;
                font-family: "Lucida Console", Monaco, monospace;
            }
            input[type=submit]
            {
                   font-size: 25px; 
                font-family: "Lucida Console", Monaco, monospace;
                background-color: plum;
            }            
        </style>
    </head>
    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                require("logincredentials.php");
                $mydatabase="BloodDonation";
                $myconnection=new mysqli($servername,$username,$password,$mydatabase);
                if($myconnection->connect_error)
                    die("Connection failed: ".$myconnection->connect_error);
                else
                {
                    echo "
                        <form action='communicatorbd.php' method='post'>
                            <input type='submit' value='Home'>
                        </form>";
                    echo "<br><br><br>";
                    $a=$_POST['name'];
                    $b=$_POST['email'];
                    $c=$_POST['mobile'];
                    $d=$_POST['bloodgroup'];
                    $e=$_POST['lasttime'];
                    $f=$_POST['enrolldate'];
                    $sql="DELETE FROM enrolleddonors
                        WHERE name='$a' AND email='$b' AND mobile='$c' AND bloodgroup='$d' AND lasttime='$e' AND enrolldate='$f';";
                    if($myconnection->query($sql)==TRUE)
                        echo "<p>Enrolled Donor deleted.</p><br><br>";
                    else
                        echo "Error: " . $sql . "<br>" . $myconnection->error;
                    echo "<br>";
                    echo "
                        <form action='displaydonor.php' method='post'>
                            <input type='submit' value='View the donors table'>
                        </form><br><br>";
                    echo "
                        <form action='preeligibledisplay.php' method='post'>
                            <input type='submit' value='View the eligibles table'>
                        </form><br><br>";
                    echo "
                        <form action='displayenrolled.php' method='post'>
                            <input type='submit' value='View the enrolled donors table'>
                        </form>";
                }
                $myconnection->close();
            }
        ?>
    </body>
</html>
