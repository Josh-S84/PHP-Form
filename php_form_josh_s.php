
<?php
// Define variables and set to empty values
$nameErr = $emailErr = $ageErr = $colorErr = "";
$name = $email = $age = $color = "";

// Create the validations using if-statements
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//Use POST to get data from the html form and sanitise it using the function test_input()
	$name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
	$color = test_input($_POST["color"]);
	
	// Validate name
	if (empty($name)) {
	$nameErr = "* Name is required";
	} 
	
	// Validate email	
    if (empty($email)) {
        $emailErr = "* Email is required"; 
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid email format";  
        }
    }
	
    // Validate age
    if (empty($age)) {
        $ageErr = "* Age is required";  
    } else {
        if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 100) {
            $ageErr = "* Age must be a number between 1 and 100"; 
        }
    }
	  
    // Validate favourite colour
    $valid_colors = ["Red", "Green", "Blue"];
    if (!in_array($color, $valid_colors)) {
        $ColorErr = "* Favourite colour must be one of the provided options";
    }
	
	

} //end validations

//function to sanitise the inputs for added security against insertion of malicious code.
function test_input($data){
	$data = trim($data); //Removes leading and trailing spaces from the string.
	$data = stripslashes($data); //Removes backslashes from the string.
	$data = htmlspecialchars($data); //Converts special characters to HTML entities, preventing any potential security vulnerabilities such as Cross-Site Scripting (XSS) attacks.
	return $data;
}//end function

// Display input if no errors, otherwise display an error message
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($colorErr)) {
	echo "<p> Hello $name. Your age is $age, your email is $email and your favourite colour is $color. </p>";  
	}
	else{
		echo "<p>Error: Please try again. $ageErr, $nameErr, $emailErr</p>"; 
	}
?>


