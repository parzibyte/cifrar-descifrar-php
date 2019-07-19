<?php
/**
 * Descifrar datos con PHP usando php-encryption
 *
 * https://parzibyte.me/blog
 *
 */
require_once "vendor/autoload.php";

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Defuse\Crypto\Key\Exception\WrongKeyOrModifiedCiphertextException;

// El mensaje o datos cifrados; los cuales deberían recuperarse de una base de datos
$mensajeCifrado = "def5020008531ed581af5efd03d66bb886f85ceba5182ae7479af6921cc3a7a69f3418b7744bdbefe39e4d79a0e0b1ee1d89843d5ba7823ea1a9ae1c95d55f08eafe214554b8cb6667727d43768eabed8d67beb6f756cecef7d63eeecbdaf779b86c95c2aebac725f4f39ac48438c2c2859e6c8e0e5f121c29a6";
// No olvides guardar la clave en un lugar seguro; aquí lo pongo así de simple para ejemplos de
// simplicidad
$contenido = file_get_contents("clave.txt");
// Cargar la clave desde una cadena ASCII (pues la clave no es tan legible ni entendible como una simple cadena)
$clave = Key::loadFromAsciiSafeString($contenido);
// Y ya podemos descifrar datos. El método decrypt lanza una excepción si detecta
// datos corruptos o una clave incorrecta
try {
    $mensajeOriginal = Crypto::decrypt($mensajeCifrado, $clave);
    // Este mensaje es el original
    echo $mensajeOriginal;
} catch (WrongKeyOrModifiedCiphertextException $e) {
    exit("Los datos están corruptos o la clave es incorrecta");
}
