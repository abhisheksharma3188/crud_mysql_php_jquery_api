<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');

include_once 'connection.php';

$s_no=$_POST['s_no_input'];
$jwt=getallheaders()['Authorization'];

//////////////////////////////// code to delete data in table below /////////////////////////////////////////////////
$query='DELETE
        FROM
        test_table
        WHERE
        s_no=?
        ';
$mysqli_prepare = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($mysqli_prepare, 's',$s_no);
if(!mysqli_stmt_execute($mysqli_prepare)){
    $response_array=['response'=>'failure','message'=>'Failed To Delete Data'];
    $response_json=json_encode($response_array);
    echo $response_json;
    die;
}

$response_array=['response'=>'success','message'=>'Data Deleted Successfully','s_no'=>$s_no,'jwt'=>$jwt];
$response_json=json_encode($response_array);
echo $response_json;
die;

//////////////////////////////// code to delete data in table above /////////////////////////////////////////////////
?>
