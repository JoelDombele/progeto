<?php
          $url = parse_url($_SERVER['REQUEST_URI'])['path'];

          
          $routes = [
               '/index' => 'view/index.view.php',
               '/cursos' => 'controller/cursosGratuitos.php',
               '/instrutor' => 'controller/painel.php',
               '/MeusCursos' => 'controller/userCursos.php',
               '/logOut' => 'controller/logOut.php'
          ];

          if(array_key_exists($url,$routes)){
               require $routes[$url];
          }else{
               http_response_code(404);

               echo'Desculpe, Pagina Não encontrada';

               die();
          }

       ?>