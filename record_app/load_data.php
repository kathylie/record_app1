<?php

include_once("../../db.php");
require ('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');

// Database connection
$servername = "localhost";
$username = "root";
$password = "110515"; // Enclose the password in double quotes
$dbname = "recordApp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// generate 200 rows in Employee Table
for ($i = 1; $i <= 200; $i++) {
    $lastname = $faker->lastName;
    $firstname = $faker->firstName;
    $office_id = $faker->numberBetween(1, 50); // Randomly select an office_id
    $address = $faker->address;

    $sql = "INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lastname, $firstname, $office_id, $address]);
}
//Generate 5o rows in Office
for ($i = 1; $i <= 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->email;
    $address = $faker->address;
    $city = $faker->city;
    $country = 'Philippines';
    $postal = $faker->postcode;

    $sql = "INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $contactnum, $email, $address, $city, $country, $postal]);
}

//Generate 500 rows in Transaction table
for ($i = 1; $i <= 500; $i++) {
    $employee_id = $faker->numberBetween(1, 200); // Randomly select an employee_id
    $office_id = $faker->numberBetween(1, 50); // Randomly select an office_id
    $datelog = $faker->dateTimeThisDecade->format('Y-m-d H:i:s');
    $action = $faker->randomElement(['In', 'Out']);
    $remarks = $faker->sentence;
    $documentcode = $faker->ean13;

    $sql = "INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employee_id, $office_id, $datelog, $action, $remarks, $documentcode]);
}

foreach ($data as $row) {
    $stmt->bindParam(':name', $row);
    $stmt->execute();
}

$conn->close(); // Close the database connection
?>



