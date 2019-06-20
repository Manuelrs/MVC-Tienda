<?php

require_once 'modelo/productos.php';
require_once 'modelo/categorias.php';

class productos{
    
    private $pro;
    
    function __construct() {
        $this->pro = new mProductos();
    }
    
    function ver() {

        $productos = $this->pro->getAll();
        require_once 'vista/productos/ver.php';
    }
    
    function detalle() {

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($id)) {
            require_once 'vista/home.php';
        } else {
            $productos = $this->pro->getById($id);
	    $cat=new mCategorias();
	    $categoria=$cat->getById($productos['idcategoria']);
            //  $productos = $this->cat->productosPorCategoria($id);
            require_once 'vista/productos/detalle.php';
        }
    }
    
    function nueva() {
	$cat=new mCategorias();
	$categorias=$cat->getAll();
        require_once 'vista/productos/nueva.php';
    }
    
    function insertar() {
        $nombre = filter_input(INPUT_POST, "nombre");
        $descripcion = filter_input(INPUT_POST, "descripcion");
	$precio = filter_input(INPUT_POST, "precio"); 
	$idcategoria= filter_input(INPUT_POST, "categoria"); 
        if (!empty($nombre) && !empty($descripcion) && !empty($precio) && !empty($idcategoria)) {
            $id=$this->pro->create(['nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'idcategoria' => $idcategoria]);
	      if (isset($_FILES['imagen'])) {
                if (strpos($_FILES['imagen']['type'], "image") !== false) {
                    move_uploaded_file($_FILES['imagen']['tmp_name'], "img/productos/" . $id.".jpg");
                    echo "Imagen subida<br>";
                } else {
                    echo "Formato de archivo incorrecto. <br>";
                }
            }
            echo "<p>Producto insertado</p>";
        } else {
            echo "<p>Nombre, descripción  o precio incorrectos</p>";
        }
        $this->ver();
    }
    
    function buscar() {
        $nombre = filter_input(INPUT_POST, "nombre");
         if (!empty($nombre)) {
            $productos=$this->pro->search(['nombre' => $nombre]); // Esto se pasa a $filtro en la funcion "search".
           
        } else {
            $productos = $this->pro->getAll();;
        }
       require_once 'vista/productos/ver.php';
    }
    
    function editar() {

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($id)) {
            require_once 'vista/home.php';
        } else {
            $productos = $this->pro->getById($id);
	    $cat=new mCategorias();
	    $categorias=$cat->getAll();
            require_once 'vista/productos/editar.php';
        }
    }
    
    function actualizar() {
        $id = filter_input(INPUT_POST, "id");
        $nombre = filter_input(INPUT_POST, "nombre");
        $descripcion = filter_input(INPUT_POST, "descripcion");
	$precio = filter_input(INPUT_POST, "precio");
	$idcategoria = filter_input(INPUT_POST, "categoria");
        if (!empty($id) && !empty($nombre) && !empty($descripcion) && !empty($precio) && !empty($idcategoria) && is_numeric($precio)) {
            $this->pro->update(['nombre' => $nombre, 'descripcion' => $descripcion, 'id' => $id, 'precio' => $precio, 'idcategoria' => $idcategoria]);
	       if (isset($_FILES['imagen'])) {
                if (strpos($_FILES['imagen']['type'], "image") !== false) {
                    move_uploaded_file($_FILES['imagen']['tmp_name'], "img/productos/" . $id.".jpg");
                    echo "Imagen subida<br>";
                } else {
                    echo "Formato de archivo incorrecto. <br>";
                }
            }
            echo "<p>Producto actualizado</p>";
        } else {
            echo "<p>Nombre o descripción incorrectos</p>";
        }
        $this->ver();
    }
    
    function borrar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($id)) {
            require_once 'vista/home.php';
        } else {
            $productos = $this->pro->delete($id);
            $this->ver();
        }
    }
    
}

