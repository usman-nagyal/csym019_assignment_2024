<?php
// Read existing JSON data from League.json
$jsonFile = 'League.json';
$currentData = file_get_contents($jsonFile);
$data = json_decode($currentData, true);
$postData = file_get_contents("php://input");
$newTeam = json_decode($postData, true);

// Check if all required fields are submitted
if(isset($newTeam['name'])) {
    // Retrieve new team data from POST request
    // $newTeam = array(
    //     'name' => $_POST['name'],
    //     'played' => intval($_POST['played']),
    //     'points' => intval($_POST['points']),
    //     'goalDifference' => intval($_POST['goalDifference'])
    // );

    // Add new team to teams array
    $data['teams'][] = $newTeam;

    // Write updated JSON data back to League.json
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

    // Response (optional): send JSON response back to client
    header('Content-Type: application/json');
    echo json_encode(array('success' => true));
} else {
    // If any required field is missing, send an error response
    http_response_code(400); // Bad request
    echo json_encode(array('error' => 'Missing required fields'));
}
?>
