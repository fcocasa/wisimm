<?php declare(strict_types=1) ?>
<html>
    <head>
        <title>Wisim</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/compra.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content">
            <div class="topnav">
                <div class="search-container">
                    <form action="<?php echo constant('URL') ?>compra/consulta" method="post">
                        <input type="text" placeholder="Buscar por comprador o compraID" name="nombre_compra">
                        <button type="submit">Buscar</button>
                        <br><br>
                        <label for="buscar" style='font-style: italic'>Incluir no vigentes</label>
                        <label class="myCheckbox">
                            <input type="checkbox" name="buscar" value='todos' />
                            <span></span>
                        </label>
<!--                        <input style='display: inline-block;margin-right:2vw'type='checkbox' name='buscar' value='todos'><h3 style='display: inline-block'>Incluir no vigentes</h3>-->
                    </form>
                </div>
                <form action="<?php constant('URL') ?>compra/nuevo" method="post">
                    <button type="submit" class="boton" style="margin-top: 5vh;">Nueva Compra</button>
                </form>
            </div>
            <table id="customers">
                <tr>
                    <th>#</th>
                    <th>ID_Cliente</th>
                    <th>ID_Sensor</th>
                    <th>Fecha</th>
                    <th>Vigente</th>
                    <th></th>
                </tr>
                <?php
                //if (!empty($this->datosVompras)) {
                foreach ($this->datos as $compra) {
                    ?>
                    <tr>
                        <td><?php echo $compra->id_compra ?></td>
                        <td><?php echo $compra->id_cliente ?></td>
                        <td><?php echo $compra->id_sensor ?></td>
                        <td><?php echo $compra->fecha ?></td>
                        <td><?php echo $compra->vigencia === 'true'? 'SI':'NO' ?></td>
                        <td><form action="<?php echo constant('URL') ?>compra/perfil" method="post">
                                <button id="consultarID" type="submit"> Consultar </button>
                                <input type="hidden" name="id_compra" value="<?php echo $compra->id_compra ?>"/>
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
