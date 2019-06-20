<h1>Detalle de producto</h1>
<p>Id: <strong><?=$productos['idproducto']?></strong></p>
<p>Nombre: <strong><?=$productos['nombre']?></strong></p>
<p>Descripción: <strong><?=$productos['descripcion']?></strong></p>
<p>Precio: <strong><?=$productos['precio']?></strong></p>
<p>Categoría: <strong><?=$categoria['nombre']?></strong></p>
<img src="img/productos/<?=$productos['idproducto']?>.jpg" width="200" ><br/>

<a href="index.php?seccion=productos&accion=borrar&id=<?=$productos['idproducto']?>" class="btn btn-danger ">Borrar producto</a>
<a href="index.php?seccion=productos&accion=editar&id=<?=$productos['idproducto']?>" class="btn btn-info ">Editar producto</a>



