<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Nuevo Cliente</title>
    </head>
    <body>
<!--        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nuevocliente.css" type="text/css">-->
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/cliente.css" type="text/css">

        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php constant('URL') ?>nuevo" method="post" >
                <h2>Nombre</h2><input type="text" class="title" name="nombre" required="true"/>
                <h2>Telefono</h2><input type="text" class="title" name="telefono"/>
                <h2>Correo</h2><input type="text" class="title" name="correo"/>
                <h2>Domicilio</h2> <input type="text" class="title" name="domicilio"/>
                <br>
                <button class="boton" type="submit" >Crear cliente</button>
            </form>
             <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>