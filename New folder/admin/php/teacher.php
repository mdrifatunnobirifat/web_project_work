<?php
include 'registrationDB.php';
$query="SELECT  ID,fullname,username FROM registration WHERE role='Teacher'";
$result=$conn->query($query);


if(isset($_POST['delete']))
{
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $sql="DELETE FROM registration Where username='$username' and role='Teacher'";
    mysqli_query($conn,$sql);
    header("Location:".$_SERVER['PHP_SELF']);
    exit();

}

if(isset($_POST['update']))
{
    
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $sql="UPDATE registration SET fullname='$fullname' WHERE username='$username' and role='Teacher'";
    mysqli_query($conn,$sql);
    header("Location:".$_SERVER['PHP_SELF']);
    exit();

}

if(isset($_POST['add']))
{
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $check="SELECT * FROM registration WHERE username='$username' and role='Teacher' LIMIT 1";
    $resultcheck=mysqli_query($conn,$check);
    if(mysqli_num_rows($resultcheck)>0)
    {
        echo "<script>alert('multiple input in the DB');</script>";
    }
    else
    {
    $sql="INSERT INTO registration(fullname,username,role) VALUES('$fullname', '$username','Teacher') ";

    mysqli_query($conn,$sql);
    
    header("Location:".$_SERVER['PHP_SELF']);
    exit();
    }
    
   


}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>aiub clone</title>
        <link rel="stylesheet"  href="../css/aiub.css">
    </head>
    <body>
        <center>
          <h2>
             <label  style="color: rgb(13, 101, 202); font-family:Arial, Helvetica, sans-serif;  font-size: 25px;"> Manage teacher</label><br>
             <label  style="color: rgb(22, 22, 22); ">************************************************</label>
          </h2>

          <div  >
            <table  class="table" style="font-size:18px;">
                
                <tr class="tablerow">
                    <td class="tableheading">ID</td>
                    <td class="tableheading">Name</td>
                    <td class="tableheading">Userid</td>
                   
                </tr>
             <?php
                if($result && $result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tr class='tablerow'>";
                        echo "<td class='tableheading'>".$row['ID']."</td>"; 
                        echo "<td class='tableheading'>".$row['fullname']."</td>";
                        echo "<td class='tableheading'>".$row['username']."</td>";        
                        echo "</tr>";               
                            
                    }
                }
                   else
                    {
                        echo "<tr><td colspan='4'> NO teachers found</td></tr>";
                    }
                      $conn->close();
                             
             ?>
             </div>
             <div>
             <h3>Add teacher</h3>

             <form method ="post">                
                <input type="text"  name="fullname"placeholder="fullname" >
                <input type="text" name="username" placeholder="username" valeu="<?php echo $usernameerr;  ?>">
                <button type ="submit" name="add" style="width:55px;height:40px;font-size:11px;border-radius:0px; color:green;">Add</button>  
             </form>
             <h3>Update info of teacher</h3>

             <form method ="post">        
                <input type="text"  name="fullname" placeholder="fullname">
                <input type="text"  name="username" placeholder="username">
                <button type ="submit" name="update" style="width:55px;height:40px;font-size:11px;border-radius:0px;color:green;">Update</button> 
        
             </form>
             <h3>delete info of teacher</h3>

             <form method ="post">  
                      
                <input type="text"  name="fullname"  placeholder="fullname">
                <input type="text"  name="username" placeholder="username" >
                <button type ="submit" name="delete" style="width:55px;height:40px;font-size:11px;border-radius:0px;color:red;">Delete</button>  
             </form>
             
            </table>
          </div>
          <br>
          <br>

          
        </center>
    </body>
</html>