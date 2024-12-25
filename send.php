<?php

// Заголовки для разрешения CORS
header("Access-Control-Allow-Origin: *"); // Разрешает запросы с любого источника
header("Access-Control-Allow-Methods: POST"); // Разрешает только POST-запросы
header("Access-Control-Allow-Headers: Content-Type"); // Разрешает заголовок Content-Type

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$email = $data['email'];
$comment = $data['comment'];

$to = 'mk3mk@yandex.ru';
$subject = 'Новый отзыв от пользователя';
$message = "Имя: $name\nEmail: $email\nОтзыв: $comment";
$headers = "From: $email\r\n";

if (mail($to, $subject, $message, $headers)) {
    http_response_code(200);
    echo json_encode(['message' => 'Отзыв отправлен!']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Ошибка при отправке отзыва.']);
}
?>
