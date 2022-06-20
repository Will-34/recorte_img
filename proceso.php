<?php 
$nombre =uniqid();
$destino="miniaturas/".$nombre.".jpg";
$nAncho=400;
$nAlto=600;
//aca se reajusta la imagen a 600x400
if($_FILES['imagen']['error'] === UPLOAD_ERR_OK){
    $imagen_original = $_FILES['imagen']['tmp_name'];
    
    $img_original = imagecreatefromjpeg($imagen_original);
    $ancho_original = imagesx($img_original);
    $alto_original = imagesy($img_original);

    $tmp=imagecreatetruecolor($nAncho,$nAlto);
    imagecopyresized($tmp,$img_original,0,0,0,0,$nAncho,$nAlto,


    $ancho_original,$alto_original);
    imagejpeg($tmp,$destino,100);



//aca se empieza a cortar
    $cortar = imagecreatefromjpeg($destino);
    $ancho_cortar = imagesx($cortar);
    $alto_cortar = imagesy($cortar);

//elegir la particion
    $fila = 3;
    $columna = 3;


    $cuadradox= $nAncho/$columna;
    $cuadradoy= $nAlto/$fila;
    $contador= 1;
    $ymov = -1 * $cuadradoy;


    for ($f = 1; $f <= $fila; $f++) {
        $xmov=0;
        $ymov = $ymov+$cuadradoy;

        for ($j = 1; $j <= $columna; $j++) {
            $tmp=imagecreatetruecolor($cuadradox,$cuadradoy);
            imagecopyresized($tmp,$cortar,0,0,$xmov,$ymov, $cuadradox,$cuadradoy,$cuadradox,$cuadradoy);
            imagejpeg($tmp,"miniaturas/".$nombre."-".$contador.".jpg",100);
            $contador = $contador+1;
            $xmov = $xmov + $cuadradox;
        }
    }
    
}