<?php

$registration = array(
    'postal_regCode' => "'" . $_POST['inp_region'] . "'",
    'postal_provCode' => "'" . $_POST['inp_province'] . "'",
    'postal_citymunCode' => "'" . $_POST['inp_citymun'] . "'", // Corrected variable name
    'postal_code' => "'" . $_POST['inp_postalcode'] . "'",
);

save($registration);

function save($data)
{
    include("../config/database.php");

    // Get column names and values for the SQL query
    $attributes = implode(", ", array_keys($data));
    $values = implode(", ", array_values($data));
    $query = "INSERT INTO ph_postalcode ($attributes) VALUES ($values)";

    try {
        if ($conn->query($query) === TRUE) {
            header('location: /event-driven-prog/postalcode.php?success');
            exit(); 
        } else {
            // Handle insertion failure
            header('location: ../postalcode.php?error');
            exit();
        }
    } catch (Exception $e) {
        // Handle exception
        header('location: ../postalcode.php?error');
        exit();
    }
}
