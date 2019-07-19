<?php

// Desbloquear y guardar clave de usuario, usando su contraseña
// https://parzibyte.me/blog
require_once "vendor/autoload.php";
use Defuse\Crypto\KeyProtectedByPassword;

$passwordUsuario = "hunter2";

// Aquí debes comprobar si la contraseña es correcta y todo eso; en
// caso de que no, sal del script inmediatamente

// Sacar la clave de la base de datos o de donde se haya guardado
$claveProtegidaUsuarioAscii = "def10000def50200207af95c575b163601190c1eab6e8d617adad9368c889876d4d64c92b48e0b2eb4dc97060da78cd5a737095e95fcbface352629ed5f16d6fa53c19158d846e25f4280e5c2b85cdfcefff8eb2fd37ace74d1c2ced8262584dbe86870c9ee8ef33e0efd1e9876f9141075a2da047d744eef149ee2e9d1ba89af062054dbc399c0b6d0004316843a2bd17619314f51d625fa2f2df8ad2d0ba50cca6c783eaa1e8a843264c081b25b4fc1c7eec1301bcb2c2c6c587b034e86eb2bd04e2d06b1579942514cfaac9952308c4eec25c959fbbba1b578e0cba6cebec79a61d733ab94b1410565cdd2e85e6b1879ebbb39b1314d6f75aafb5c6dd35d3";
$claveProtegidaUsuario = KeyProtectedByPassword::loadFromAsciiSafeString($claveProtegidaUsuarioAscii);
// Desbloquearla con la contraseña del usuario
$claveDesbloqueada = $claveProtegidaUsuario->unlockKey($passwordUsuario);
$claveDesbloqueadaAscii = $claveDesbloqueada->saveToAsciiSafeString();

// Ahora guárdala en un lugar accesible, como la sesión; y asegúrate de
// destruir los datos cuando el usuario cierre sesión
// No se hace todo este proceso de desbloqueo porque es inseguro tener la contraseña
// plana almacenada por ahí, y también porque es un poco tardado
session_start();
$_SESSION["clave"] = $claveDesbloqueadaAscii;
