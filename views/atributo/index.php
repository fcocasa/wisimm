<?php declare(strict_types=1) ?>
<html>
    <head>
        <title>Wisim</title>
    </head>
    <body>
        <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/atributo.css" type="text/css">
        <?php require 'views/header.php'; ?>
        <div class="content">
            <div class="topnav">
                <div class="search-container">
                    <form action="<?php echo constant('URL') ?>atributo/consulta" method="post">
                        <input type="text" placeholder="Buscar atributo" name="nombre_atributo">
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
                <form action="<?php constant('URL') ?>atributo/nuevo" method="post">
                    <button type="submit" class="boton" style="margin-top: 5vh;">Nuevo Atributo</button>
                </form>
            </div>
            <table id="customers">
                <tr>
                    <th>#</th>
                    <th>Atributo</th>
                    <th>Vigente</th>
                    <th></th>
                </tr>
                <?php
                foreach ($this->datos as $atributo) {
                    ?>
                    <tr>
                        <td><?php echo $atributo->id ?></td>
                        <td><?php echo $atributo->nombre ?></td>
                        <td><?php echo $atributo->vigencia === 'true'? 'SI':'NO' ?></td>
                        <td><form action="<?php echo constant('URL') ?>atributo/perfil" method="post">
                                <button id="consultarID" type="submit"> Consultar </button>
                                <input type="hidden" name="id" value="<?php echo $atributo->id ?>"/>
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
