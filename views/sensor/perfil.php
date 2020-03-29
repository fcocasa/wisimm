<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Sensor</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/sensor.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>sensor/modificar" method="post">
                <h2>Sensor</h2><input class="title" name="id_sensor" value="<?php echo $this->sensor->id_sensor ?>"/>
                <h2>ID Tipo Sensor</h2><input class="title" name="id_tipo_sensor" value="<?php echo $this->sensor->id_tipo_sensor ?>"/>
                
                <input type="hidden" name="id" value="<?php echo $this->tipoSensor->id_tipo_sensor ?>"/>
                <?php
                if (isset($this->nombreTipoSensor)) {
                    ?><br><h2>Tipo Sensor</h2><br><?php
                    foreach ($this->nombreTipoSensor as $value) {
                       // if ($value->vigencia === 'true') {
                            ?>
                            <input type='hidden' name="tiposensorID[]" value="<?php echo $value->id_tipo_sensor ?>"/>
                            <h2><?php echo $value->nombre_tipo_sensor ?></h2><input class="title" name="tiposensor[]" value="<?php echo $value->tipo_sensor ?>"/>
                        <?php }
                   // }
                }
                ?>
                
                <button style='display:inline-block;margin-right:2vw;'class="boton" type="submit" name='tipo' value='modificar' >Modificar</button>
                <button style="display:<?php echo $this->sensor->vigencia === 'true' ? 'inline-block':'none' ?>;" class="boton" type="submit"name='tipo' value='eliminar' >Eliminar</button>
                <button style="display:<?php echo $this->sensor->vigencia === 'false' ? 'inline-block':'none' ?>" class="boton" type="submit"name='tipo' value='recuperar' >Recuperar</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>