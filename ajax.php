<?php
// // Connect to the database
// $mysqli = mysqli_connect('localhost', 'root', '', 'MyHouse');
// if (!$mysqli) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// if(isset($_GET['buildingName'])){
//     // Get the building name parameter
//     $buildingName = $_GET['buildingName'];


//     // Prepare the SQL query to get suggestions for the building name
//     $query = "SELECT DISTINCT Apartment_name FROM Apartments WHERE Apartment_name LIKE ?";
//     $stmt = mysqli_prepare($mysqli, $query);
//     mysqli_stmt_bind_param($stmt, "s", $buildingNameParam);

//     // Execute the query with the user input as a parameter
//     $buildingNameParam = $buildingName . '%';
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);

//     // Build the HTML for the suggestion list
//     $suggestions = '';
//     while ($row = mysqli_fetch_assoc($result)) {
//         $suggestions .= '<div class="building-name-suggestion">' . $row['Apartment_name'] . '</div>';
//     }

//     // Return the suggestions HTML
//     echo $suggestions;

//     // Close the database connection
//     mysqli_stmt_close($stmt);
//     mysqli_close($mysqli);
// }

// else echo "ERROR:: BUILDING NAME NOT SET";

$conn = mysqli_connect('localhost','root','','MyHouse');

if (!$conn){echo "CONNECTION ERROR".mysqli_connect_error();}

if (isset($_POST['buildingName'])) {
    $buildingName = $_POST['buildingName'];
    $buildingName_metaphone = metaphone($buildingName);
    $buildingName_metaphone_half = substr($buildingName_metaphone,0,strlen($buildingName_metaphone)/2);
    echo "INPUT METAPHONE::".$buildingName_metaphone."  "."half:: ".$buildingName_metaphone_half."<br>";
    echo "BETTIAN"." ".metaphone("BETTIAN")."<BR>";
    $sql_query = "Select Apartment_Name from Apartments";
    $result = mysqli_query($conn,$sql_query);

    //loop through the associative array and compare the metaphones

    while ($row = mysqli_fetch_assoc($result)) {
        $buildingQuery_metaphone = metaphone($row['Apartment_Name']);
        $buildingQuery_metaphone_half = substr($buildingQuery_metaphone,0,strlen($buildingQuery_metaphone)/2);

        // if ($buildingQuery_metaphone_half == $buildingName_metaphone_half){
        //     echo "SUGGESTIONS::".$row['Apartment_Name'].$buildingQuery_metaphone."HALF::".$buildingQuery_metaphone_half."<br>";
        // }
        if (strstr($buildingQuery_metaphone,$buildingName_metaphone)){
            echo "SUGGESTIONS::".$row['Apartment_Name'].$buildingQuery_metaphone."<br>";
        }
    }
    mysqli_close($conn);
}





?>

<!DOCTYPE html>
<html>
<head>
	<title>AJAX Example</title>
	
</head>
<body>
	<form action="#" method="POST">
		<label for="buildingName">Building Name:</label>
		<input type="text" id="buildingName" name="buildingName">
		<div id="buildingNameSuggestions"></div>
		<br>
		<!-- <label for="apartmentUnit">Apartment Unit:</label>
		<select id="apartmentUnit" name="apartmentUnit" disabled>
			<option value="">Select Building Name first</option>
		</select> -->
	</form>
    <div class="suggestions"></div>
</body>
</html>
