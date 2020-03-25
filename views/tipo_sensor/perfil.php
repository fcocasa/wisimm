<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Tipo de Sensor</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/tipo_sensor.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>tipo_sensor/modificar" method="post">
                <h2>Tipo Sensor</h2><input class="title" name="nombre" value="<?php echo $this->tipoSensor->nombre ?>"/>
                <h2>Version</h2><input class="title" name="version" value="<?php echo $this->tipoSensor->version ?>"/>
                <input type="hidden" name="id" value="<?php echo $this->tipoSensor->id_tipo_sensor ?>"/>
                <?php
                if (isset($this->attributes)) {
                    ?><br><h3>Atributos</h3><br><?php
                    foreach ($this->attributes as $value) {
                        if ($value->vigencia === 'true') {
                            ?>
                            <input type='hidden' name="valoresID[]" value="<?php echo $value->id ?>"/>
                            <h2><?php echo $value->nombre ?></h2><input class="title" name="valores[]" value="<?php echo $value->valor ?>"/>
                        <?php }
                    }
                }
                ?>
                <button style='display:inline-block;margin-right:2vw;'class="boton" type="submit" name='tipo' value='modificar' >Modificar</button>
                <button style="display:<?php echo $this->tipoSensor->vigencia === 'true' ? 'inline-block' : 'none' ?>;" class="boton" type="submit"name='tipo' value='eliminar' >Eliminar</button>
                <button style="display:<?php echo $this->tipoSensor->vigencia === 'false' ? 'inline-block' : 'none' ?>" class="boton" type="submit"name='tipo' value='recuperar' >Recuperar</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
        <?php } ?>
        </div>
<?php require 'views/footer.php'; ?>

    </body>
</html>