<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Nueva Compra</title>
    </head>
    <body>
<!--        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nuevocompra.css" type="text/css">-->
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/compra.css" type="text/css">

        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php  echo constant('URL') ?>compra/nuevo" method="post" >
                <h2>ID_Compra</h2><input type="text" class="title" name="id_compra" required="true"/>
                <h2>ID_Cliente</h2><input type="text" class="title" name="id_cliente" required="true"/>
                <h2>ID_Sensor</h2><input type="text" class="title" name="id_sensor"/>
                <h2>Fecha</h2><input type="text" class="title" name="fecha"/>
                <br>
                <button class="boton" type="submit" >Crear compra</button>
            </form>
             <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>