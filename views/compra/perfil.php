<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Compra</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/compra.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>compra/modificar" method="post">
                <h2>ID_Compra</h2><input class="title" name="id_compra" value="<?php echo $this->compra->id_compra ?>"/>
                <h2>ID_Cliente</h2><input class="title" name="id_cliente" value="<?php echo $this->compra->id_cliente ?>"/>
                <h2>ID_Sensor</h2><input class="title" name="id_sensor" value="<?php echo $this->compra->id_sensor ?>"/>
                <h2>Fecha</h2><input class="title" name="fecha" value="<?php echo $this->compra->fecha ?>"/>
                <input type="hidden" name="id_compra" value="<?php echo $this->compra->id_compra ?>"/>
                <button style='display:inline-block;margin-right:2vw;'class="boton" type="submit" name='tipo' value='modificar' >Modificar</button>
                <button style="display:<?php echo $this->compra->vigencia === 'true' ? 'inline-block':'none' ?>;" class="boton" type="submit"name='tipo' value='eliminar' >Eliminar</button>
                <button style="display:<?php echo $this->compra->vigencia === 'false' ? 'inline-block':'none' ?>" class="boton" type="submit"name='tipo' value='recuperar' >Recuperar</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>