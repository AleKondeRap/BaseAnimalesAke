<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaHabitat.php";
require_once __DIR__ . "/../lib/php/validaespecie.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ANIMAL.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $especie = recuperaTexto("especie");
 $habitat = recuperaTexto("habitat");
 $nombre = validaNombre($nombre);
 $especie = validaespecie($especie);
 $habitat = validaHabitat($habitat);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: ANIMAL, values: [PAS_NOMBRE => $nombre, PAS_especie => $especie, PAS_HABITAT => $habitat]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/pasatiempo.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "especie" => ["value" => $especie],
  "habitat" => ["value" => $habitat],
 ]);
});
