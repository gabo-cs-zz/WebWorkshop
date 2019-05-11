<?php

$mysqli = new mysqli('localhost', 'root', '', 'dbempleados') or die(mysqli_error($mysqli));

if (isset($_POST['save'])){
  $cedula = $_POST['cedula'];
  $nombre = $_POST['nombre'];
  $direccion = $_POST['direccion'];
  $email = $_POST['correo'];
  $cel = $_POST['cel'];

  $mysqli->query(
    "INSERT INTO empleados
    (cedula_empleado, nombre_empelado, direccion_empleado, email_empleado, celular_empleado)
    VALUES('$cedula', '$nombre', '$direccion', '$email', '$cel')"
  ) or die($mysqli->error) ;
}