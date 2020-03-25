<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Nuevo Tipo Sensor</title>
    </head>
    <body>
<!--        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nuevotipo_sensor.css" type="text/css">-->
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/tipo_sensor.css" type="text/css">

        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>tipo_sensor/nuevo" method="post" >
                <h2>Tipo Sensor</h2><input type="text" class="title" name="nombre" required="true"/><br>
                <h2>Version</h2><input type="text" class="title" name="version" required="true"/><br>
                <?php if (isset($this->attributes)) { ?>
                    <div style='display:inline-block;margin: 2vw;'>
                        <?php
                        foreach ($this->attributes as $key => $value) {
                            if ($value->vigencia === 'true') {
                                ?>
                                <input type="checkbox" name="attribute[]" value="<?php echo $value->id ?>"><?php echo $value->nombre ?></input>
                            <?php
                            }
                        }
                        ?></div><?php
                }
                ?>
                <br>
                <button class="boton" type="submit" >Crear Tipo de Sensor</button>
            </form>
            <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
        <?php } ?>
        </div>
<?php require 'views/footer.php'; ?>

    </body>
</html>