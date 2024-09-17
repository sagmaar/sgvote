<?php
    session_start();
    include 'includes/conn.php';

    if(isset($_POST['login'])){
        // Capture the input values from the form
        $voter = $_POST['voter'];
        $password = $_POST['password'];

        // Debugging: Print inputs to check their values
        echo 'Voter ID: ' . $voter . '<br>';
        echo 'Entered Password: ' . $password . '<br>';

        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM voters WHERE voters_id = ?");
        $stmt->bind_param("s", $voter);
        $stmt->execute();
        $query = $stmt->get_result();

        // Check if the voter exists in the database
        if($query->num_rows < 1){
            $_SESSION['error'] = 'invalid voter number';
        }
        else{
            // Fetch voter data
            $row = $query->fetch_assoc();
            
            // Debugging: Print hashed password from database
            echo 'Hashed Password in DB: ' . $row['password'] . '<br>';

            // Verify the entered password with the hashed one
            if(password_verify($password, $row['password'])){
                // Password matches, start session
                $_SESSION['voter'] = $row['id'];
                echo 'Login successful!';  // Debugging success
            }
            else{
                // Incorrect password
                $_SESSION['error'] = 'Incorrect password';
            }
        }
    }
    else{
        // If login form wasn't submitted
        $_SESSION['error'] = 'Input voter credentials first';
    }

    // Redirect user back to index page
    header('location: index.php');
?>
