<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showVigs(Request $request){

        $ODBCdriver = $this->ODBCdriver;
        $ODBCuser = $this->ODBCuser;
        $ODBCpwd = $this->ODBCpwd;
    
        $query_sup =
        "SELECT 
        pers_codi as id, 
        pers_lega as legajo,
        pers_nomb as name,
        pers_domi as domicilio,
        pers_loca as localidad,
        provinci.prov_nomb as provincia,
        pers_copo as cp,
        zonas.zona_nomb as zona,    
        paises.pais_nomb as nacionalidad,
        pers_telc as phone_fijo,
        pers_movp as phone_movil,
        pers_ndoc as ndoc,
        pers_fnac as fecha_nac,
        pers_lugn as lugar_nac,
        pers_cuil as cuil,
        pers_fing as fecha_ingreso,
        pers_fegr as fecha_egreso,
        pers_frei as fecha_reincidencia,
        pers_fant as fecha_antecedentes,
        bancos.banc_nomb as banco,
        pers_cur as cur,
        pers_obra as obra_social,
        supervisor.supe_nomb as name_supe,
        empresas.empr_nomb as empresa,
        categori.cate_nomb as categoria
        FROM personal 
        INNER JOIN provinci ON provinci.prov_codi = personal.pers_prov
        INNER JOIN zonas ON zonas.zona_codi = personal.pers_zona
        INNER JOIN paises ON paises.pais_codi = personal.pers_naci
        INNER JOIN bancos ON bancos.banc_codi = personal.pers_banc
        INNER JOIN supervisor ON supervisor.supe_codi = personal.pers_supe
        INNER JOIN empresas ON empresas.empr_codi = personal.pers_empr
        INNER JOIN categori ON categori.cate_codi = personal.pers_cate";
    
        //CONEXION Y OBTENCION DE DATOS
        $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);    
        if(!$conID) { print("No se pudo establecer la conexión!");exit();}
        
        define ('sup', @odbc_exec($conID, $query_sup));
        if (sup === false) die("Error en query: " . odbc_errormsg($conID));      
    
        $pers_codi = 'pers_codi';
        $pers_lega = 'pers_lega';
        $pers_nomb = 'pers_nomb';
        $pers_domi = 'pers_domi';
        $pers_loca = 'pers_loca';
        $prov_nomb = 'prov_nomb';
        $pers_copo = 'pers_copo';
        $zona_nomb = 'zona_nomb';
        $pais_nomb = 'pais_nomb';
        $pers_telc = 'pers_telc';
        $pers_movp = 'pers_movp';
        $pers_ndoc = 'pers_ndoc';
        $pers_fnac = 'pers_fnac';
        $pers_lugn = 'pers_lugn';
        $pers_cuil = 'pers_cuil';
        $pers_fing = 'pers_fing';
        $pers_fegr = 'pers_fegr';        
        $pers_frei = 'pers_frei';
        $pers_fant = 'pers_fant';
        $banc_nomb = 'banc_nomb';
        $pers_cur = 'pers_cur';
        $pers_obra = 'pers_obra';
        $supe_nomb = 'supe_nomb';
        $empr_nomb = 'empr_nomb';
        $cate_nomb = 'cate_nomb';
    
        while($row = odbc_fetch_array(sup)) {
          $data[$row['id']] = array(
            $pers_codi => utf8_encode ($row['id']),
            $pers_lega => utf8_encode ($row['legajo']),
            $pers_nomb => utf8_encode ($row['name']),
            $pers_domi => utf8_encode ($row['domicilio']),
            $pers_loca => utf8_encode ($row['localidad']),
            $prov_nomb => utf8_encode ($row['provincia']),
            $pers_copo => utf8_encode ($row['cp']),
            $zona_nomb => utf8_encode ($row['zona']),
            $pais_nomb => utf8_encode ($row['nacionalidad']),
            $pers_telc => utf8_encode ($row['phone_fijo']),
            $pers_movp => utf8_encode ($row['phone_movil']),
            $pers_ndoc => utf8_encode ($row['ndoc']),
            $pers_fnac => utf8_encode ($row['fecha_nac']),
            $pers_lugn => utf8_encode ($row['lugar_nac']),
            $pers_cuil => utf8_encode ($row['cuil']),
            $pers_fing => utf8_encode ($row['fecha_ingreso']),
            $pers_fegr => utf8_encode ($row['fecha_egreso']),        
            $pers_frei => utf8_encode ($row['fecha_reincidencia']),
            $pers_fant => utf8_encode ($row['fecha_antecedentes']),
            $banc_nomb => utf8_encode ($row['banco']),
            $pers_cur => utf8_encode ($row['cur']),
            $pers_obra => utf8_encode ($row['obra_social']),
            $supe_nomb => utf8_encode ($row['name_supe']),
            $empr_nomb => utf8_encode ($row['empresa']),
            $cate_nomb => utf8_encode ($row['categoria'])
          ); 
          
        };
        return response()->json($data, 200);     
    
      }
}
