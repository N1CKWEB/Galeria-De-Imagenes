<?php
class Views
{

  public function inicio()
  {
    echo "<h1>Pagina de Inicio</h1>";
  }

  public function update($id)
  {
    echo "Update view " . $id;
  }

}