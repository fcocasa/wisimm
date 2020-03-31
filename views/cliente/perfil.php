<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Cliente</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/cliente.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>cliente/modificar" method="post">
                <h2>Nombre</h2><input class="title" name="nombre" value="<?php echo $this->cliente->nombre ?>"/>
                <h2>Telefono</h2><input class="title" name="telefono" value="<?php echo $this->cliente->telefono ?>"/>
                <h2>Correo</h2><input class="title" name="correo" value="<?php echo $this->cliente->correo ?>"/>
                <h2>Domicilio</h2><input class="title" name="domicilio" value="<?php echo $this->cliente->domicilio ?>"/>
                <input type="hidden" name="id" value="<?php echo $this->cliente->id ?>"/>
                
              <?php
                if (isset($this->compras)) {
                    ?><br><h2>Compras</h2><br><?php
                    foreach ($this->compras as $value) {
                        if ($value->vigencia === 'true') {
                            ?>
                            
                            <h3><?php echo $value->valor ?> <?php echo $value->fecha ?></h3> 
                            
                        <?php }
                    }
                }
                ?>
                <button style='display:inline-block;margin-right:2vw;'class="boton" type="submit" name='tipo' value='modificar' >Modificar</button>
                <button style="display:<?php echo $this->cliente->vigencia === 'true' ? 'inline-block':'none' ?>;" class="boton" type="submit"name='tipo' value='eliminar' >Eliminar</button>
                <button style="display:<?php echo $this->cliente->vigencia === 'false' ? 'inline-block':'none' ?>" class="boton" type="submit"name='tipo' value='recuperar' >Recuperar</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>