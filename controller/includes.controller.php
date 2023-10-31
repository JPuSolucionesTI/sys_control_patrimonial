<?php 

include_once 'model/conexion.php';
class IncludesController
{
    private $bd; 

    
      public function redirect($url)
  {
    header("Location: $url");
  }   

 /*--------- -------CONSULTAS A LA BD------------------------------------------------------------ */
public function Consultas($sql)
    {

         $this->bd = new Conexion();
        try
        { 
            ini_set('memory_limit', '-1'); 

            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

public function ConsultasScoreTelefonia($sql)
    {

         $this->bd = new ConexionScoreTelefonia();
        try
        { 
            ini_set('memory_limit', '-1'); 

            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

public function ConsultasbdLectura($sql)
    {

         $this->bd = new ConexionbdLectura();
        try
        { 
            ini_set('memory_limit', '-1'); 

            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }



    public function ConsultasBDReniec($sql)
    {

         $this->bd = new ConexionReniec();
        try
        { 
            ini_set('memory_limit', -1); 
            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ConsultasBDSearch($sql)
    {

         $this->bd = new ConexionSearch();
        try
        { 
            ini_set('memory_limit', -1); 
            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ConsultasBDBusquedas($sql)
    {

         $this->bd = new ConexionBusquedas();
        try
        { 
            ini_set('memory_limit', -1); 
            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    } 

  
  public function consultar_row($sql)
    {

        try
        {
             ini_set('memory_limit', -1); 
            $this->bd = new Conexion();

            $stm = $this->bd->prepare($sql);
            $stm->execute();                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function consultar_row_bdLectura($sql)
    {

        try
        {
             ini_set('memory_limit', -1); 
            $this->bd = new ConexionbdLectura();

            $stm = $this->bd->prepare($sql);
            $stm->execute();                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }


     public function validarPermiso ($idPerfil = 0,$idVista=0){

      try
        {
             ini_set('memory_limit', -1); 
        $this->pdo = new Conexion();
            $result = array();

            $stm = $this->pdo->prepare("SELECT acceder     FROM Permiso
                WHERE Vista_id = $idVista
                AND Perfil_id=$idPerfil");
            $stm->execute();
                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }

  }
/******************************/
    public function Consultar_Resultado($idResultado)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM resultado where idResultado=:idResultado;");
        $stmt->bindParam(':idResultado',$idResultado);
        $stmt->execute();     
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
/*--------------------Actualizar_Filtro_Tiene_Telefono*/
 public function  Actualizar_Filtro_tiene_telefono(){
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE  obligacion INNER JOIN campana ON campana.idcampana=obligacion.campana_id
SET obligacion.tiene_telefono=0 WHERE campana.activo=1 AND campana.eliminado=0;


UPDATE  obligacion INNER JOIN campana ON campana.idcampana=obligacion.campana_id
SET obligacion.tiene_telefono=1 WHERE campana.activo=1 AND campana.eliminado=0  AND tiene_telefono=0 AND deudor_id in(
SELECT deudor_id FROM telefono WHERE activo=1 AND MEJOR_GES_ID=0 AND eliminado=0);");
        
          $stmt->execute();
          $reg_actualizados=$stmt->rowCount();
          return $reg_actualizados;
    }



/*--------------------Actualizar_Filtro_TipoMonto*/
public function Actualizar_Filtro_TipoMonto($idCampana,$nro_percentil){

  //1. Consultar el monto total adeudado por deudor y ordenado de menor a mayor en una campaña
  $query_deudores=$this->Consultas("SELECT
  DEUDOR_ID,
  sum(MONTO_ASIGNADO) AS MONTO_ESTUDIO,
  max(obligacion.DIAS_MORA) as DIAS_MORA
  from obligacion
  inner join deudor on deudor.idDeudor=obligacion.Deudor_id
  where obligacion.eliminado=0 and obligacion.activo=1 and campana_id=$idCampana group by DEUDOR_ID order by MONTO_ESTUDIO ;
  ");

  //2. obtengo el nro total de deudores
  $nro_deudores=count($query_deudores);

  //3. verificar si el nro total de deudores es par o impar
  if ($nro_deudores%2==0)
  {
      $nro_deudores;
      $par=1;
  }else
  {
      $nro_deudores=$nro_deudores+1;
      $par=2;
  }

  //obtener el porcentaje que va a tener cada percentil
  $porcentaje=(100/$nro_percentil)/100;

  $percentil=0;
  $posicion_per=0;
  $array_percentil= array();

  for ($i=$nro_percentil; $i>=1; $i--) {
      $array_percentil[$i]['ranking']=$i;
      $percentil=$percentil+$porcentaje;
      $array_percentil[$i]['percentil']=$percentil;
      $posicion_per=round(($nro_deudores*$percentil),0);
      $array_percentil[$i]['posicion']=$posicion_per;
      if($i==1 && $par==2){
          $array_percentil[$i]['monto']=$query_deudores[$posicion_per-$par]['MONTO_ESTUDIO'];
          $array_percentil[$i]['posicion']=$posicion_per-1;
      }else{
          $array_percentil[$i]['monto']=$query_deudores[$posicion_per-1]['MONTO_ESTUDIO'];
          $array_percentil[$i]['posicion']=$posicion_per;
      }   
  }


  $array_Deudores= array();
  $posicion=1;
  foreach ($query_deudores as $obligacion)
  {
      $array_Deudores[$obligacion['DEUDOR_ID']]['POSICION']=$posicion;   
      $array_Deudores[$obligacion['DEUDOR_ID']]['DEUDOR_ID']=$obligacion['DEUDOR_ID'];
      $array_Deudores[$obligacion['DEUDOR_ID']]['MONTO_ESTUDIO']=$obligacion['MONTO_ESTUDIO'];
      $array_Deudores[$obligacion['DEUDOR_ID']]['DIAS_MORA']=$obligacion['DIAS_MORA'];
      $n1=-1;
      foreach ($array_percentil as $percentil)
      {
          if($posicion>=$n1 && $posicion<$percentil['posicion'])
          {
              $array_Deudores[$obligacion['DEUDOR_ID']]['TIPO_MONTO']=$percentil['ranking'];
              break;
          }else
          {
              $array_Deudores[$obligacion['DEUDOR_ID']]['TIPO_MONTO']=1;
          }
          $n1=$percentil['posicion'];
      }
      $posicion++;
  }

  $reg_actualizados=0;
  $this->bd = new Conexion();
  foreach ($array_percentil as $percentil)
  {
    $percentiles=array_filter($array_Deudores, array(new FiltrarArreglos($percentil['ranking']), 'filtrar_por_TipoMonto'));
    $Deudores=implode(",",array_column($percentiles,'DEUDOR_ID'));
    $ranking=$percentil['ranking'];
    $stmt = $this->bd->prepare("UPDATE obligacion SET tipo_monto=$ranking WHERE campana_id=$idCampana and deudor_id in($Deudores);");
    $stmt->execute();
    $reg_actualizados= $reg_actualizados+$stmt->rowCount();    
  }

  return $reg_actualizados;
}


//*************ORDENAR ARRAY****************/
function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
    $position = array();
    $newRow = array();
    foreach ($toOrderArray as $key => $row) {
            $position[$key]  = $row[$field];
            $newRow[$key] = $row;
    }
    if ($inverse) {
        arsort($position);
    }
    else {
        asort($position);
    }
    $returnArray = array();
    foreach ($position as $key => $pos) {     
        $returnArray[] = $newRow[$key];
    }
    return $returnArray;
}

/*******FORMATOS DE NUMEROS**********/
       public  function toMoneys($val,$moneda='',$r=1)
{

    if($moneda=='D'){
      $symbol='$ ';
    }elseif($moneda=='S'){
      $symbol='S/. ';
    }else{
      $symbol='';
    }
    $n = $val; 
    $c = is_float($n) ? 1 : number_format($n,$r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n=number_format(abs($n),$r); 
    $j = (($j = strlen($i)) > 3) ? $j % 3 : 0; 

   return  $symbol.$sign .($j ? substr($i,0, $j) + $t : ' ').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;

}

public function toMoney($val, $moneda = '', $r = 1)
{   
    if ($val === NULL) {
        $val = 0;
    }
    if ($moneda == 'D') {
        $symbol = '$';
    } elseif ($moneda == 'S') {
        $symbol = 'S/.';
    } else {
        $symbol = '';
    }

    // Ajusta la cantidad de decimales según el valor de $val
    $r = (is_float($val) && floor($val) != $val) ? 1 : 0;

    // Formatea el número con comas como separador de miles
    $formattedValue = number_format($val, $r, '.', ',');

    if ($val == 0) {
        return $symbol . '0.0';
    } else {
        return $symbol . $formattedValue;
    }
}


public function bussiness_days($day_start,$day_end,$Weekend,$DayNonWorking){


  $numberdayswork=0;
  $day_start=$day_start;
  $day_end=$day_end;

$ArrayDayNonWorking= explode(",",$DayNonWorking);

  //Mientras Fecha Inicial sea menor igual Fecha Final 
  while(strtotime($day_start) <= strtotime($day_end)){

    //Obtener Representación numérica del día de la semana
    $day_week = date('N', strtotime($day_start));
    //Si el dia de la semana es diferente a domingo incrementar contar dias laborables
    if ($day_week != 7) { 
      if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
         $numberdayswork++; 
      }
    };

    $day_start=date("Y-m-d  ", strtotime($day_start . " + 1 day"));


}

return $numberdayswork;
}

/*********** INICIO: FUNCIONES ESTADISTICAS *************/

function median($arr){
    if($arr){
        $count = count($arr);
        sort($arr);
        $mid = floor(($count-1)/2);
        return ($arr[$mid]+$arr[$mid+1-$count%2])/2;
    }
    return 0;
}

function mypercentile($data,$percentile){
    if( 0 < $percentile && $percentile < 1 ) {
        $p = $percentile;
    }else if( 1 < $percentile && $percentile <= 100 ) {
        $p = $percentile * .01;
    }else {
        return "";
    }
    $count = count($data);
    $allindex = ($count-1)*$p;
    $intvalindex = intval($allindex);
    $floatval = $allindex - $intvalindex;
    sort($data);
    if(!is_float($floatval)){
        $result = $data[$intvalindex];
    }else {
        if($count > $intvalindex+1)
            $result = $floatval*($data[$intvalindex+1] - $data[$intvalindex]) + $data[$intvalindex];
        else
            $result = $data[$intvalindex];
    }
    return $result;
}

/*********** FIN: FUNCIONES ESTADISTICAS *************/

public  function toSymbolMoney($moneda=''){
  if($moneda=='D'){
     return $symbol='$ ';
    }elseif($moneda=='S'){
      return $symbol='S/. ';
    }else{
      return $symbol='';
    }
}

public  function toPercent($val){

  $valor=round($val,4)*100;
  return  $valor.' <b>%</b>';

}

public  function to_no_Percent($val){
  $valor=round($val,4)*100;
  return  $valor;
}

public  function noPercent($val){
  $valor=round($val,4)*100;
  return  $valor;
}

function super_unique($array,$key){

  //Crear una Arreglo Temporal
  $temp_array = array();
  foreach ($array as &$v) {
    if (!isset($temp_array[$v[$key]])){
    $temp_array[$v[$key]] =& $v;
    }
  }
  $array = array_values($temp_array);
  return $array;
}


public function Semaforo($porcentaje)
{
$porcentaje=$this->noPercent($porcentaje);
   if ($porcentaje>=100) {
       return  '<ul class="semaforo verde"><li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></li></ul>';
   }elseif ($porcentaje>=70) {
       return  '<ul class="semaforo ambar"><li><i class="fa fa-hand-o-right" aria-hidden="true"></i></li></ul>';
   }else{
       return  '<ul class="semaforo rojo"><li><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></li></ul>';
   }
}

public function SemaforoIndPromesas($porcentaje)
{
$porcentaje=$this->noPercent($porcentaje);
   if ($porcentaje>=100) {
       return  '<i class="fa fa-check-circle verde fa-2x " style="color:green;"></i>';
   }elseif ($porcentaje>=70) {
       return  '<i class="fa fa-exclamation-circle fa-2x" ambar fa-2x style="color:#f39c12;"></i>';
   }else{
       return  '<i class="fa fa-times-circle rojo fa-2x" style="color:red;"></i>';
   }
}

public function SemaforoIndLlamValidas($porcentaje)
{
$porcentaje=$this->noPercent($porcentaje);
   if ($porcentaje>=100) {
       return  '<i class="fa fa-check-circle verde fa-2x " style="color:green;"></i>';
   }elseif ($porcentaje>=70) {
       return  '<i class="fa fa-exclamation-circle ambar fa-2x"  style="color:#f39c12;"></i>';
   }else{
       return  '<i class="fa fa-times-circle rojo fa-2x" style="color:red;"></i>';
   }
}

public function SemaforoEstadoGestionAsesor($EstadoGestion,$TipoDescanso)
{

   if ($EstadoGestion==1) {
       return  '<span class="label label-success" style="font-size:10px;">Gestionando</span>';
   }elseif ($EstadoGestion==2) {
      if ($TipoDescanso==1) {
       return  '<span class="label label-warning" style="font-size:10px;">Descanso - Break</span>';
      }elseif ($TipoDescanso==2) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - Refrigerio</span>';
      }elseif ($TipoDescanso==3) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - SSHH</span>';
      }elseif ($TipoDescanso==4) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - Reunion</span>';
      }elseif ($TipoDescanso==5) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - Soporte</span>';
      }elseif ($TipoDescanso==6) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - Capacitación</span>';
      }elseif ($TipoDescanso==7) {
        return  '<span class="label label-warning" style="font-size:10px;">Descanso - Reforzamiento</span>';
      }else {
        return  '<span class="label label-warning" style="font-size:10px;"></span>';
      }       
   }elseif ($EstadoGestion==0) {
      return  '<span class="label label-danger" style="font-size:10px;">Finalizo Gestión</span>';
   }else{
       return  '<span class="label label-default" style="font-size:10px;">Sin Iniciar</span>';
   }
}

public function SemaforoEfectividadEjecutivo($porcentaje)
{

   if ($porcentaje>=70) {
       return  '#2e8a1e';
   }elseif ($porcentaje>=50) {
       return  '#e29212';
   }else{
       return  '#b11b23';
   }
}

public function SemaforoEfectividadCampana($porcentaje)
{

   if ($porcentaje>=90) {
       return  '#2e8a1e';
   }elseif ($porcentaje>=70) {
       return  '#e29212';
   }else{
       return  '#b11b23';
   }
}
/*--------------Funciones avance de y resultados de segmentacion------------*/
public function SemaforoBarraCobertura($porcentaje_barra,$porcentaje_indicador)
{

   if ($porcentaje_indicador>=100) {
       return  '<i class="fa fa-circle rojo fa-1x" style="color:green;"></i>  '.$porcentaje_barra.'%  <progress style="vertical-align: middle;width: 60px;" id="file" max="100" value="'.$porcentaje_barra.'"></progress>';

   }elseif ($porcentaje_indicador>=80) {
        return  '<i class="fa fa-circle rojo fa-1x" style="color:#fd9c0a;"></i>  '.$porcentaje_barra.'%  <progress style="vertical-align: middle;width: 60px;" id="file" max="100" value="'.$porcentaje_barra.'"></progress>';
   }elseif ($porcentaje_indicador>=60) {
        return  '<i class="fa fa-circle rojo fa-1x" style="color:red;"></i>  '.$porcentaje_barra.'%  <progress style="vertical-align: middle;width: 60px;" id="file" max="100" value="'.$porcentaje_barra.'"></progress>';
   }else{
       return  '<i class="fa fa-circle rojo fa-1x" style="color:black;"></i>  '.$porcentaje_barra.'%  <progress style="vertical-align: middle;width: 60px;" id="file" max="100" value="'.$porcentaje_barra.'"></progress>';
   }
}

public function SemaforoDireccionalIndicador($Metrica,$MetricavsIndicador)
{

   if ($MetricavsIndicador>=100) {
       return  '<i class="fa fa-arrow-up rojo fa-1x" style="color:green;"></i> '.$Metrica.'%';

   }elseif ($MetricavsIndicador>=80) {
        return  '<i class="fa fa-arrow-up rojo fa-1x fa-rotate-45" style="color:#fd9c0a;"></i> '.$Metrica.'%';
   }elseif ($MetricavsIndicador>=60) {
        return  '<i class="fa fa-arrow-right rojo fa-1x fa-rotate-45" style="color:#fd9c0a;"></i> '.$Metrica.'%';
   }else{
        return  '<i class="fa fa-arrow-down rojo fa-1x" style="color:red;"></i> '.$Metrica.'%';
   }
}

public function BarraHorizontalMetrica($porcentaje_barra,$colorbar)
{

   
       //return  $porcentaje_barra.'%  <progress class="bg-success" style="vertical-align: middle;width: 60px;" id="file" max="100" value="'.$porcentaje_barra.'"</progress>';
    return '<div class="progress"><div class="progress-bar " role="progressbar" style="text-align:left;padding-left:0.5em;color:black;background-color:'.$colorbar.';width: '.$porcentaje_barra.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$porcentaje_barra.'%</div></div>';

}

public function IndicadorCoberturaEsperada1($dia_actual)
{
    if($dia_actual<=6){
        $Cobertura_Diaria=round(((0.3*($dia_actual))/6)*100);
    }elseif($dia_actual<=12){
        $Cobertura_Diaria=round((0.3+(((0.5-0.3)*($dia_actual-6))/6))*100);
    }elseif($dia_actual<=17){
        $Cobertura_Diaria=round((0.5+(((0.7-0.5)*($dia_actual-12))/5))*100);
    }elseif($dia_actual<=19){
        $Cobertura_Diaria=round((0.7+(((0.8-0.7)*($dia_actual-17))/2))*100);
    }elseif($dia_actual<=20){
        $Cobertura_Diaria=round((0.8+(((0.9-0.8)*($dia_actual-19))/1))*100);
    }elseif($dia_actual<=23){
        $Cobertura_Diaria=round((0.9+(((1-0.9)*($dia_actual-20))/3))*100);
    }else{
        $Cobertura_Diaria=1;
    }
    return $Cobertura_Diaria;
}

public function IndicadorCoberturaEsperada($day_start,$day_end,$DayNonWorking)
{  
    $nroDias=0;
    $DiaCompleto=0;
    $DiaParcial=0;
    $day_start_res=$day_start;
    //$day_start=$Resumen_Campana['Fecha_inicio_cobertura'];
    //$day_end=$Resumen_Campana['Fecha_fin_cobertura'];
    //$DayNonWorking='2021-12-08,2021-12-25';
    $ArrayDayNonWorking= explode(",",$DayNonWorking);
    /*if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
           $numberdayswork++; 
        }*/
    //2021-12-01

    while(strtotime($day_start) <= strtotime($day_end)){

      //echo $i.'<br>';
      $day_week = date('N', strtotime($day_start));
      
      //$calendar[ $i][$day_week] = $i;
      $calendar[$day_start]['DiaSemana']=  $day_week;
      $calendar[$day_start]['Dia']=  $day_start;
      $calendar[$day_start]['NomDia']=  date("l", strtotime($day_start));
      //$calendar_day[$day_start]['Dia']=date('Y-m-d', strtotime($day_start));
      if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
         
          if ($day_week < 6) { 
          $calendar[$day_start]['Tipo']= 'Completo';
          $DiaCompleto++;
          }elseif($day_week == 6){
            $calendar[$day_start]['Tipo']= 'Parcial';
            $DiaParcial++; 
          }else{
            $calendar[$day_start]['Tipo']= 'No Laborable';
          }
      }else{
        $calendar[$day_start]['Tipo']= 'No Laborable';
      }
      //'2021-12-01' + 1 dia
      $day_start=date("Y-m-d", strtotime($day_start . " + 1 day"));
      //2021-12-02
    }//endwhile;*/</pre>

      $y=(1/(($DiaCompleto*$DiaParcial)+3));
      $x=3*$y;

    foreach ($calendar as $key) {
      if ($key['Tipo']=='Completo') {
        $calendar[ $key['Dia']]['FactorCobertura']=$x;
      } else if($key['Tipo']=='Parcial'){
        $calendar[ $key['Dia']]['FactorCobertura']=$y;
      }else{
        $calendar[ $key['Dia']]['FactorCobertura']=0;
      }
    }

    $day_start=$day_start_res;
    $day_actual=date('Y-m-d');
    if(strtotime($day_actual)>strtotime($day_end)){
      $day_actual=$day_end;
    }
    $CoberturaEsperado=0;
     while(strtotime($day_start) <= strtotime($day_actual)){
        if (isset($calendar[$day_start]['Dia'])) {
          $CoberturaEsperado=$CoberturaEsperado+$calendar[$day_start]['FactorCobertura'];
        } 
        $day_start=date("Y-m-d", strtotime($day_start . " + 1 day"));
        //2021-12-02
    }
    return round($CoberturaEsperado*100);
}

public function IndicadorCoberturaEsperadaxdia($Fecha,$day_start,$day_end,$DayNonWorking)
{  
    $nroDias=0;
    $DiaCompleto=0;
    $DiaParcial=0;
    $day_start_res=$day_start;
    //$day_start=$Resumen_Campana['Fecha_inicio_cobertura'];
    //$day_end=$Resumen_Campana['Fecha_fin_cobertura'];
    //$DayNonWorking='2021-12-08,2021-12-25';
    $ArrayDayNonWorking= explode(",",$DayNonWorking);
    /*if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
           $numberdayswork++; 
        }*/
    //2021-12-01

    while(strtotime($day_start) <= strtotime($day_end)){

      //echo $i.'<br>';
      $day_week = date('N', strtotime($day_start));
      
      //$calendar[ $i][$day_week] = $i;
      $calendar[$day_start]['DiaSemana']=  $day_week;
      $calendar[$day_start]['Dia']=  $day_start;
      $calendar[$day_start]['NomDia']=  date("l", strtotime($day_start));
      //$calendar_day[$day_start]['Dia']=date('Y-m-d', strtotime($day_start));
      if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
         
          if ($day_week < 6) { 
          $calendar[$day_start]['Tipo']= 'Completo';
          $DiaCompleto++;
          }elseif($day_week == 6){
            $calendar[$day_start]['Tipo']= 'Parcial';
            $DiaParcial++; 
          }else{
            $calendar[$day_start]['Tipo']= 'No Laborable';
          }
      }else{
        $calendar[$day_start]['Tipo']= 'No Laborable';
      }
      //'2021-12-01' + 1 dia
      $day_start=date("Y-m-d", strtotime($day_start . " + 1 day"));
      //2021-12-02
    }//endwhile;*/</pre>

      $y=(1/(($DiaCompleto*$DiaParcial)+3));
      $x=3*$y;

    foreach ($calendar as $key) {
      if ($key['Tipo']=='Completo') {
        $calendar[ $key['Dia']]['FactorCobertura']=$x;
      } else if($key['Tipo']=='Parcial'){
        $calendar[ $key['Dia']]['FactorCobertura']=$y;
      }else{
        $calendar[ $key['Dia']]['FactorCobertura']=0;
      }
    }

    $day_start=$day_start_res;
    $Fechaxdia=date('Y-m-d',strtotime($Fecha));
    $day_actual=$Fechaxdia;
    if(strtotime($day_actual)>strtotime($day_end)){
      $day_actual=$day_end;
    }
    $CoberturaEsperado=0;
     while(strtotime($day_start) <= strtotime($day_actual)){
        if (isset($calendar[$day_start]['Dia'])) {
          $CoberturaEsperado=$CoberturaEsperado+$calendar[$day_start]['FactorCobertura'];
        } 
        $day_start=date("Y-m-d", strtotime($day_start . " + 1 day"));
        //2021-12-02
    }
    return round($CoberturaEsperado*100);
}

/*--------------Funcion para Porcentajes Ideales----------------------------------*/
public function PrincipalesKPixTipoCliente($Fecha,$idCartera)
{
    $FechaSeisMesesAnteriores=date("Y-m-d", strtotime($Fecha . " - 6 month"));
    $Query=$this->ConsultasbdLectura("
    SELECT Campana_id,periodo,TipoInicioGestion,'Contactabilidad'  as 'Indicador',NClientes_Gestionados as 'Poblacion',NClientes_Contactados as  'Target' from kpiproduccion WHERE activo=1 and Cartera_id=$idCartera and periodo>='".$FechaSeisMesesAnteriores."' and periodo<='".$Fecha."'
    UNION
    SELECT Campana_id,periodo,TipoInicioGestion,'Probabilidad'  as 'Indicador',NClientes_Contactados  as 'Poblacion',NClientes_CPP as  'Target' from kpiproduccion WHERE activo=1 and Cartera_id=$idCartera and periodo>='".$FechaSeisMesesAnteriores."' and periodo<='".$Fecha."'
    UNION
    SELECT Campana_id,periodo,TipoInicioGestion,'Conversion'  as 'Indicador',NClientes_CPP  as 'Poblacion',NClientes_CP as  'Target' from kpiproduccion WHERE activo=1 and Cartera_id=$idCartera and periodo>='".$FechaSeisMesesAnteriores."' and periodo<='".$Fecha."'
    UNION
    SELECT Campana_id,periodo,TipoInicioGestion,'Cumplimiento'  as 'Indicador',NClientes_CP  as 'Poblacion',NClientes_Pagos as  'Target' from kpiproduccion WHERE activo=1 and Cartera_id=$idCartera and periodo>='".$FechaSeisMesesAnteriores."' and periodo<='".$Fecha."'
    order by periodo asc
    ; ");


    $array_dataIndicador= array();

    $min_periodo=min(array_column($Query,'periodo'));
    $max_periodo=min(array_column($Query,'periodo'));

    foreach ($Query as $Row){

        $array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['Poblacion']=$Row['Poblacion'];
        $array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['Target']=$Row['Target'];
        $N_GEST=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['Poblacion'];
        $N_CD=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['Target'];

        if ($min_periodo==$Row['periodo']) {
            $AlfaPriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['AlfaPriori']=1;
            $BetaPriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['BetaPriori']=1;

            $AlfaPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['AlfaPosteriori']=$N_CD+$AlfaPriori;
            $BetaPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['BetaPosteriori']=$N_GEST-$N_CD+$BetaPriori;
            $IndicadorReal=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['IndicadorReal']=$N_CD/$N_GEST;
            $IndicadorPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['IndicadorPosteriori']=0.5;
        }else{

            $periodo_anterior=date("Y-m-d", strtotime($Row['periodo'] . " - 1 month"));
            $AlfaPosteriori_periodo_anterior=$array_dataIndicador[$periodo_anterior][$Row['TipoInicioGestion']][$Row['Indicador']]['AlfaPosteriori'];
            $BetaPosteriori_periodo_anterior=$array_dataIndicador[$periodo_anterior][$Row['TipoInicioGestion']][$Row['Indicador']]['BetaPosteriori'];
            $AlfaPriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['AlfaPriori']=$AlfaPosteriori_periodo_anterior;
            $BetaPriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['BetaPriori']=$BetaPosteriori_periodo_anterior;

            $AlfaPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['AlfaPosteriori']=$N_CD+$AlfaPriori;
            $BetaPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['BetaPosteriori']=$N_GEST-$N_CD+$BetaPriori;
            
            if($N_CD==0 || $N_GEST==0){
                $IndicadorReal=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['IndicadorReal']=0;
            }else{
                $IndicadorReal=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['IndicadorReal']=$N_CD/$N_GEST;
            }
            $IndicadorPosteriori=$array_dataIndicador[$Row['periodo']][$Row['TipoInicioGestion']][$Row['Indicador']]['IndicadorPosteriori']=($AlfaPosteriori_periodo_anterior-1)/($AlfaPosteriori_periodo_anterior+$BetaPosteriori_periodo_anterior-2);
            
        } 
    }
    return $array_dataIndicador;
}

/*--------------Funcion Actualizar Negociaciones Caidos de forma automatica------------*/
public function EstadoPromesaxCuota($Estado)
{
       $this->bd = new Conexion();  
       $Nrooperacion=$_REQUEST['NroOperacion'];
     $infoCampana=$this->consultar_row("SELECT fecha_compromiso FROM compromiso
inner join negociacion on negociacion.idNegociacion=compromiso.Negociacion_id 
 WHERE estado_compromiso=2 and negociacion.Nrooperacion=$Nrooperacion;");

     $Negociacion_id=$this->consultar_row("SELECT idNegociacion FROM negociacion
 WHERE  Nrooperacion=$Nrooperacion;");



      if ($Estado==1) {
        return  'CUMPLIDO';
      }elseif ($Estado==2) {
            if($infoCampana['fecha_compromiso']<date("Y-m-d")){
               $this->bd = new Conexion();  
                $stmt = $this->bd->prepare("UPDATE compromiso SET estado_compromiso=3 where idCompromiso=62319;");
                $stmt->execute(); 
                if ($stmt->execute()) {
                  return  'CAIDO';
                }else{
                    return  'VIGENTE';
                }   

           }else{
            return  'VIGENTE';
           }
 
      }elseif ($Estado==3) {
        return  'CAIDO';
      }else {
        return  'ANULADO';
      } 
}

public function NombreTipoInicioGestionAbrev($TipoIniGest)
{

        if($TipoIniGest==0){
           return  'Cob.';
        }if($TipoIniGest==1){
          return  'Seg.';
        }if($TipoIniGest==2){
          return  'Conv.';
        }else{
          return  '';
        }

}

public function TipoFacilidadNegociacion($tipo)
{

      if ($tipo==1) {
        return  'Cancelación';
      }elseif ($tipo==2) {
        return  'Enganche';
      }elseif ($tipo==3) {
        return  'Fraccionamiento';
      }elseif ($tipo==4) {
        return  'Cuota Balon';
      }else {
        return  '-';
      } 
}

public function TipoMontoaCobrarNegociacion($tipo)
{

      if ($tipo==1) {
        return  'Deuda Total';
      }elseif ($tipo==2) {
        return  'Descuento Intereses';
      }elseif ($tipo==3) {
        return  'Capital';
      }elseif ($tipo==4) {
        return  'Descuento Capital';
      }else {
        return  '-';
      } 
}

public function TipoNegociacion($tipo)
{

      if ($tipo==1) {
        return  'Dentro de Políticas';
      }elseif ($tipo==2) {
        return  'Fuera de Políticas';
      }else {
        return  '-';
      } 
}

public function txt_EstadoAprobacionNegociacion($Estado)
{


      if ($Estado==1) {
        return  'Aprobado';
      }elseif ($Estado==2) {
        return  'Pendiente de Aprobacion';
      }elseif ($Estado==3) {
        return  'Rechazado';
      }else {
        return  'Sin Iniciar';
      } 
}


public function EstadoNegociacion($Estado)
{
      if ($Estado==0) {
        return  '<span class="label label-default" style="font-size:10px;">Sin Iniciar</span>';
      }elseif ($Estado==1) {
        return  '<span class="label label-primary" style="font-size:10px;">Cumplido</span>';
      }elseif ($Estado==2) {
        return  '<span class="label label-success" style="font-size:10px;">Vigente</span>';
      }elseif ($Estado==3) {
        return  '<span class="label label-warning" style="font-size:10px;">Caido</span>';
      }elseif ($Estado==4) {
        return  '<span class="label label-danger" style="font-size:10px;">Anulado</span>';
      }elseif ($Estado==5) {
        return  '<span class="label label-danger" style="font-size:10px;">Anulado - Nueva Negociacion</span>';
      }else {
        return  '<span class="label label-default" style="font-size:10px;">-</span>';
      } 
}

public function txtTipoInicioGestionCliente($Estado)
{


      if ($Estado==0) {
       return  'Ilocalizado';
      }elseif ($Estado==1) {
        return  'Seguimiento';
      }elseif ($Estado==2) {
        return  'Probabilidad de Pago';
      }elseif ($Estado==3) {
        return  'Convenio';
      }else {
        return  '-';
      } 
}

//($Estado,$Complejidad,$FechaInicio,$Fecha_Fin,$Hora)

public function EstadoActividad($Estado,$Complejidad,$FechaInicio,$Fecha_Fin,$Hora)
{     


    if ($Estado==0) {
      date_default_timezone_set("America/Lima");
      $FechaActual= new DateTime(date("d-m-Y"));
      $FechaInicio= new DateTime($FechaInicio);
      $Fecha_Fin= new DateTime($Fecha_Fin);

      if ($FechaActual<$FechaInicio) {
        return  0;
      }else{

        if ($Complejidad==1) {
          if($FechaActual<=$Fecha_Fin){
            return  1;
          }else if($FechaActual>$Fecha_Fin){
            return  3;
          }

        }else if ($Complejidad==2 || $Complejidad==3){
          if($FechaActual>=$FechaInicio && $FechaActual<=$Fecha_Fin){
            return  2;
          }else if($FechaActual>$Fecha_Fin){
            return  3;
          }
        }
      }       
    }else if ($Estado==4) {
        return  4;
    }else if ($Estado==5) {
        return  5;
    }
}

public function IconoEstadoActividad($Estado)
{     
    if($Estado==0){
       return  '<a href="#"  class="btn btn-default btn-xs ">Generado</a>';
    }if($Estado==1){
        return  '<a href="#"  class="btn btn-warning btn-xs ">Pendiente</a>';
    }if($Estado==2){
        return  '<a href="#"  class="btn btn-primary btn-xs ">En proceso</a>';
    }if($Estado==3){
        return  '<a href="#"  class="btn btn-danger btn-xs ">Retrasado</a>';
    }if($Estado==4){
        return  '<a href="#"  class="btn btn-success btn-xs ">Realizado</a>';
    }if($Estado==5){
        return  '<a href="#"  class="btn btn-default btn-xs ">Cancelado</a>';
    }

    if ($Estado==0) {
      date_default_timezone_set("America/Lima");
      $FechaActual= new DateTime(date("d-m-Y"));
      $FechaInicio= new DateTime($FechaInicio);
      $Fecha_Fin= new DateTime($Fecha_Fin);

      if ($FechaActual<$FechaInicio) {
        return  '<a href="#"  class="btn btn-default btn-xs ">Generado</a>';
      }else{

        if ($Complejidad==1) {
          if($FechaActual<=$Fecha_Fin){
            return  '<a href="#"  class="btn btn-warning btn-xs ">Pendiente</a>';
          }else if($FechaActual>$Fecha_Fin){
            return  '<a href="#"  class="btn btn-danger btn-xs ">Retrazado</a>';
          }

        }else if ($Complejidad==2 || $Complejidad==3){
          if($FechaActual>=$FechaInicio && $FechaActual<=$Fecha_Fin){
            return  '<a href="#"  class="btn btn-primary btn-xs ">En proceso</a>';
          }else if($FechaActual>$Fecha_Fin){
            return  '<a href="#"  class="btn btn-danger btn-xs ">Retrazado</a>';
          }
        }
      }       
    }else if ($Estado==4) {
        return  '<a href="#"  class="btn btn-success btn-xs ">Realizado</a>';
    }else if ($Estado==5) {
        return  '<a href="#"  class="btn btn-default btn-xs ">Cancelado</a>';
    }
}

public function ComplejidadActividad($Tiempo)
{
  if ($Tiempo==1) {
   return  'Corto';
  }elseif ($Tiempo==2) {
    return  'Mediano';
  }elseif ($Tiempo==3) {
    return  'Largo';
  }else {
    return  '-';
  } 
}

public function PrioridadActividad($Tiempo)
{
  if ($Tiempo==1) {
   return  'Baja';
  }elseif ($Tiempo==2) {
    return  'Media';
  }elseif ($Tiempo==3) {
    return  'Alta';
  }else {
    return  '-';
  } 
}

public function Icon_PrioridadActividad($Prioridad)
{
  if ($Prioridad==1) {
   return  'Baja';
  }elseif ($Prioridad==2) {
    return  'Media';
  }elseif ($Prioridad==3) {
    return  'Alta';
  }else {
    return  '-';
  } 
}

public function TipoProcesoActividad($Tipo)
{
  if ($Tipo==1) {
   return  'Estratégico';
  }elseif ($Tipo==2) {
    return  'Producción';
  }elseif ($Tipo==3) {
    return  'Soporte';
  }elseif ($Tipo==4) {
    return  'Proyectos';
  }else {
    return  '-';
  } 
}


public function txtEstadoNegociacion($Estado)
{


      if ($Estado==0) {
       return  'Sin Iniciar';
      }elseif ($Estado==1) {
        return  'Cumplido';
      }elseif ($Estado==2) {
        return  'Vigente';
      }elseif ($Estado==3) {
        return  'Caido';
      }elseif ($Estado==4) {
        return  'Anulado';
      }else {
        return  '-';
      } 
}

public function EstadoAprobacionNegociacion($Estado)
{


      if ($Estado==0) {
       return  '<span class="label label-default" style="font-size:10px;">Sin Iniciar</span>';
      }elseif ($Estado==1) {
        return  '<span class="label label-success" style="font-size:10px;">Aprobado</span>';
      }elseif ($Estado==2) {
        return  '<span class="label label-warning" style="font-size:10px;">Pendiente de Aprobacion</span>';
      }elseif ($Estado==3) {
        return  '<span class="label label-danger" style="font-size:10px;">Rechazado</span>';
      }else {
        return  '<span class="label label-default" style="font-size:10px;">Sin Iniciar</span>';
      } 
}

public function estado_compromiso($estado){

              /*
                0 -> Sin Compromiso
                1 -> Vigente
                2 -> Cumplidos
                3 -> Caidos
                
              */
              if ($estado==0) {
                echo  'SIN COMPROMISO';
              }elseif ($estado==1) {
                echo  'VIGENTE';
              }elseif ($estado==2) {
                echo  'CUMPLIDO';
              }elseif ($estado==3) {
                echo  'CAIDO';
              }else{
                echo  '';
              }
            }
  public function ColorContactabilidad($estado){

              if ($estado=='CONTACTO DIRECTO') {
                echo  'success';
              }elseif ($estado=='CONTACTO INDIRECTO') {
                echo  'warning';
              }elseif ($estado=='POR DETERMINAR') {
                echo  'default';
              }elseif ($estado=='SIN CONTACTO') {
                echo  'danger';
              }else{
                echo  '';
              }
            } 

            public function ColorEstadoAsistencia($Gestionando,$Descanso){

              if ($Gestionando==NULL) {
                echo  'bg-red';
              }elseif ($Gestionando==1 && $Descanso==NULL) {
                echo  'bg-green';
              }elseif ($Gestionando==1 && $Descanso==2) {
                echo  'bg-yellow';
              }else{
                echo  '';
              }
            }


            public function ajax_estado_compromiso($estado,$fecha_compromiso){

               if ($estado==0) {
                return  'SIN COMPROMISO';
              }elseif ($estado==1) {
                return  'CUMPLIDO';
              }elseif ($estado==2) {
                if($fecha_compromiso>=date ('Y-m-d')){
                  return  'VIGENTE';
                }else{
                  return  'CAIDO';
                }
              }elseif ($estado==3) {
                if($fecha_compromiso<date ('Y-m-d')){
                  return  'CAIDO';
                }else{
                  return  'VIGENTE';
                }
              }else{
                return  '';
              }
            }


public function estado_activo($estado){

  /*
    0 -> inactivo
    1 -> activo                
  */
  if ($estado==0) {
    echo  'INACTIVO';
  }elseif ($estado==1) {
    echo  'ACTIVO';
  }
}
    
/***********************/
public function sumar_array_key_value($array_query, $clave, $valor) { 
  ini_set('memory_limit', -1); 
 ini_set('max_execution_time', -1);
  //declaramos el nuevo arreglo
  $nuevo = array();
  //recorremos el array_query para guardar las claves en un nuevo array
  foreach ($array_query as $item) {
    $array_clave[] = $item[$clave];
  }

  //eliminamos las claves duplicadas
  $array_clave_unico = array_unique($array_clave);
  //recorremos el array sin duplicados
  foreach ($array_clave_unico as $array_unico) {
    $suma =0;
    foreach ($array_query as $item_query) {
      if ($array_unico == $item_query[$clave]) {
        $suma = $suma + $item_query[$valor];
      }
    }
    $nuevo[$array_unico][$clave]=$array_unico;
    $nuevo[$array_unico]['TOTAL']=$suma;
    

    $suma = 0;
  }
  return $nuevo;
}


/************************/               
public function GenerarDistribucionxVariable($DataObligaciones,$index,$porcentaje,$orden='NroDeudores'){
                        $ListaObligaciones=$this->super_unique($DataObligaciones,'OPERACION');
                        $ListaObligacionesCuotas=$this->super_unique($DataObligaciones,'NROOPERACION');
                            //Declaramos el array que va a contener el avance final por variable
                        $tablaAvanceVariable = array(); 
                        //porcentaje meta segun campaña
                        $porcentaje_meta=$porcentaje;
                        $index_variable=$index;
                        $nomFiltro=strtolower($index_variable);
                        $array_variable=$this->super_unique($DataObligaciones,$index_variable);
                        $TotalMontoAsignado = array_sum(array_column($ListaObligacionesCuotas,'MONTO_ASIGNADO')); 
                        //Recorremos el arreglo con las variables unicas
                        foreach ($array_variable as $item){ 
                       
                        $ObligacionesCuotasxVariables=array_filter($ListaObligacionesCuotas, array(new FilterArray($item[$index_variable],$index), 'filter_by_index'));                          
                        $Deudores=$this->super_unique($ObligacionesCuotasxVariables,'DEUDOR_ID');
                        $Obligaciones=$this->super_unique($ObligacionesCuotasxVariables,'NROOPERACION');   
                         $variable=$item[$index_variable]; 
                            $monto_asignado = array_sum(array_column($ObligacionesCuotasxVariables,'MONTO_ASIGNADO')); 
                           $monto_pago = array_sum(array_column($ObligacionesCuotasxVariables,'MONTO_PAGO'));                      
                              
                            $tablaAvanceVariable[$variable]['Variable']=$item[$index_variable];
                            $tablaAvanceVariable[$variable]['NroDeudores']=count($Deudores);
                            $tablaAvanceVariable[$variable]['NroObligaciones']=count($Obligaciones);                              
                            $tablaAvanceVariable[$variable]['TotalAsignado']=$monto_asignado;                            
                       }//endforeach; 
                    //$tablaImpactoVariable=$this->orderMultiDimensionalArray($tablaAvanceVariable,"Efectividad", $inverse = true);
                    $tablaImpactoVariable=$this->orderMultiDimensionalArray($tablaAvanceVariable,$orden, $inverse = true);
                    //echo '<pre>';
                    //print_r($ListaObligaciones);
                    //echo '</pre>';
                          return $tablaImpactoVariable;
                        }
                        


public function GenerarAvancexVariable($DataObligaciones,$index,$porcentaje,$orden='Efectividad'){
                        $ListaObligaciones=$this->super_unique($DataObligaciones,'OPERACION');
                        $ListaObligacionesCuotas=$this->super_unique($DataObligaciones,'NROOPERACION');
                            //Declaramos el array que va a contener el avance final por variable
                        $tablaAvanceVariable = array(); 
                        //porcentaje meta segun campaña
                        $porcentaje_meta=$porcentaje;
                        $index_variable=$index;
                        $nomFiltro=strtolower($index_variable);
                        $array_variable=$this->super_unique($DataObligaciones,$index_variable);
                        $TotalMontoAsignado = array_sum(array_column($ListaObligacionesCuotas,'MONTO_ASIGNADO')); 
                        //Recorremos el arreglo con las variables unicas
                        foreach ($array_variable as $item){ 
                       
                        $ObligacionesCuotasxVariables=array_filter($ListaObligacionesCuotas, array(new FiltrarArreglos($item[$index_variable]), $nomFiltro));                          
                        $Deudores=$this->super_unique($ObligacionesCuotasxVariables,'DEUDOR_ID');
                        $Obligaciones=$this->super_unique($ObligacionesCuotasxVariables,'OPERACION');   
                         $variable=$item[$index_variable]; 
                            $monto_asignado = array_sum(array_column($ObligacionesCuotasxVariables,'MONTO_ASIGNADO')); 
                           $monto_pago = array_sum(array_column($ObligacionesCuotasxVariables,'MONTO_PAGO'));                      
                              
                            $tablaAvanceVariable[$variable]['Variable']=$item[$index_variable];
                            $tablaAvanceVariable[$variable]['NroDeudores']=count($Deudores);
                            $tablaAvanceVariable[$variable]['NroObligaciones']=count($Obligaciones);                              
                            $tablaAvanceVariable[$variable]['TotalAsignado']=$monto_asignado;
                            $tablaAvanceVariable[$variable]['TotalMeta']=$monto_asignado*$porcentaje_meta;
                                $monto_meta=$monto_asignado*$porcentaje_meta;
                              if ($monto_meta<>0) {
                                $tablaAvanceVariable[$variable]['Efectividad']= $monto_pago/$monto_meta;
                              }else{
                                $tablaAvanceVariable[$variable]['Efectividad']=0;
                              }
                              if ($TotalMontoAsignado<>0) {
                               $tablaAvanceVariable[$variable]['impacto']=$monto_asignado/$TotalMontoAsignado;
                              }else{
                                $tablaAvanceVariable[$variable]['impacto']=0;
                              }


                         
                           $tablaAvanceVariable[$variable]['TotalRecupero']=$monto_pago;
                           $tablaAvanceVariable[$variable]['Restante']=$monto_meta-$monto_pago; 
                       }//endforeach; 
                    //$tablaImpactoVariable=$this->orderMultiDimensionalArray($tablaAvanceVariable,"Efectividad", $inverse = true);
                    $tablaImpactoVariable=$this->orderMultiDimensionalArray($tablaAvanceVariable,$orden, $inverse = true);
                    //echo '<pre>';
                    //print_r($ListaObligaciones);
                    //echo '</pre>';
                          return $tablaImpactoVariable;
                        }
  
/************************/               

public function CodigoTelefoniaxPais(){


return $arrayCodigoPais = [
7=>"Abjasia",
93=>"Afganistán",
355=>"Albania",
49=>"Alemania",
376=>"Andorra",
244=>"Angola",
1264=>"Anguilla",
1268=>"Antigua y Barbuda",
599=>"Antillas Holandesas",
966=>"Arabia Saudita",
213=>"Argelia",
54=>"Argentina",
374=>"Armenia",
297=>"Aruba",
61=>"Australia",
43=>"Austria",
994=>"Azerbaiyán",
1242=>"Bahamas",
973=>"Bahrein",
880=>"Bangladesh",
1246=>"Barbados",
32=>"Bélgica",
501=>"Belice",
229=>"Benin",
1441=>"Bermudas",
375=>"Bielorrusia",
591=>"Bolivia",
599=>"Bonaire",
387=>"Bosnia-Herzegovina",
267=>"Botswana",
55=>"Brasil",
673=>"Brunei Darussalam",
359=>"Bulgaria",
226=>"Burkina Faso",
257=>"Burundi",
975=>"Bután",
238=>"Cabo Verde",
855=>"Camboya",
237=>"Camerún",
1=>"Canadá",
235=>"Chad",
56=>"Chile",
86=>"China",
357=>"Chipre",
57=>"Colombia",
269=>"Comores",
242=>"Congo",
243=>"Congo RD",
850=>"Corea del Norte",
82=>"Corea del Sur",
225=>"Costa de Marfil",
506=>"Costa Rica",
385=>"Croacia",
53=>"Cuba",
599=>"Curacao",
45=>"Dinamarca",
1767=>"Dominica",
1=>"Dominicana, República",
593=>"Ecuador",
20=>"Egipto",
503=>"El Salvador",
971=>"Emiratos Árabes Unidos",
291=>"Eritrea",
421=>"Eslovaquia",
386=>"Eslovenia",
34=>"España",
1=>"Estados Unidos",
372=>"Estonia",
251=>"Etiopía",
679=>"Fiji",
63=>"Filipinas",
358=>"Finlandia",
33=>"Francia",
241=>"Gabón",
220=>"Gambia",
995=>"Georgia",
233=>"Ghana",
350=>"Gibraltar",
1473=>"Granada",
30=>"Grecia",
299=>"Groenlandia",
590=>"Guadalupe",
1671=>"Guam",
502=>"Guatemala",
594=>"Guayana francés",
44=>"Guernsey",
245=>"Guinea Bissau",
240=>"Guinea Ecuatorial",
592=>"Guyana",
509=>"Haiti",
504=>"Honduras",
852=>"Hong Kong",
36=>"Hungría",
91=>"India",
62=>"Indonesia",
98=>"Iran",
964=>"Iraq",
353=>"Irlanda",
247=>"Isla Ascensión",
358=>"Isla de Åland",
44=>"Isla de Man",
61=>"Isla De Navidad, Isla Christmas",
672=>"Isla Norfolk",
699=>"Isla periféricas menores de Estados Unidos",
354=>"Islandia",
1345=>"Islas Caimán",
61=>"Islas Cocos",
682=>"Islas Cook",
298=>"Islas Feroe",
500=>"Islas Malvinas",
692=>"Islas Marshall",
872=>"Islas Pitcairn",
677=>"Islas Salomón",
1649=>"Islas Turcas y Caicos",
128=>"Islas Vírgenes Británicas",
134=>"Islas Vírgenes de EE.UU.",
972=>"Israel",
39=>"Italia",
187=>"Jamaica",
81=>"Japón",
44=>"Jersey",
962=>"Jordania",
7=>"Kazajstán",
254=>"Kenia",
996=>"Kirguistán",
686=>"Kiribati",
377=>"Kosovo",
965=>"Kuwait",
856=>"Laos",
266=>"Lesotho",
371=>"Letonia",
961=>"Líbano",
231=>"Liberia",
218=>"Libia",
423=>"Liechtenstein",
370=>"Lituania",
352=>"Luxemburgo",
853=>"Macao",
389=>"Macedonia",
261=>"Madagascar",
60=>"Malasia",
265=>"Malawi",
960=>"Maldivas",
223=>"Malí",
356=>"Malta",
1670=>"Marianas del Norte",
212=>"Marruecos",
596=>"Martinica",
230=>"Mauricio",
222=>"Mauritania",
262=>"Mayotte",
52=>"México",
691=>"Micronesia",
373=>"Moldavia",
377=>"Mónaco",
976=>"Mongolia",
382=>"Montenegro",
1664=>"Montserrat",
258=>"Mozambique",
95=>"Myanmar",
264=>"Namibia",
674=>"Nauru",
977=>"Nepal",
505=>"Nicaragua",
227=>"Níger",
234=>"Nigeria",
683=>"Niue",
47=>"Noruega",
687=>"Nueva Caledonia",
64=>"Nueva Zelanda",
968=>"Omán",
31=>"Países Bajos, Holanda",
92=>"Pakistán",
680=>"Palau",
970=>"Palestina",
507=>"Panamá",
675=>"Papúa-Nueva Guinea",
595=>"Paraguay",
51=>"Perú",
689=>"Polinesia Francesa",
48=>"Polonia",
351=>"Portugal",
1=>"Puerto Rico",
974=>"Qatar",
44=>"Reino Unido",
236=>"República Centroafricana",
420=>"República Checa",
224=>"República Guinea",
262=>"Reunión",
250=>"Ruanda",
40=>"Rumanía",
7=>"Rusia",
212=>"Sáhara Occidental",
685=>"Samoa",
1684=>"Samoa Americana",
1869=>"San Cristóbal y Nevis",
378=>"San Marino",
590=>"San Martin",
508=>"San Pedro y Miquelón",
1784=>"San Vincente y Granadinas",
290=>"Santa Helena",
1758=>"Santa Lucía",
239=>"Santo Tomé y Príncipe",
221=>"Senegal",
381=>"Serbia",
248=>"Seychelles",
232=>"Sierra Leona",
65=>"Singapur",
963=>"Siria",
252=>"Somalía",
252=>"Somalilandia",
94=>"Sri Lanka",
27=>"Sudáfrica",
249=>"Sudán",
211=>"Sudán del Sur",
46=>"Suecia",
41=>"Suiza",
597=>"Surinam",
47=>"Svalbard y Jan Mayen",
268=>"Swazilandia",
992=>"Tadjikistan",
66=>"Tailandia",
886=>"Taiwán",
255=>"Tanzania",
246=>"Territorio Británico del Océano Índico.",
262=>"Territorios Franceses del Sur",
670=>"Timor del Este",
228=>"Togo",
690=>"Tokelau",
676=>"Tonga",
1868=>"Trinidad y Tobago",
216=>"Túnez",
993=>"Turkmenistán",
90=>"Turquía",
688=>"Tuvalu",
380=>"Ucrania",
256=>"Uganda",
598=>"Uruguay",
998=>"Uzbekistán",
678=>"Vanuatu",
379=>"Vaticano",
58=>"Venezuela",
84=>"Vietnam",
681=>"Wallis y Futuna",
967=>"Yemen",
253=>"Yibuti",
260=>"Zambia",
263=>"Zimbábue"];

}

                        



 }   


 ?>


 <?php 
class FiltrarArreglos {
        private $num;

        function __construct($num) {
                $this->num = $num;
        }
/* FILTROS POR GESTION*/
        function filtrar_por_Usuario($i) {
               return $i['IDUSUARIO'] == $this->num;
        }


        function filtrar_por_EstadoContactabilidad($i) {
               return $i['IDCONTACTABILIDAD'] == $this->num;
        }

        function filtrar_por_MejorResultadoGestion($i) {
               return $i['MEJOR_RESULTADO_ID'] == $this->num;
        }

        function filtrar_por_Fecha($i) {
               return $i['FECHA_VISITA'] == $this->num;
        }

        function filtrar_por_Campana($i) {
               return $i['IDCAMPANA'] == $this->num;
        }

        function filtrar_por_Codigo($i) {
               return $i['CODIGO'] == $this->num;
        }
/* FILTROS POR OBLIGACION*/
        function usuario($i) {
               return $i['USUARIO'] == $this->num;
        }
        function producto($i) {
               return $i['PRODUCTO'] == $this->num;
        }
        function segmento($i) {
               return $i['SEGMENTO'] == $this->num;
        }

        function estado_contacto($i) {
               return $i['ESTADO_CONTACTO'] == $this->num;
        }

        function resultado($i) {
               return $i['RESULTADO'] == $this->num;
        }

        /* FILTROS POR UBIGEO*/
         function Nom_Dpto($i) {
               return $i['Nom_Dpto'] == $this->num;
        }

        function Nom_Prov($i) {
               return $i['Nom_Prov'] == $this->num;
        }

        function Nom_Dist($i) {
               return $i['Nom_Dist'] == $this->num;
        }
        function filtrar_por_Cod_Dpto($i) {
               return $i['Cod_Dpto'] == $this->num;
        }

        function filtrar_por_Cod_Prov($i) {
               return $i['Cod_Prov'] == $this->num;
        }

        function filtrar_por_Cod_Dist($i) {
               return $i['Cod_Dist'] == $this->num;
        }

        /* FILTROS POR Campana_id*/
        function filtrar_por_Campana_id($i) {
               return $i['Campana_id'] == $this->num;
        }

        //filtrar por deudor
        function filtrar_por_Sexo($i) {
               return $i['SEXO'] == $this->num;
        }


        function filtrar_por_id_Rango_Edad($i) {
               return $i['ID_RANGO_EDAD'] == $this->num;
        }

        function filtrar_por_Deudor_id($i) {
               return $i['DEUDOR_ID'] == $this->num;
        }


        //RANKING SEGMENTACION;

        function filtrar_por_TipoMonto($i) {
               return $i['TIPO_MONTO'] == $this->num;
        }


        function filtrar_por_Ejecutivo($i) {
               return $i['EJECUTIVO'] == $this->num;
        }
        

        function filtrar_por_segmento($i) {
               return $i['SEGMENTO'] == $this->num;
        }

        
        function filtrar_por_Usuario_id($i) {
               return $i['USUARIO_ID'] == $this->num;
        }

        function filtrar_por_idResultado($i) {
               return $i['IDRESULTADO'] == $this->num;
        }

        function filtrar_por_Hora_Inicio($i) {
               return $i['HORA_GESTION'] == $this->num;
        }
        /*
          TABLA DESPLEGABLE
        */
        function filter_by_FirstRow($i) {
               return $i['FIRST_CODE'] == $this->num;
        }

        function filter_by_SecondRow($i) {
               return $i['SECOND_CODE'] == $this->num;
        }

        function filter_by_ThirdRow($i) {
               return $i['THIRD_CODE'] == $this->num;
        }


}
 ?>

 <?php 
class FilterArray{
        private $num;
        private $index;

        function __construct($num,$index) {
                $this->num = $num;
                $this->index = $index;
        }
/* FILTROS POR GESTION*/
        function filter_by_index($i) {
               return $i[$this->index] == $this->num;
        }


}
 ?>
