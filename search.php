<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

    <title>Search Book</title>
</head>
 
<body>
   <br/>
    <?php 		include_once("config.php");
				$a = mysqli_query($mysqli, "DELETE FROM books"); 
				$b = mysqli_query($mysqli, "ALTER TABLE books auto_increment = 1;");
	?>
 
    <form action="apicall.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Enter Keywords: </td>
                <td><input type="text" name="keywords"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Search"></td>
            </tr>
        </table>
    </form>
</body>
</html>