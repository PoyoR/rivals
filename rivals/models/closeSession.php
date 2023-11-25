<?php
header('Content-Type: application/json');
session_start();
if( ! isset( $_SESSION["rivals"] ) || empty( $_SESSION["rivals"] ) ):
  echo "<h1 style='text-align:center;color: #af4040;position: absolute;top: 40%;left: 50%;transform: translate(-50%, -50%) skewX(15deg);font-size: 60px;'>Acceso denegado!!</h1>";
  http_response_code(403);
  exit;
endif;

unset( $_SESSION["rivals"], $_SESSION["rivals_user"], $_SESSION["rivals_perfil"], $_SESSION["rivals_battletag"] );

if( ! isset( $_SESSION["crerivalsdicel"] ) )
  echo json_encode(['status' => 1]);
else
  echo json_encode(['status' => 0]);
