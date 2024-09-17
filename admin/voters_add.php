<?php
	// include 'includes/session.php';

	// if(isset($_POST['add'])){
	// 	$firstname = $_POST['firstname'];
	// 	$lastname = $_POST['lastname'];
	// 	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	// 	$filename = $_FILES['photo']['name'];
	// 	if(!empty($filename)){
	// 		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
	// 	}
	// 	//generate voters id
	// 	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	// 	$voter = substr(str_shuffle($set), 0, 15);

	// 	$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo) VALUES ('$voter', '$password', '$firstname', '$lastname', '$filename')";
	// 	if($conn->query($sql)){
	// 		$_SESSION['success'] = 'Voter added successfully';
	// 	}
	// 	else{
	// 		$_SESSION['error'] = $conn->error;
	// 	}

	// }
	// else{
	// 	$_SESSION['error'] = 'Fill up add form first';
	// }

	// header('location: voters.php');
?>

<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$filename = $_FILES['photo']['name'];

		if (!empty($filename)) {
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);	
		}

		// Generate a unique voter ID
		do {
			// Generate random number and format it
			$random_number = rand(1000, 9999);
			$voter_id = 'SG' . $random_number;

			// Check if the ID already exists
			$sql = "SELECT COUNT(*) AS count FROM voters WHERE voters_id = '$voter_id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
		} while ($row['count'] > 0); // Continue generating if the ID exists

		// Insert the new voter record
		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo) VALUES ('$voter_id', '$password', '$firstname', '$lastname', '$filename')";
		if ($conn->query($sql)) {
			$_SESSION['success'] = 'Voter added successfully';
		} else {
			$_SESSION['error'] = $conn->error;
		}
	} else {
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>
