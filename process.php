<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'dbempleados') or die(mysqli_error($mysqli));

$update = false;
$id = 0;
$cedula = "";
$nombre = "";
$direccion = "";
$email = "";
$cel = "";

if (isset($_POST['save'])){
  $cedula = $_POST['cedula'];
  $nombre = $_POST['nombre'];
  $direccion = $_POST['direccion'];
  $email = $_POST['correo'];
  $cel = $_POST['cel'];

  $mysqli->query(
    "INSERT INTO empleados
    (cedula_empleado, nombre_empleado, direccion_empleado, email_empleado, celular_empleado)
    VALUES('$cedula', '$nombre', '$direccion', '$email', '$cel')"
  ) or die($mysqli->error) ;

  $_SESSION['message'] = "Empleado guardado exitosamente!";
  $_SESSION['msg_type'] = "success";

  header("location: clase2.php");
}

if (isset($_GET['delete'])){
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM empleados WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Empleado eliminado exitosamente!";
  $_SESSION['msg_type'] = "danger";

  header("location: clase2.php");
}

if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query(
    "SELECT id, cedula_empleado, nombre_empleado, direccion_empleado, email_empleado, celular_empleado FROM empleados WHERE id=$id"
  ) or die($mysqli->error());
  if ($result->num_rows > 0){
    $row = $result->fetch_array();
    $cedula = $row['cedula_empleado'];
    $nombre = $row['nombre_empleado'];
    $direccion = $row['direccion_empleado'];
    $email = $row['email_empleado'];
    $cel = $row['celular_empleado'];
  }
}

if (isset($_POST['update'])){
  $id = $_POST['id'];
  $cedula = $_POST['cedula'];
  $nombre = $_POST['nombre'];
  $direccion = $_POST['direccion'];
  $email = $_POST['correo'];
  $cel = $_POST['cel'];
  $mysqli->query(
    "UPDATE empleados SET cedula_empleado='$cedula', nombre_empleado = '$nombre',
    direccion_empleado = '$direccion', email_empleado = '$email',
    celular_empleado = '$cel' WHERE id=$id"
  ) or die($mysqli->error);

  $_SESSION['message'] = "Información modificada exitosamente!";
  $_SESSION['msg_type'] = "success";

  header("location: clase2.php");
}