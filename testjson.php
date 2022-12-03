<?php


$result = array(
    array("oldID" => "1","oldMain"=>"test"),
    array("oldID" => "2","oldMain"=>"test"),
    array("oldID" => "3","oldMain"=>"test")
);
  


  $data = [];
    foreach ($result as $res) {
            $t = [];
            $t['oldID'] = $res['oldID'];
            $t['oldMain'] = $res['oldMain'];
            $data[] = $t;
        }
        echo json_encode(['data' => $data]);
?>


