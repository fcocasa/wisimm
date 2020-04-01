<?php

class compra_model extends model {

    function __construct() {
        parent::__contruct();
        //echo 'cree model';
    }

    function getEveryCompra() {
        try {
            if (isset($_POST['buscar'])) {
                $sql = "SELECT*FROM compras";
            } else {
                $sql = "SELECT*FROM compras WHERE vigencia like 'true' ";
            }

            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentCompra = new objectCompra();
                $currentCompra->id_cliente = $row['ID_Cliente'];

                //----------------- conseguir nombre cliente
                $sql2 = "SELECT*FROM clientes WHERE ID_Cliente LIKE " . $row['ID_Cliente'];
                $row2 = $this->db->connect()->query($sql2)->fetch();
                $currentCompra->nombre_cliente = $row2['Nombre'];
                //------------------
                //------------------conseguir id del tipo sensor
                $sql3 = "SELECT*FROM sensores WHERE ID_Sensor LIKE " . $row['ID_Sensor'];
                $row3 = $this->db->connect()->query($sql3)->fetch();
                $id_tipo_sensor = $row3['ID_Tipo_Sensor'];
                //------------------
                //------------------consguir nombre tipo sensor
                $sql4 = "SELECT*FROM tipo_sensores WHERE ID_Tipo_Sensor LIKE " . $id_tipo_sensor;
                $row4 = $this->db->connect()->query($sql4)->fetch();
                $currentCompra->nombre_tipo_sensor = $row4['Tipo_Sensor'];
                //------------------
                //echo $row['Nombre'];
                $currentCompra->id_compra = $row['ID_Compra'];
                $currentCompra->fecha = $row['Fecha'];
                $currentCompra->id_sensor = $row['ID_Sensor'];
                $currentCompra->vigencia = $row['vigencia'];
                array_push($items, $currentCompra);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getCompra($compra) {
        try {
            $sql = "SELECT * FROM `compras` WHERE ID_Compra LIKE '%" . $compra . "%' OR ID_Cliente LIKE '%" . $compra . "%' OR ID_Sensor LIKE '%" . $compra . "%' and vigencia like 'true'";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $items = [];
            while ($row = $result->fetch()) {
                $currentCompra = new objectCompra();
                $currentCompra->id_cliente = $row['ID_Cliente'];

                //----------------- conseguir nombre cliente
                $sql2 = "SELECT*FROM clientes WHERE ID_Cliente LIKE " . $row['ID_Cliente'];
                $row2 = $this->db->connect()->query($sql2)->fetch();
                $currentCompra->nombre_cliente = $row2['Nombre'];
                //------------------
                //------------------conseguir id del tipo sensor
                $sql3 = "SELECT*FROM sensores WHERE ID_Sensor LIKE " . $row['ID_Sensor'];
                $row3 = $this->db->connect()->query($sql3)->fetch();
                $id_tipo_sensor = $row3['ID_Tipo_Sensor'];
                //------------------
                //------------------consguir nombre tipo sensor
                $sql4 = "SELECT*FROM tipo_sensores WHERE ID_Tipo_Sensor LIKE " . $id_tipo_sensor;
                $row4 = $this->db->connect()->query($sql4)->fetch();
                $currentCompra->nombre_tipo_sensor = $row4['Tipo_Sensor'];
                //------------------
                //echo $row['Nombre'];
                $currentCompra->id_compra = $row['ID_Compra'];
                $currentCompra->fecha = $row['Fecha'];
                $currentCompra->id_sensor = $row['ID_Sensor'];
                $currentCompra->vigencia = $row['vigencia'];
                array_push($items, $currentCompra);
            } return $items;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function getCompraID($compraID) {
        try {
            $int = (int) $compraID;
            $sql = "SELECT * FROM `compras` WHERE ID_Compra LIKE " . $int . "";
            $result = $this->db->connect()->query($sql);
            //$query = $this->db->connect()->query(); //no reconoce prepare esto       
            //$query->execute(['nombre'=> $datos['Nombre'], 'telefono'=> $datos['Telefono'], 'domicilio'=> $datos['Domicilio'],'correo'=> $datos['Correo']]);
            $row = $result->fetch();
            $currentCompra = new objectCompra();
            $currentCompra->id_cliente = $row['ID_Cliente'];
            
            //----------------- conseguir nombre cliente
            $sql2 = "SELECT*FROM clientes WHERE ID_Cliente LIKE " . $row['ID_Cliente'];
            $row2 = $this->db->connect()->query($sql2)->fetch();
            $currentCompra->nombre_cliente = $row2['Nombre'];
            //------------------
            
            //------------------conseguir id del tipo sensor
            $sql3 = "SELECT*FROM sensores WHERE ID_Sensor LIKE " . $row['ID_Sensor'];
            $row3 = $this->db->connect()->query($sql3)->fetch();
            $id_tipo_sensor = $row3['ID_Tipo_Sensor'];
            //------------------
            
            //------------------consguir nombre tipo sensor
            $sql4 = "SELECT*FROM tipo_sensores WHERE ID_Tipo_Sensor LIKE " . $id_tipo_sensor;
            $row4 = $this->db->connect()->query($sql4)->fetch();
            $currentCompra->nombre_tipo_sensor = $row4['Tipo_Sensor'];
            //------------------
            
            //echo $row['Nombre'];
            $currentCompra->id_compra = $row['ID_Compra'];
            $currentCompra->fecha = $row['Fecha'];
            $currentCompra->id_sensor = $row['ID_Sensor'];
            $currentCompra->vigencia = $row['vigencia'];
            return $currentCompra;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return [];
        }
    }

    function modify($compra) {
        $sql = "UPDATE compras SET ID_Cliente = '" . $compra['id_cliente'] . "', Fecha = '" . $compra['fecha'] . "' WHERE ID_Compra LIKE " . (int) $compra['id_compra'];
        $this->db->connect()->query($sql);
        return $this->getCompraID($compra['id_compra']);
    }

    function new($compra) {
        try {
            $sql = "INSERT INTO `compras`(`ID_Cliente`,`ID_Compra`, `ID_Sensor`, `Fecha`, `vigencia`) VALUES ('" . $compra['id_cliente'] . "','" . $compra['id_compra'] . "','" . $compra['id_sensor'] . "','" . $compra['fecha'] . "','true')";
            //echo $sql;
            $this->db->connect()->query($sql);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo $e->getMessage();
            return false;
        }
    }

    function delete($compraID) {
        try {
            $sql = "UPDATE compras SET vigencia = 'false' WHERE ID_Compra LIKE " . (int) $compraID;
            $this->db->connect()->query($sql);
            return 'Compra borrado con exito';
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function restore($compraID) {
        try {
            $sql = "UPDATE compras SET vigencia = 'true' WHERE ID_Compra LIKE " . (int) $compraID;
            $this->db->connect()->query($sql);
            return $this->getCompraID($compraID);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return new objectCompra();
        }
    }

    function getCompraFromCliente($idCliente) {
        $sql = "SELECT * FROM `compras` WHERE `ID_Cliente` LIKE " . $idCliente;
        $idsComp = $this->db->connect()->query($sql);
        $items = [];
        //print_r($idsComp);
        while ($row = $idsComp->fetch()) {
            $item = $this->getCompraID($row['ID_Compra']);
            $item->valor = $row['ID_Sensor'];
            array_push($items, $item);
        }
        //print_r($items);
        return $items;
    }

    function modifyValueCompra($clienteID, $valoresID, $valores) {
        foreach ($valoresID as $key => $value) {
            $sql = "UPDATE compras SET ID_Sensor = '" . $valores[$key] . "' WHERE ID_Compra LIKE " . $value . " and ID_Cliente LIKE " . $clienteID . "";
            $this->db->connect()->query($sql);
        }
    }

}
