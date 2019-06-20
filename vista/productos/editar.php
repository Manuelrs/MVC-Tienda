<h2>Editar producto</h2>
<form method="post" enctype="multipart/form-data" action="index.php?seccion=productos&accion=actualizar">
    <input type="hidden" name="id"  value="<?=$productos['idproducto']?>">
    Nombre: <input type="text" name="nombre" value="<?=$productos['nombre']?>">
    Descripción: <input type="text" name="descripcion" value="<?=$productos['descripcion']?>">
    Precio: <input type="text" name="precio" value="<?=$productos['precio']?>">
    Categoria: <select name="categoria">
	<?php
	foreach ($categorias as $categoria){
	    ?>
	    
	<option <?=(($categoria['idcategoria']==$productos['idcategoria'])?'selected':'')?> 
	    value="<?=$categoria['idcategoria']?>"><?=$categoria['nombre']?></option>
	<?php
	}
	?>
    </select>
    <input type="file" name="imagen">
    <input type="submit">
</form>

