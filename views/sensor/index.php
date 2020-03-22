<?php declare(strict_types=1) ?>
<html>
    <head>
        <title>Wisim</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/sensor.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content">
            <div class="topnav">
                <div class="search-container">
                    <form action="<?php echo constant('URL') ?>sensor/consulta" method="post">
                        <input type="text" placeholder="Buscar sensor" name="nombre_sensor">
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
                <form action="<?php constant('URL') ?>sensor/nuevo" method="post">
                    <button type="submit" class="boton" style="margin-top: 5vh;">Nuevo ID_Sensor</button>
                </form>
            </div>
            <table id="customers">
                <tr>
                    <th>#</th>
                    <th>ID_Tipo_Sensor</th>
                    <th>Vigente</th>
                    <th></th>
                </tr>
                <?php
                foreach ($this->datos as $sensor) {
                    ?>
                    <tr>
                        <td><?php echo $sensor->id_sensor ?></td>
                        <td><?php echo $sensor->id_tipo_sensor ?></td>
                        <td><?php echo $sensor->vigencia === 'true'? 'SI':'NO' ?></td>
                        <td><form action="<?php echo constant('URL') ?>sensor/perfil" method="post">
                                <button id="consultarID" type="submit"> Consultar </button>
                                <input type="hidden" name="id_sensor" value="<?php echo $sensor->id_sensor ?>"/>
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
