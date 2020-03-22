<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Nuevo Atributo</title>
    </head>
    <body>
<!--        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nuevoatributo.css" type="text/css">-->
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/atributo.css" type="text/css">

        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>atributo/nuevo" method="post" >
                <h2>Atributo</h2><input type="text" class="title" name="nombre" required="true"/>

                <br>
                <button class="boton" type="submit" >Crear atributo</button>
            </form>
             <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>