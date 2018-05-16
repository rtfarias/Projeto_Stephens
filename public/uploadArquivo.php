<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: image/jpeg');
// verificar permisssão na pasta de upload
//echo 'teste';
//var_dump($_FILES['fileUpload']);
if(isset($_FILES['fileUpload'])){
    //The error validation could be done on the javascript client side.

	 //print_r($_FILES);
    $errors= array();
    $file_name = $_FILES['fileUpload']['name'];
    $file_size =$_FILES['fileUpload']['size'];
    $file_tmp =$_FILES['fileUpload']['tmp_name'];
    $file_type=$_FILES['fileUpload']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $extensions = array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions )=== false){
     $errors[]="image extension not allowed, please choose a JPEG or PNG file.";
    }
	//$nome_pasta = str_replace('.jpg', "", $file_name);
	$file_name = strtolower($file_name);
	//mkdir('imagesProfiles/'.$nome_pasta, 0755);
	$destino = '/uploads/'.$_POST['tipo'].'/'.$file_name;

    if(empty($errors)==true){
        $salvou = move_uploaded_file($file_tmp, $destino);
        if ($salvou)
        {
                echo 'salvou';
        }
        else
        {
                echo 'erro';
        }
       // return $file_name;
    }else{
        print_r($errors);
    }
}
?>
