<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Atributo</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/atributo.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>atributo/modificar" method="post">
                <h2>Atributo</h2><input class="title" name="nombre" value="<?php echo $this->atributo->nombre ?>"/>
                <input type="hidden" name="id" value="<?php echo $this->atributo->id ?>"/>
                <button style='display:inline-block;margin-right:2vw;'class="boton" type="submit" name='tipo' value='modificar' >Modificar</button>
                <button style="display:<?php echo $this->atributo->vigencia === 'true' ? 'inline-block':'none' ?>;" class="boton" type="submit"name='tipo' value='eliminar' >Eliminar</button>
                <button style="display:<?php echo $this->atributo->vigencia === 'false' ? 'inline-block':'none' ?>" class="boton" type="submit"name='tipo' value='recuperar' >Recuperar</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>