<?php
// Incluye el archivo de configuración y funciones de la base de datos
include_once 'config.php';

// Obtener los usuarios desde la API
function fetchUsers() {
    $url = 'https://test.nexwey.online/api-restfull/api.php'; // Reemplaza con la URL de tu API
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Obtén los usuarios para mostrar en la tabla
$users = fetchUsers();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Usuarios</title>
    <!-- Agrega Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu archivo de estilos -->
    <style>
      body {
          background: linear-gradient(to right, #050116 0%, #140112 50%, #061d01 100%) ;
          color: white;
          
      }
  
      
  
      .table {
          background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro para la tabla */
          color: white; /* Texto en blanco */
          align-items: center;
          justify-content: center;
      }
  
      .table th, .table td {
          border: 1px solid #444; /* Bordes oscuros */
          align-items: center;
          justify-content: center;
      }
  
      .table th {
          background-color: #222; /* Fondo oscuro para encabezados */
          color: white; /* Texto en blanco */
      }
  
      .table td {
          background-color: #333; /* Fondo oscuro para celdas */
          color: white; /* Texto en blanco */
      }
  
      /* Estilo de botones */
  
      .btn-primary {
          background-color: #9b2d8d; /* Morado fluorescente */
          border-color: #9b2d8d;
      }
  
      .btn-primary:hover {
          background-color: #b53d9e; /* Morado fluorescente más claro */
          border-color: #b53d9e;
      }
  
      .btn-warning {
          background-color: #ffcc00; /* Amarillo fluorescente */
          border-color: #ffcc00;
      }
  
      .btn-warning:hover {
          background-color: #ffdb33;
          border-color: #ffdb33;
      }
  
      .btn-danger {
          background-color: #d50032; /* Rojo fluorescente */
          border-color: #d50032;
      }
  
      .btn-danger:hover {
          background-color: #ff4d5c;
          border-color: #ff4d5c;
      }
  
      /* Estilo de los modales */
      .modal-content {
          background: #333;
          color: white;
      }
  
      .modal-header, .modal-footer {
          background-color: #444;
      }
  
      .modal-title {
          color: #ffcc00; /* Título en amarillo fluorescente */
      }
  </style>
</head>
<body>

<div class="container mt-5">
    <h1>Usuarios - API</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <!-- Botones para actualizar y eliminar -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateUserModal" 
                                onclick="openUpdateModal(<?php echo $user['id']; ?>, '<?php echo $user['name']; ?>', '<?php echo $user['email']; ?>')">Actualizar</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                onclick="openDeleteModal(<?php echo $user['id']; ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Crear Nuevo Usuario</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Nuevo Usuario</button>
</div>

<!-- Modal para Crear Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Crear Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createUserForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <button type="submit" class="btn btn-success">Crear Usuario</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Actualizar Usuario -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateUserModalLabel">Actualizar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateUserForm">
            <input type="hidden" id="updateUserId">
            <div class="mb-3">
                <label for="updateName" class="form-label">Nombre</label>
                <input type="text" id="updateName" class="form-control" placeholder="Nuevo Nombre" required>
            </div>
            <div class="mb-3">
                <label for="updateEmail" class="form-label">Correo Electrónico</label>
                <input type="email" id="updateEmail" class="form-control" placeholder="Nuevo Correo Electrónico" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Usuario</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Confirmar Eliminación -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que quieres eliminar este usuario?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="deleteConfirmBtn">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Agrega Bootstrap JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Función para crear un nuevo usuario
    document.getElementById('createUserForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;

        fetch('https://test.nexwey.online/api-restfull/api.php', { // Reemplaza con la URL de tu API
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: name, email: email })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.status);
            location.reload(); // Recarga la página para ver los cambios
            $('#createUserModal').modal('hide'); // Cierra el modal
        });
    });

    // Función para abrir el modal de actualización con los datos del usuario
    function openUpdateModal(id, name, email) {
        document.getElementById('updateUserId').value = id;
        document.getElementById('updateName').value = name;
        document.getElementById('updateEmail').value = email;
    }

    // Función para actualizar un usuario
    document.getElementById('updateUserForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('updateUserId').value;
        const name = document.getElementById('updateName').value;
        const email = document.getElementById('updateEmail').value;

        fetch('https://test.nexwey.online/api-restfull/api.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id, name: name, email: email })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.status);
            location.reload(); // Recarga la página para ver los cambios
            $('#updateUserModal').modal('hide'); // Cierra el modal
        });
    });

    // Función para abrir el modal de eliminación
    function openDeleteModal(id) {
        document.getElementById('deleteConfirmBtn').onclick = function() {
            fetch('https://test.nexwey.online/api-restfull/api.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.status);
                location.reload(); // Recarga la página para ver los cambios
                $('#deleteUserModal').modal('hide'); // Cierra el modal
            });
        };
    }
</script>

</body>
</html>
