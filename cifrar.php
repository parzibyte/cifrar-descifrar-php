<?php
/**
 * Cifrar datos con PHP usando php-encryption
 *
 * https://parzibyte.me/blog
 *
 */
require_once "vendor/autoload.php";

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

// Este mensaje puede venir de otro lugar
$mensajeSecreto = "Encriptando con PHP desde parzibyte.me";
// No olvides guardar la clave en un lugar seguro; aquí lo pongo así de simple para ejemplos de
// simplicidad
$contenido = file_get_contents("clave.txt");
// Cargar la clave desde una cadena ASCII (pues la clave no es tan legible ni entendible como una simple cadena)
$clave = Key::loadFromAsciiSafeString($contenido);
// Y ya podemos cifrar datos
$mensajeCifrado = Crypto::encrypt($mensajeSecreto, $clave);
// Este mensaje ya está cifrado; puedes guardarlo en la base de datos ;)
echo $mensajeCifrado;
