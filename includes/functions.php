<?php
// Function to register hospital
function register_hospital($user_role, $hospital_name, $username, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO hospitals (user_role, hospital_name, username, password) VALUES ('$user_role', '$hospital_name', '$username', '$hashed_password')";
    return $conn->query($sql);
}
// Function to register receiver
function register_receiver($user_role,$receiver_name, $blood_group, $username, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO receivers (user_role,receiver_name, blood_group, username, password) VALUES ('$user_role','$receiver_name', '$blood_group', '$username', '$hashed_password')";
    return $conn->query($sql);
}

// Function to add blood info by hospital
function add_blood_info($hospital_id, $blood_group, $quantity) {
    global $conn;
    $sql = "INSERT INTO blood_samples (hospital_id, blood_group, quantity) VALUES ('$hospital_id', '$blood_group', '$quantity')";
    return $conn->query($sql);
}

// Function to get available blood samples
function get_available_samples() {
    global $conn;
    $sql = "SELECT * FROM blood_samples";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Add more functions for viewing requests, requesting samples, etc.
?>
