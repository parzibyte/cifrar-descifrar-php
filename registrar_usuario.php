<?php
// Registrar usuario y generar clave a partir de la contraseña
// https://parzibyte.me/blog
require_once "vendor/autoload.php";
use Defuse\Crypto\KeyProtectedByPassword;
// Esta contraseña es del usuario, cuando se registra
$passwordUsuario = "hunter2";
/*
Aquí guarda al usuario, cifra su contraseña y todo
eso como normalmente lo haces
NO guardes la contraseña en texto plano dentro de la base de datos; mejor
usa un hash como bcrypt:
https://parzibyte.me/blog/2017/11/13/cifrando-comprobando-contrasenas-en-php/
 */
// Si el registro es correcto, le generamos una clave, que será su clave de cifrado
// Fíjate que le pasamos la contraseña en texto plano
$claveDeUsuario = KeyProtectedByPassword::createRandomPasswordProtectedKey($passwordUsuario);
$claveDeUsuarioAscii = $claveDeUsuario->saveToAsciiSafeString();
// La clave debería ser guardada; ya sea en la base de datos o en otro lugar,
// y debe estar ligada al usuario
echo $claveDeUsuarioAscii;
