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

    // Get all scores from the database
    $stmt = $pdo->query("SELECT * FROM scores ORDER BY created_at DESC");
    $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #333;
            background-color: #ddd;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
        a:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <h1>Score List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Score</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($scores)): ?>
                <?php foreach ($scores as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['id']) ?></td>
                        <td><?= htmlspecialchars($score['score']) ?></td>
                        <td><?= htmlspecialchars($score['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No scores found!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.html">Back to Game</a>
</body>
</html>