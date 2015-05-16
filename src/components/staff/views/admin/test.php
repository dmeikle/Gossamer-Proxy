
<?php
$list = array();
$list[] = array("id"=>1,"firstname"=>"dave","lastname"=>"meikle","telephone"=>"123","email"=>"test");
$list[] = array("id"=>2,"firstname"=>"dave1","lastname"=>"meikle","telephone"=>"123","email"=>"test");
$list[] = array("id"=>3,"firstname"=>"dave2","lastname"=>"meikle","telephone"=>"123","email"=>"test");
$list[] = array("id"=>4,"firstname"=>"dave3","lastname"=>"meikle","telephone"=>"123","email"=>"test");

echo json_encode($list);