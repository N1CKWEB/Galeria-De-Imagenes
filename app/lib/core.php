<?php

  class Core{

    
    protected $controller;
    protected $method;
    protected $parameters = [];

    public function __construct(){
      $this->getUrl();

      // Si existe un controlador
      if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
  {
    // Uso ucwords para comvertir la primer letra en mayuscula
    $this->controller = ucwords($url[0]);
    // Unset elimina el valor anterior
    unset($url[0]);
  }

  require_once '../app/controllers/' . $this->controller . '.php';
  $this->controller = new $this->controller;
  // Si un valor en [1] osea un metodo
  if(isset($url[1]))
  {

    if(method_exists($this->controller, $url[1]))
    {
      // Si existe el metodo lo asignamos a la variable
      $this->method = $url[1];
      // Elimina el valor anterior 
      unset($url[1]);
    }
  }
  // Parametros es un array vacio, usamos array_values para no guardar un array dentro de otro array
  $this->parameters = $url ? array_values($url) : [];
  // Con call_user_func_array llamamos el valor de controller y method luego le pasamos los parametros 
  call_user_func_array([$this->controller, $this->method], $this->parameters);
}

    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
      }
    }
  }