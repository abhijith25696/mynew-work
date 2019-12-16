<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */
 session_start();
 $uname=$_POST['username'];
 $_SESSION['user']=$uname;

if (isset($_POST['submit'])) {
    try  {
        
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                        FROM users
                        WHERE  email= :email";

        $email = $_POST['email'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { 
		
		echo $_SESSION;
		echo"successfully logged in";
     
     } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['email']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>login</h2>

<form method="post">
    <label for="email">email/username</label>
    <input type="text" id="email" name="email"><br><br>
	<label for="email">password</label>
    <input type="text" id="email" name="password"><br><br>
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
