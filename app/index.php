<?php
// Incluir la clase stackAPI para interactuar con la API de Pexels.
require("./stackAPI.class.php");
// Crear una instancia de la clase stackAPI.
$stacks = new stackAPI();
// Obtener el término de búsqueda desde la URL, si existe, o dejarlo en blanco si no.
$search = $_GET['search'] ?? "";
// Obtener el número de página desde la URL, o usar 1 como predeterminado.
$page = $_GET['page'] ?? 1;

// Si se ha proporcionado un término de búsqueda, buscar imágenes relacionadas.
// De lo contrario, obtener una selección curada de imágenes.
if (!empty($search))
    $get_image = $stacks->get_stack('search', ['per_page' => 40, "query" => $search, "page" => $page]);
else
    $get_image = $stacks->get_stack('curated', ['per_page' => 40, "page" => $page]);

// Calcular el número total de páginas basado en el total de resultados y el número de resultados por página.
$pages = ceil(($get_image['result']['total_results'] ?? 1) / 40);

require("./vistas/api.php");

?>
