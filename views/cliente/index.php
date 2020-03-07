<?php declare(strict_types=1) ?>
<html>
    <head>
        <title>Wisim</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/cliente.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content">
            <div class="topnav">
                <div class="search-container">
                    <form action="<?php echo constant('URL') ?>cliente/consulta" method="post">
                        <input type="text" placeholder="Buscar por nombre o correo" name="nombre_cliente">
                        <button type="submit">Buscar</button>
                    </form>
                </div>
                <form action="<?php constant('URL') ?>cliente/nuevo" method="post">
                    <button type="submit" class="boton" style="margin-top: 5vh;">Nuevo Cliente</button>
                </form>
            </div>
            <table id="customers">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th></th>
                </tr>
                <?php
                //if (!empty($this->datosClientes)) {
                foreach ($this->datos as $cliente) {
                    ?>
                    <tr>
                        <td><?php echo $cliente->id ?></td>
                        <td><?php echo $cliente->nombre ?></td>
                        <td><?php echo $cliente->telefono ?></td>
                        <td><?php echo $cliente->correo ?></td>
                        <td><form action="<?php echo constant('URL') ?>cliente/perfil" method="post">
                                <button id="consultarID" type="submit"> Consultar </button>
                                <input type="hidden" name="id" value="<?php echo $cliente->id ?>"/>
                            </form></td>
                    </tr>
                    <?php
                }
                //}
                ?>
            </table>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>
