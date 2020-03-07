<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Cliente</title>
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                width: 50vw;
                margin: auto;
                margin-top: 10vh;
                text-align: center;
                font-family: arial;
                height: 45vh;
            }

            .title {
                color: grey;
                font-size: 18px;
                width: 40vw;
            }
        </style>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/cliente.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL')?>cliente/modificar" method="post">
                <h2>Nombre</h2><input class="title" name="nombre" value="<?php echo $this->cliente->nombre ?>"/>
                <h2>Telefono</h2><input class="title" name="telefono" value="<?php echo $this->cliente->telefono ?>"/>
                <h2>Correo</h2><input class="title" name="correo" value="<?php echo $this->cliente->correo ?>"/>
                <h2>Domicilio</h2><input class="title" name="domicilio" value="<?php echo $this->cliente->domicilio ?>"/>
                <input type="hidden" name="id" value="<?php echo $this->cliente->id ?>"/>
                <button class="boton" type="submit" >Modificar</button>
            </form>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>