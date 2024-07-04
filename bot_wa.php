<?php
// Get the raw POST data
$postData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($postData, true);

// Handle the incoming data (implement your business logic here)
handleIncomingData($data);

// Respond to the platform (optional)
echo "Webhook received successfully.";

function handleIncomingData($data) {
    // Implement your business logic here
    // For example, you might extract information about the incoming message
    // and decide how to respond.
    // Note: This is just a placeholder; you need to customize it based on your needs.
    if (isset($data['message'])) {
        $sender = $data['from'];
        $message = $data['message'];

        // Implement your logic to handle the incoming message
        // For example, you might send a response using the WhatsApp Business API.
        // sendResponse($sender, "Received your message: $message");
    }
}

function sendResponse($recipient, $message) {
    $apiUrl = 'https://api.whatsapp.com/send?phone=6285924515689&text=Hello,%20World!';

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle the response as needed

}
?>
