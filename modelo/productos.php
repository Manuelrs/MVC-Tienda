<?php

require_once 'bd.php';

class mProductos extends BD{
    
    function getAll() {
        $sql = "select * from productos";
        return $this->fetch($sql);
    }
    
    function getById($id) {
        $sql = "select * from productos where idproducto=:id";
        $prods = $this->fetch($sql, ['id' => $id]); // lo pasa a "$param=[]"
        return $prods[0];
    }
    
    function search($filtro) {
        $sql = "select * from productos where 1=1 "; // Si es "true", recibiendo numero, $clave=$valor. SINO $clave like %$valor%.
        foreach ($filtro as $clave => $valor) {
            if (is_numeric($valor)){
		 $sql .= " and $clave = $valor ";
            }else{
                 $sql .= " and $clave like '%$valor%' ";
            }
        }
       
        return $this->fetch($sql);
    }
    
    function create($data) {
        $sql = "insert into productos (nombre,descripcion,precio,idcategoria) values (:nombre,:descripcion,:precio,:idcategoria)";
        $this->execute($sql, $data);
	return $this->conn->lastInsertId();
    }
    
    function update($data) {
        $sql = "update productos set nombre=:nombre, descripcion=:descripcion, precio=:precio, idcategoria=:idcategoria where idproducto=:id";
        $this->execute($sql, $data);
    }
    
    function delete($id) {
        $sql = "delete from productos where idproducto=:id";
        $this->execute($sql, ['id' => $id]);
    }
    
    
}

