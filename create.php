<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) 
{
    require "../config.php";
    require "../common.php";
   /* $uname="";
	$name="";
	$pass="";
	$email="";
	$mob=""; 
	
	$uname_e="";
	$name_e="";
	$pass_e="";
	$email_e="";
	$mob_e="";
	if(empty($_POST['username']))
	{
		$uname_e="username can't be null";
	}
	else
	{
		$uname=$_POST['username'];
	}
	if(empty($_POST['name']))
	{
		$name_e="name cant be null";
	}
	else
	{
		$name=$_POST['name'];
	}
	if(empty($_POST['email']))
	{
		$email_e="email can't be null";
	}
	else
	{
		$email=$_POST['email'];
	}
	
	if(empty($_POST['password']))
	{
		$pass_e="password can't be null";
	}
	else
	{
		$pass=$_POST['password'];
	}
	
	
	if($uname!="" and $name!="" and $pass!="" and $email="" )
	{*/
	
    try  {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                        FROM users
                        WHERE  email= :email";

        $email = $_POST['email'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
		if($result && $statement->rowcount()==0){
        
        $new_user = array(
            "username" => $_POST['username'],
            "name"  => $_POST['name'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "mobile"  => $_POST['mobile']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
		}
		else{
			echo"user already exist";
		}
		
	}
	
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['name']; ?> </blockquote>
<?php } ?>
<script>
function validate()
{
	
	var uname=document.forms["reg"]["username"].value;
	var name=document.forms["reg"]["name"].value;
	var email=document.forms["reg"]["email"].value;
	var pass=document.forms["reg"]["password"].value;
	var mob=document.forms["reg"]["mobile"].value;
	
	if(uname=="")
	{
		alert("enter a valid username");
		document.forms["reg"]["username"].focus();
		return false;
	}
	else if(name=="")
	{
		alert("enter a valid name");
		document.forms["reg"]["name"].focus();
		return false;
	}
	else if(email=="")
	{
		alert("enter a valid email");
		document.forms["reg"]["email"].focus();
		return false;
	}
	else if(pass=="")
	{
		alert("invalid password");
		document.forms["reg"]["password"].focus();
		return false;
	}
	else if(mob.length<10)
	{
		alert("enter a valid mobile number");
		document.forms["reg"]["password"].focus();
		return false;
	}
	
	else
	{
		alert("Dear "+name);
	}
		
		
}
	

</script>
<div align=center>

<h2>Add a user</h2>

<form method="post"onsubmit="return validate()" name="reg">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email Address</label>
    <input type="email" name="email" id="email">
    <label for="password">Password</label>
    <input type="text" name="password" id="password">
    <label for="mobile">Mobile</label>
    <input type="text" name="mobile" id="mobile">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
</div>

<?php require "templates/footer.php"; ?>
