<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ścieżka do pliku, do którego zapisywane będą dane
    $file = "dane.txt";
    
    // Pobranie parametru określającego typ zapisu
    $action = $_POST['action'] ?? '';

    $log = "";
    switch ($action) {
        case 'save_note':
            // Zapis notatki
            $note_id = $_POST['note_id'] ?? '';
            $note_title = $_POST['note_title'] ?? '';
            $note_content = $_POST['note_content'] ?? '';
            $log = "[NOTE] ID: $note_id, Title: $note_title, Content: $note_content" . PHP_EOL;
            break;
        case 'save_cat':
            // Zapis danych kota
            $cat_id = $_POST['cat_id'] ?? '';
            $cat_name = $_POST['cat_name'] ?? '';
            $cat_rarity = $_POST['cat_rarity'] ?? '';
            $log = "[CAT] ID: $cat_id, Name: $cat_name, Rarity: $cat_rarity" . PHP_EOL;
            break;
        case 'save_box':
            // Zapis danych otwarcia skrzyni
            $box_data = $_POST['box_data'] ?? '';
            $log = "[BOX] Data: $box_data" . PHP_EOL;
            break;
        case 'save_email':
            // Zapis danych wysłanego emaila
            $email_to = $_POST['email_to'] ?? '';
            $email_subject = $_POST['email_subject'] ?? '';
            $email_message = $_POST['email_message'] ?? '';
            $log = "[EMAIL] To: $email_to, Subject: $email_subject, Message: $email_message" . PHP_EOL;
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Nieznana akcja']);
            exit;
    }
    
    // Zapis danych do pliku (tryb FILE_APPEND dodaje dane na końcu pliku)
    if (file_put_contents($file, $log, FILE_APPEND) !== false) {
        echo json_encode(['status' => 'success', 'message' => 'Dane zapisane pomyślnie!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Błąd zapisu danych.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Błędna metoda żądania.']);
}
?>
