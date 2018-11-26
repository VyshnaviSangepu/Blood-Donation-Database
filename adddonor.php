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
                    $today=date("d/m/Y");
                    $arr1=explode("/",$today);
                    $a=$_POST['name'];
                    $b=$_POST['email'];
                    $c=$_POST['mobile'];
                    $d=$_POST['bloodgroup'];
                    $e=$_POST['lasttime'];
                    $g=$_POST['enrolldate'];
                    $arr2=explode("/",$e);
                    $date1=date_create($arr1[2]."-".$arr1[1]."-".$arr1[0]);
                    $date2=date_create($arr2[2]."-".$arr2[1]."-".$arr2[0]);
                    $diff=date_diff($date1,$date2);
                    $f=$diff->format("%R%a");
                    $sql1="SELECT lasttime
                        FROM donors
                        WHERE email='$b'";
                    if($myconnection->query($sql1)==TRUE)
                    {
                        $result = $myconnection->query($sql1);
                        if ($result->num_rows > 0)
                        {
                            $row=$result->fetch_assoc();
                            $oldlasttime=$row['lasttime'];
                            $arr3=explode("/",$oldlasttime);
                            $diff1=date_diff($date1,$date3);
                            $s=$diff->format("%R%a");
                            $s=$s*(-1);
                            $sql2="DELETE FROM donors
                                    WHERE email='$b';";
                            if($myconnection->query($sql2)==TRUE)
                            {
                                if($s>56)
                                {
                                    $sql4="DELETE FROM elligibles
                                        WHERE email='$b';";
                                    if($myconnection->query($sql4)==TRUE)
                                    {
                                        $f=$f*(-1);
                                        $sql="INSERT INTO donors(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                            VALUES ('$a','$b','$c','$d','$e','$f')";
                                        if($myconnection->query($sql)==TRUE)
                                        {
                                            echo "<p>Added to the donors table</p><br><br>";
                                            if($f>56)
                                            {
                                                $sql3="INSERT INTO elligibles(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                                    VALUES ('$a','$b','$c','$d','$e','$f')";
                                                if($myconnection->query($sql3)==TRUE)
                                                    echo "<p>Added to the elligibles table<p>";
                                                else
                                                    echo "Error: " . $sql3 . "<br>" . $myconnection->error;
                                            }
                                        }
                                        else
                                            echo "Error: " . $sql . "<br>" . $myconnection->error;
                                    }
                                    else
                                        echo "Error: " . $sql4 . "<br>" . $myconnection->error;
                                }
                                else
                                {
                                    $f=$f*(-1);
                                    $sql="INSERT INTO donors(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                        VALUES ('$a','$b','$c','$d','$e','$f')";
                                    if($myconnection->query($sql)==TRUE)
                                    {
                                        echo "<p>Added to the donors table</p><br><br>";
                                        if($f>56)
                                        {
                                            $sql3="INSERT INTO elligibles(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                                VALUES ('$a','$b','$c','$d','$e','$f')";
                                            if($myconnection->query($sql3)==TRUE)
                                            {
                                                echo "<p>Added to the elligibles table<p>";
                                            }
                                            else
                                                echo "Error: " . $sql3 . "<br>" . $myconnection-error;
                                        }
                                    }
                                    else
                                        echo "Error: " . $sql . "<br>" . $myconnection->error;
                                }
                            }
                            else
                                echo "Error: " . $sql2 . "<br>" . $myconnection->error;
                        }
                        else
                        {
                            $f=$f*(-1);
                            $sql="INSERT INTO donors(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                VALUES ('$a','$b','$c','$d','$e','$f')";
                            if($myconnection->query($sql)==TRUE)
                            {
                                echo "<p>Added to the donors table</p>";
                                if($f>56)
                                {
                                    $sql3="INSERT INTO elligibles(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                        VALUES ('$a','$b','$c','$d','$e','$f')";
                                    if($myconnection->query($sql3)==TRUE)
                                    {
                                        echo "<p>Added to the elligibles table<p>";
                                    }
                                    else
                                        echo "Error: " . $sql3 . "<br>" . $myconnection-error;
                                }
                            }
                            else
                                echo "Error: " . $sql . "<br>" . $myconnection->error;
                        }
                    }
                    else
                        echo "Error: " . $sql1 . "<br>" . $myconnection->error;
                    echo "<br><br>";
                    echo "
                        <form action='displaydonor.php' method='post'>
                            <input type='submit' value='View the donors table'>
                        </form><br><br>";
                    echo "
                        <form action='displayeligible.php' method='post'>
                            <input type='submit' value='View the eligibles table'>
                        </form><br><br>";
                    echo "
                        <form action='displayenrolled.php' method='post'>
                            <input type='submit' value='View the enrolled donors table'>
                        </form>";
                }
                $sql5="DELETE FROM enrolleddonors
                    WHERE name='$a' email='$b' mobile='$c' bloodgroup='$d' lasttime='$e' enrolldate='$g';";
                if($myconnection->query($sql5)!=TRUE)
                    echo "Error: " . $sql5 . "<br>" . $myconnection-error;
                $myconnection->close();
            }
        ?>
    </body>
</html>