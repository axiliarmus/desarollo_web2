<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techsolutions";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar mensaje
$mensajeEnvio = "";

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    // Validar campos
    if (!empty($nombre) && !empty($correo) && !empty($asunto) && !empty($mensaje)) {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO contactos (nombre, correo, asunto, mensaje) VALUES ('$nombre', '$correo', '$asunto', '$mensaje')";

        if ($conn->query($sql) === TRUE) {
            $mensajeEnvio = "Mensaje enviado correctamente.";
        } else {
            $mensajeEnvio = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $mensajeEnvio = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - TechSolutions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Contacto</h2>

  <!-- Mostrar mensaje de envío -->
  <?php if (!empty($mensajeEnvio)): ?>
    <div class="alert alert-info">
      <?php echo $mensajeEnvio; ?>
    </div>
  <?php endif; ?>

  <!-- Formulario de Contacto -->
  <form method="POST" action="">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <div class="mb-3">
      <label for="asunto" class="form-label">Asunto</label>
      <input type="text" class="form-control" id="asunto" name="asunto" required>
    </div>
    <div class="mb-3">
      <label for="mensaje" class="form-label">Mensaje</label>
      <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
