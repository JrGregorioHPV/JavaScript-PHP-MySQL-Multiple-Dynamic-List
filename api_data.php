<?php
    $host = 'localhost';
    $usuario = 'root';
    $password = '';
    $bd = 'provincia_bd';

    $conexion = mysqli_connect($host, $usuario, $password, $bd);
    mysqli_set_charset($conexion, "utf8");
    $GLOBALS['con'] = $conexion;

    // Provincia
    function getProvincias ($id = NULL) {
        if($id == NULL){
            $query = mysqli_query($GLOBALS['con'], "SELECT * FROM provincia");
            $all_data = array();

            while($row = mysqli_fetch_assoc($query)){
                array_push($all_data, $row);
            }
            return $all_data;
        } else {
                $query = mysqli_query($GLOBALS['con'], "SELECT * FROM provincia WHERE id='".$id."'");
                $all_data = array();

                while($row = mysqli_fetch_assoc($query)){
                    array_push($all_data, $row);
                }
                
                return $all_data;
        }
    }

    // Distrito
    function getDistritos ($id_provincia = NULL) {
        if($id_provincia == NULL){
            $query = mysqli_query($GLOBALS['con'], "SELECT * FROM distrito");
            $all_data = array();

            while($row = mysqli_fetch_assoc($query)){
                array_push($all_data, $row);
            }
           // print_r($all_data);
            return $all_data;
        } else {
                $query = mysqli_query($GLOBALS['con'], "SELECT * FROM distrito WHERE id_provincia='".$id_provincia."'");
                $all_data = array();

                while($row = mysqli_fetch_assoc($query)){
                    array_push($all_data, $row);
                }
                return $all_data;
        }
    }

    // Corregimiento
    function getCorregimientos ($id_distrito = NULL) {
        if($id_distrito == NULL){
            $query = mysqli_query($GLOBALS['con'], "SELECT * FROM corregimiento");
            $all_data = array();

            while($row = mysqli_fetch_assoc($query)){
                array_push($all_data, $row);
            }
            return $all_data;
        } else {
                $query = mysqli_query($GLOBALS['con'], "SELECT * FROM corregimiento WHERE id_distrito='".$id_distrito."'");
                $all_data = array();

                while($row = mysqli_fetch_assoc($query)){
                    array_push($all_data, $row);
                }
                return $all_data;
        }
    }

    if(isset($_REQUEST['type'])){
        if($_REQUEST['type'] == 'distrito'){
            echo json_encode(getDistritos($_REQUEST['id_provincia']));
        }
        else if($_REQUEST['type'] == 'corregimiento'){
            echo json_encode(getCorregimientos($_REQUEST['id_distrito']));
        }
    } else {
        echo json_encode(getProvincias()); // JSON_UNESCAPED_UNICODE
    }
