<fieldset>
            <legend>Información General</legend>
            <label for="titulo">Titulo:</label>
            <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

            <label for="precio">Precio: </label>
            <input name="propiedad[precio]" type="number" id="precio" placeholder="Precio" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen: </label>
            <input name="propiedad[imagen]" type="file" id="imagen">
            <?php if($propiedad->imagen) : ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="img-small" alt="">
            <?php endif; ?>

            <label for="descripcion">Descripción:</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

        </fieldset>


        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input name="propiedad[habitaciones]" type="number" min="1" max="10" step="1" id="habitaciones" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños:</label>
            <input name="propiedad[wc]" type="number" min="1" max="10" step="1" id="wc" value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input name="propiedad[estacionamiento]" type="number" min="1" max="10" step="1" id="estacionamiento" value="<?php echo s($propiedad->estacionamiento); ?>">

            <legend>Información Vendedor:</legend>
            <label for="nombre_vendedor">Nombre:</label>

            <!-- <select name="vendedorId" id="nombre_vendedor">
                <option selected value="">-- Seleccione --</option>
                <?php // while ($row = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php //echo $vendedor === $row['id'] ? 'selected' : '' ?> value="<?php //echo $row['id']; ?>"><?php //echo $row['nombre'] . " " . $row['apellido']; ?>
                    <?php //endwhile; ?>
            </select> -->
        </fieldset>