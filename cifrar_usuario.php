<?php

// Cifrar datos con contraseña de usuario
// https://parzibyte.me/blog
require_once "vendor/autoload.php";
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

// Ahora vamos a cifrar; recuerda que ya desbloqueamos la clave anteriormente
// y que ahora está en la sesión. Mira login.php para más información
session_start();
$claveAscii = $_SESSION["clave"];
$clave = Key::loadFromAsciiSafeString($claveAscii);

// Definir los datos a encriptar
$datos = "Hola, mundo. Soy un mensaje muy secreto";

// Encriptar, usando la clave del usuario
$datosEncriptados = Crypto::encrypt($datos, $clave);

// Guardarlos; en mi caso lo imprimo
echo $datosEncriptados;

// Salida:
//def502007436b388ae3b265aae2ce07729a6e46018418a70c8d5ea32ab593541b1d6ab91215733088a538474d11ac900fade2f52d40332dc53d0c00a43d848e6902edbc02e9f5abe6ff0f76f251fb64c0d716a8dccf9df5292c6e291da3ff1de21afa02367f5746ea1118d25c8e0841d61e1faae82040d0640448c
