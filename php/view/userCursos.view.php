<?php
     echo '<div class="course max-w-md w-full bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
     echo '<img class="w-full h-48 object-cover mb-4" src="../imagens/' . $foto . '" alt="Imagem do Curso">';
     echo '<h2 class="text-xl font-semibold mb-2">' . $nome . '</h2>';
     
     echo '<b class="text-blue-600">$' . $preco . '</b>';
     echo '<a href="controller/user/aulaTable.php?id_curso=' . $id_curso . '" class="block mt-4 bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-300">Acessar</a>';
 
     echo '</div>';