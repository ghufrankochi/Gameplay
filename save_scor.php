<?php
// Database connection settings
$host = 'localhost';
$dbname = 'game_database';
$user = 'root'; // د MySQL ډیفالټ یوزر
$password = ''; // که د پاسورډ نه وي، نو خالي پرېږدئ

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get JSON data from the client
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['score'])) {
        $score = $data['score'];

        // Insert score into the database
        $stmt = $pdo->prepare("INSERT INTO scores (score) VALUES (:score)");
        $stmt->bindParam(':score', $score, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}