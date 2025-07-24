<?php
// Read JSON payload
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize inputs
$businessName = htmlspecialchars($data['businessName']);
$score = intval($data['score']);
$confirmation = htmlspecialchars($data['confirmation']);

// Email settings
$to = "james@story-x.co.uk";
$subject = "New Employee NPS Response";
$headers = "From: noreply@genext.io\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Compose message
$message = "You have a new Employee NPS response:\n\n";
$message .= "Business Name: $businessName\n";
$message .= "Score: $score\n";
$message .= "Confirmed: $confirmation\n";
$message .= "Date: " . date('Y-m-d H:i:s') . "\n";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(["result" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["result" => "error", "message" => "Failed to send email."]);
}
?>