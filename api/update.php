<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');

include_once 'connection.php';

$s_no=$_POST['s_no_input'];
$name=$_POST['name_input'];
$surname=$_POST['surname_input'];
$age=$_POST['age_input'];
$jwt=getallheaders()['Authorization'];

//////////////////////////////// code to update data in table below /////////////////////////////////////////////////
$query='UPDATE
        test_table
        SET
        name=?,
        surname=?,
        age=?
        WHERE
        s_no=?
        ';
$mysqli_prepare = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($mysqli_prepare, 'ssss',$name,
                                               $surname,
                                               $age,
                                               $s_no);
if(!mysqli_stmt_execute($mysqli_prepare)){
    $response_array=['response'=>'failure','message'=>'Failed To Update Data'];
    $response_json=json_encode($response_array);
    echo $response_json;
    die;
}

$response_array=['response'=>'success','message'=>'Data Updateded Successfully','s_no'=>$s_no,'jwt'=>$jwt];
$response_json=json_encode($response_array);
echo $response_json;
die;

//////////////////////////////// code to update data in table above /////////////////////////////////////////////////
?>
