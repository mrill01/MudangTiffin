<?php
session_start();

// Check if admin is logged in
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); // Redirect to login if not logged in
    exit;
}

// Path to the messages file
$messagesFile = 'messages.json';

// Read messages from the file
$messages = [];
if (file_exists($messagesFile)) {
    $messages = json_decode(file_get_contents($messagesFile), true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #555;
        }

        .message {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            background: #f9f9f9;
        }

        .message strong {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .message p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Submitted Messages</h1>
    <a href="logout.php">Logout</a>
    <?php if (empty($messages)): ?>
        <p>No messages found.</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <div class="message">
                <strong>Name:</strong> <?= htmlspecialchars($message['name']) ?>
                <strong>Email:</strong> <?= htmlspecialchars($message['email']) ?>
                <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($message['message'])) ?></p>
                <p><small><em>Submitted on: <?= htmlspecialchars($message['timestamp']) ?></em></small></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>