<!DOCTYPE html>
<html>
    <head>
        <title>Registration Page</title>
        <style>
            body {
                
                background-size: cover;
                background-image: url(../img/singup.jpg);
                font-family: Arial, sans-serif;
                background-color: #11aade;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 30px;
            }
            .form-container {
                background: #136391;
                padding: 30px 40px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                width: 400px;
                text-align: center;
            }
            .form-container h1 {
                margin-bottom: 20px;
                color: #333;
            }
            form {
                margin-top: 20px;
            }
            input,button {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 6px;
                background-color: #fff8f3;
                font-size: 14px;
                margin-top: 10px;
            }
            label {
                font-weight: bold;
                display: block;
                margin: 12px 0 6px;
                text-align: left;
            }
            button {
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            button:hover {
                background-color: #0056b3;
            }
            .gender-field{
                display: flex;
                gap: 10px;
                align-items: center;
                justify-content: center;
            }
            .gender-field input{
                width: auto;
            }
            a{
                display:block;
                text-align: center ;
                margin-top: 15px;
                color: #ff000d;
            }

              
         
        </style>

    </head>
    <body>
       
   <?php
// Initialize variables to hold form data and error messages
$firstname = $lastname = $gender = $email = $phone = $password = $confirmpassword = "";
$errors = [];
$success = "";

// Include your database connection file
include 'db.php';

// Process the form only when it is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. VALIDATION ---

    // First Name Validation
    if (empty($_POST["First_name"])) {
        $errors['firstname'] = "First Name is required";
    } else {
        $firstname = test_input($_POST["First_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $errors['firstname'] = "Only letters and white space allowed";
        }
    }

    // Last Name Validation
    if (empty($_POST["Last_name"])) {
        $errors['lastname'] = "Last Name is required";
    } else {
        $lastname = test_input($_POST["Last_name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $errors['lastname'] = "Only letters and white space allowed";
        }
    }

    // Gender Validation
    if (empty($_POST["Gender"])) {
        $errors['gender'] = "Gender is required";
    } else {
        $gender = test_input($_POST["Gender"]);
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }
    }

    // Phone Number Validation
    if (empty($_POST["phone"])) {
        $errors['phone'] = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // Simple validation for a 11-digit number
        if (!preg_match("/^[0-9]{11}$/", $phone)) {
            $errors['phone'] = "Phone number must be 11 digits";
        }
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $errors['password'] = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters long";
        }
    }

    // Confirm Password Validation
    if (empty($_POST["confirmpassword"])) {
        $errors['confirmpassword'] = "Please confirm your password";
    } else {
        $confirmpassword = test_input($_POST["confirmpassword"]);
        if ($password !== $confirmpassword) {
            $errors['confirmpassword'] = "Passwords do not match";
        }
    }


    // --- 2. DATABASE INSERTION (Only if no errors) ---

    if (empty($errors)) {
        // Hash the password for security before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Use prepared statements to prevent SQL injection
        // Assumes your table name is 'reg' and columns are correct.
        // NOTE: Do NOT store the 'confirm password' field in the database.
        $sql = "INSERT INTO info(First_name, Last_name, Gender) VALUES ('$firstname','$lastname','$gender')";
        
    }
    $conn->close();
}

// A helper function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
        <div class="form-container">
    <h1>Registration Form</h1>

    <?php if (!empty($success)): ?>
        <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (!empty($errors['db'])): ?>
        <p style="color: #f74a05;"><?php echo $errors['db']; ?></p>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="First_name">First Name:</label>
        <input type="text" id="First_name" name="First_name" value="<?php echo $firstname; ?>">
        <span style="color:#f74a05;">* <?php echo $errors['firstname'] ?? ''; ?></span><br><br>

        <label for="Last_name">Last Name:</label>
        <input type="text" id="Last_name" name="Last_name" value="<?php echo $lastname; ?>">
        <span style="color:#f74a05;">* <?php echo $errors['lastname'] ?? ''; ?></span><br><br>

        <label>Gender</label>
        <div class="gender-field">
            <input type="radio" id="male" name="Gender" value="male" <?php if ($gender == "male") echo "checked"; ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="Gender" value="female" <?php if ($gender == "female") echo "checked"; ?>>
            <label for="female">Female</label>
        </div>
        <span style="color:#f74a05;">* <?php echo $errors['gender'] ?? ''; ?></span><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span style="color:#f74a05;">* <?php echo $errors['email'] ?? ''; ?></span><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
        <span style="color:#f74a05;">* <?php echo $errors['phone'] ?? ''; ?></span><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span style="color:#f74a05;">* <?php echo $errors['password'] ?? ''; ?></span><br><br>
        
        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword">
        <span style="color:#f74a05;">* <?php echo $errors['confirmpassword'] ?? ''; ?></span><br><br>

        <button type="submit">Register</button>
        <button type="reset">Reset</button><br><br>
        
        <a href="../view/maindeshboard.html" title="Back to Main Page">Back to Main Page</a>
        <a href="login.html">Already Have an account? Login Here</a>
    </form>
</div>
        

    </body> 

   
</html>


            