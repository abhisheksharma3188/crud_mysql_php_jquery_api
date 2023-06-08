<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');

include_once 'connection.php';

$s_no_1=$_POST['s_no_1_input'];
$s_no_2=$_POST['s_no_2_input'];
$jwt=getallheaders()['Authorization'];

//////////////////////// code to fetch data in table below /////////////////////////////////////////////////
$query='SELECT
        *
        FROM
        test_table
        WHERE
        s_no >= ?
        AND
        s_no <= ?
        ';
$mysqli_prepare = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($mysqli_prepare, 'ss', $s_no_1,
                                              $s_no_2);
mysqli_stmt_execute($mysqli_prepare);
$mysqli_stmt_get_result = mysqli_stmt_get_result($mysqli_prepare);

$response_array=[];

if (mysqli_num_rows($mysqli_stmt_get_result) > 0) {
    while($mysqli_fetch_assoc=mysqli_fetch_assoc($mysqli_stmt_get_result)){
        $record=['s_no'=>$mysqli_fetch_assoc['s_no'],'name'=>$mysqli_fetch_assoc['name'],'surname'=>$mysqli_fetch_assoc['surname'],'age'=>$mysqli_fetch_assoc['age']];
        array_push($response_array,$record);
    }
    $response_json=json_encode($response_array);
    echo $response_json;
    die;
}
else{
    $response_json=json_encode($response_array);
    echo $response_json;
    die;
}
//////////////////////// Code to fetch data in table above /////////////////////////////////////////
?>
