<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ANIMAL.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(),  from: ANIMAL,  orderBy: PAS_NOMBRE);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[PAS_ID]);
  $id = htmlentities($encodeId);
  $nombre = htmlentities($modelo[PAS_NOMBRE]);
  $especie = htmlentities($modelo[PAS_especie]);
  $habitat = htmlentities($modelo[PAS_HABITAT]);
  $render .=
   "<li>
     <p>
      <a href='modifica.html?id=$id'>$nombre, $especie, $habitat</a>
     </p>
    </li>";
 }

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});