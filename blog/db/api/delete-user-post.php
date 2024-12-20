<?php
// Informacja dla klienta (np. przegladarki), ze odpowiedz bedzie w formacie JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
//header("Access-Control-Allow-Methods: DELETE");
//$allowed_origins = ['http://localhost', 'http://127.0.0.1'];

//if (in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
//    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
//}

header("Access-Control-Allow-Origin: *");

require_once "../db-connect.php";

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Odbieramy dane z ciala zadania
    $inputData = json_decode(file_get_contents("php://input"));

    // Sprawdzamy czy w ciele jest postId
    if (isset($inputData->postId)) {
        $postId = intval($inputData->postId);
        try {
            $conn = new mysqli(
                MySQLConfig::SERVER,
                MySQLConfig::USER,
                MySQLConfig::PASSWORD,
                MySQLConfig::DATABASE
            );
            $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
            $stmt->bind_param("i", $postId);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "Usunięto post o numerze " . $postId]);
            }
            else {
                echo json_encode(["success" => false, "message" => "Nie ma posta o numerze " . $postId]);
            }
            $stmt->close();
            $conn->close();

        }
        catch (Exception $e) {
            http_response_code(500); // Internal Server Error - blad polaczenia z serwerem
            echo json_encode(["success" => false, "message" => "Error: " .$e->getMessage()]);
            exit();
        }
    }
    else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid type parameter"]);
        exit();
    }



}
else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit();
}

//$postId = $_GET["postId"] ?? null;
//$value = $_GET["value"] ?? null;

//// Walidacja parametrow
//if (!$type || !$value) {
//    http_response_code(400); // Bad request - bledna skladnia
//    echo json_encode(["success" => false, "message" => "Invalid request parameters"]);
//    exit();
//}
//
//try {
//    $conn = new mysqli(

//}
