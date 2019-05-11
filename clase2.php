<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Gabriel Coronado">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Actualización de datos</title>
  <style>
    .datos {
      border: 1px solid rgba(0, 0, 0, .1);
      padding: 20px;
      margin: 1em auto;
    }
  </style>
</head>
<body>
  <?php require_once 'process.php'; ?>

  <?php if (isset($_SESSION['message'])) : ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>

  <?php
    $mysqli = new mysqli('localhost', 'root', '', 'dbempleados') or die(mysqli_error($mysqli));
    $result = $mysqli->query(
      "SELECT id, cedula_empleado, nombre_empleado, direccion_empleado, email_empleado, celular_empleado FROM empleados"
    ) or die($mysqli->error);
  ?>

  <div class="container mt-2">
    <h2 class="text-center" title="Author: Gabriel Coronado">Actualización de datos</h2>
    <p class="text-center">Bienvenido, por favor diligencia la información que se presenta a continuación.</p>
    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <h6 class="mt-2">Datos personales</h6>
      <div class="datos">
        <div class="form-row mt-4">
          <div class="form-group col-md-4">
            <label for="inputCedula">Cédula: *</label>
            <input type="number" value="<?php echo $cedula; ?>" name="cedula" class="form-control" id="inputCedula" required autofocus>
          </div>
          <div class="form-group col-md-4">
            <label for="inputNombre">Nombre completo: *</label>
            <input type="text" value="<?php echo $nombre; ?>" name="nombre" class="form-control" id="inputNombre" required>
          </div>
          <div class="form-group col-md-4">
            <label for="inputDireccion">Dirección de residencia:</label>
            <input type="text" value="<?php echo $direccion; ?>" name="direccion" class="form-control" id="inputDireccion">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCorreo">Correo electrónico: *</label>
            <input type="email" value="<?php echo $email; ?>" name="correo" class="form-control" id="inputCorreo" required>
          </div>
          <div class="form-group col-md-6">
            <label for="inputCel">Número celular:</label>
            <input type="number" value="<?php echo $cel; ?>" name="cel" class="form-control" id="inputCel">
          </div>
        </div>
        <?php if ($update == true): ?>
          <button type="submit" name="update" class="btn btn-dark">Enviar formulario</button>
        <?php else: ?>
          <button type="submit" name="save" class="btn btn-dark">Enviar formulario</button>
        <?php endif; ?>
      </div>
    </form>
    <div class="table-responsive">
      <h6 class="mt-4">Tabla de información</h6>
      <table class="table datos table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">Cédula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Dirección</th>
            <th scope="col">Email</th>
            <th scope="col">Celular</th>
            <th scope="col" colspan="2" class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['cedula_empleado']; ?></td>
            <td><?php echo $row['nombre_empleado']; ?></td>
            <td><?php echo $row['direccion_empleado']; ?></td>
            <td><?php echo $row['email_empleado']; ?></td>
            <td><?php echo $row['celular_empleado']; ?></td>
            <td>
              <a href="clase2.php?edit=<?php echo $row['id']; ?>" class="text-secondary btn btn-link">Editar</a>
            </td>
            <td>
              <a href="process.php?delete=<?php echo $row['id']; ?>" data-confirm="Are you sure?" class="text-danger btn btn-link" rel="nofollow" data-method="delete">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>