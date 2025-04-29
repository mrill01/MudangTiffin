<?php
// Set the file path for storing messages
$file_path = 'messages.json';

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Create an array to store the new message
    $new_message = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    // Read existing messages from the file
    $messages = [];
    if (file_exists($file_path)) {
        $messages = json_decode(file_get_contents($file_path), true) ?? [];
    }
    
    // Append the new message
    $messages[] = $new_message;
    
    // Save all messages back to the file
    file_put_contents($file_path, json_encode($messages, JSON_PRETTY_PRINT));
    
    // Redirect back to the contact page with a success message
    header('Location: index.html?success=1');
    exit();
}
?>