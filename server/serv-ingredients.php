<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the raw POST data
    $postData = file_get_contents('php://input');

    // Decode the JSON data
    $jsonData = json_decode($postData, true);

    // Check if the JSON decoding was successful
    if ($jsonData !== null) {
        // Extract the ingredients array
        $ingredientsArray = $jsonData['ingredients'];

        // Connect to your MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ingredients_store";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Inside the loop where you process each ingredient
        foreach ($ingredientsArray as $ingredient) {
            $id = $ingredient['id'];
            $name = $ingredient['name'];

            // Assuming you have additional data such as Continent, Country, Preference, etc.
            $continent = $jsonData['selectedContinent'];
            $country = $jsonData['selectedCountry'];
            $preference = $jsonData['selectedDiet'];
            $medicalCondition = $jsonData['selectedDiabeticStatus'];
            $majorMedicalCondition = $jsonData['selectedMajorMedicalCondition'];
            $cookingType = $jsonData['selectedCookingType'];
            $tasteType = $jsonData['selectedTasteType'];

            // Adjust the SQL query based on your table structure
            $sql = "INSERT INTO IngredientData 
                    (IngredientID, IngredientName, Continent, Country, Preference, MedicalCondition, MajorMedicalCondition, CookingType, TasteType) 
                    VALUES 
                    ('$id', '$name', '$continent', '$country', '$preference', '$medicalCondition', '$majorMedicalCondition', '$cookingType', '$tasteType')";

            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();

        // Send a response back to the client
        echo "Data inserted successfully";
    } else {
        // If JSON decoding fails
        echo "Error decoding JSON data";
    }
} else {
    // If the request method is not POST
    echo "Invalid request method";
}

?>
