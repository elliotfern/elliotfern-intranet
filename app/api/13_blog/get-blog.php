<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = getallheaders();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Llistat articles blog
        // ruta GET => "/api/blog/get/?llistat-articles"
        if (isset($_GET['llistat-articles'])) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT b.id, b.post_type, b.post_title, b.post_date, id.idioma_ca, b.slug
            FROM db_blog AS b
            LEFT JOIN aux_idiomes AS id ON b.lang = id.id
            ORDER BY b.id ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // ruta articles slug
        } elseif (isset($params['slugArticles'])) {
            $slug = $params['slugArticles'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT b.id, b.post_type, b.post_title, b.post_date, id.idioma_ca, b.slug, b.post_content
            FROM db_blog AS b
            LEFT JOIN aux_idiomes AS id ON b.lang = id.id
            WHERE b.slug = :slug");
            $stmt->execute(['slug' => $slug]);
            
            if ($stmt->rowCount() === 0) {
                echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
            } else {
                // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($row);  // Codifica la fila como un objeto JSON
            }

        } else {
            // Si 'type', 'id' o 'token' están ausentes o 'type' no es 'user' en la URL
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit();
        }

    } else {
    // Token no válido
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Invalid token']);
    exit();
    }

} else {
// No se proporcionó un token
header('HTTP/1.1 403 Forbidden');
echo json_encode(['error' => 'Access not allowed']);
exit();
}

// Cerrar la conexión a la base de datos después de su uso
$conn = null;
?>