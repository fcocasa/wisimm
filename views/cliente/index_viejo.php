<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Cliente</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/cliente.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form action="<?php constant('URL')?>cliente/consulta" method="post">
                <button class="boton" type="submit">
                    Consultar
                </button>
            </form>
            <form action="<?php constant('URL')?>cliente/nuevo" method="post">
                <button class="boton" type="submit">
                    Nuevo
                </button>
            </form>
            <form action="<?php constant('URL')?>cliente/modificar" method="post">
                <button class="boton" type="submit">
                    Modificar
                </button>
            </form>
            <form action="<?php constant('URL')?>cliente/borrar" method="post">
                <button class="boton" type="submit">
                    Borrar
                </button>
            </form>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>