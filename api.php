<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = getDB();

// Rutas de la API
switch ($method) {
    case 'GET':
        // Obtener todos los usuarios
        if (isset($_GET['id'])) {
            // Obtener un usuario específico
            $id = $_GET['id'];
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            // Obtener todos los usuarios
            $stmt = $db->query("SELECT * FROM users");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        break;

    case 'POST':
        // Crear un nuevo usuario
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute(['name' => $data['name'], 'email' => $data['email']]);
        echo json_encode(['status' => 'User created']);
        break;

    case 'PUT':
        // Actualizar un usuario
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->execute(['name' => $data['name'], 'email' => $data['email'], 'id' => $data['id']]);
        echo json_encode(['status' => 'User updated']);
        break;

    case 'DELETE':
        // Eliminar un usuario
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $data['id']]);
        echo json_encode(['status' => 'User deleted']);
        break;

    default:
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
?>
