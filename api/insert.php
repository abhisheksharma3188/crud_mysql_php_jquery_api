<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');

include_once 'connection.php';

$name=$_POST['name_input'];
$surname=$_POST['surname_input'];
$age=$_POST['age_input'];
$jwt=getallheaders()['Authorization'];

//////////////////////////////// code to insert data in table below /////////////////////////////////////////////////
$query='INSERT
        INTO
        test_table
        SET
        name=?,
        surname=?,
        age=?
        ';
$mysqli_prepare = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($mysqli_prepare, 'sss',$name,
                                              $surname,
                                              $age);
if(!mysqli_stmt_execute($mysqli_prepare)){
    $response_array=['response'=>'failure','message'=>'Failed To Insert Data'];
    $response_json=json_encode($response_array);
    echo $response_json;
    die;
}

$mysqli_insert_id = mysqli_insert_id($connection);

$response_array=['response'=>'success','message'=>'Data Inserted Successfully','s_no'=>$mysqli_insert_id,'jwt'=>$jwt];
$response_json=json_encode($response_array);
echo $response_json;
die;

//////////////////////////////// code to insert data in table above /////////////////////////////////////////////////
?>
