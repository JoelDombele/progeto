<?php
          $url = parse_url($_SERVER['REQUEST_URI'])['path'];

          require 'routes.php';

          if(array_key_exists($url,$routes)){
               require $routes[$url];
          }else{
               http_response_code(404);

               echo'Desculpe, Pagina Não encontrada';

               die();
          }

       ?>