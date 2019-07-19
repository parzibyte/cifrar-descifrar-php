<?php

// Descifrar datos con contraseña de usuario
// https://parzibyte.me/blog
require_once "vendor/autoload.php";

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;
use Defuse\Crypto\KeyProtectedByPassword;

// Ahora vamos a descifrar; recuerda que ya desbloqueamos la clave anteriormente
// y que ahora está en la sesión. Mira login.php para más información
session_start();
$claveAscii = $_SESSION["clave"];
$clave = Key::loadFromAsciiSafeString($claveAscii);

// Obtener datos encriptados de la base de datos
$datosEncriptados = "def502007436b388ae3b265aae2ce07729a6e46018418a70c8d5ea32ab593541b1d6ab91215733088a538474d11ac900fade2f52d40332dc53d0c00a43d848e6902edbc02e9f5abe6ff0f76f251fb64c0d716a8dccf9df5292c6e291da3ff1de21afa02367f5746ea1118d25c8e0841d61e1faae82040d0640448c";

// Intentar descifrar, usando la clave del usuario
try {

    $datosPlanos = Crypto::decrypt($datosEncriptados, $clave);
    // Usar los datos planos
    echo $datosPlanos;
} catch (WrongKeyOrModifiedCiphertextException $e) {
    echo "Error descifrando";
    // Cuidado, algo salió mal. Puede ser que:
    // Hayas desbloqueado mal la clave
    // Alguien ha modificado / corrompido los datos
}
