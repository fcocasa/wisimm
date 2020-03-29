<?php declare(strict_types=0) ?>
<html>
    <head>
        <title>Wisim Nuevo ID_Sensor</title>
    </head>
    <body>
<!--        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nuevosensor.css" type="text/css">-->
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/sensor.css" type="text/css">

        <?php require 'views/header.php'; ?>
        <div class="content" style="text-align: center;">
            <form class="card" action="<?php echo constant('URL') ?>sensor/nuevo" method="post" >
                <h2>Sensor</h2><input type="text" class="title" name="nuevo_sensor" required="true"/>
                <h2>Tipo Sensor</h2><input type="text" class="title" name="Tipo_Sensor" required="true"/><br>

                <br>
                <button class="boton" type="submit" >Crear sensor</button>
            </form>
             <?php if (!($this->message === null)) { ?>
                <h3 style='font-style: italic; margin-top: 3vh'><?php echo $this->message ?></h3>
            <?php } ?>
        </div>
        <?php require 'views/footer.php'; ?>

    </body>
</html>