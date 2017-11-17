<?php
require 'db_config.php'; 

$request=$_REQUEST;
$col =array(
   	0 =>'id', 
	1 =>'priority',
	2=>'ages',
	3=>'mediadate',
	4=>'url',
	5=>'title',
	6=>'description',
	7=>'category',
	8=>'createdAt',
	9=>'updatedAt'
);  //create column like table in database

$sql ="SELECT * FROM public.urls";
$query=pg_query($sql);

$totalData=pg_num_rows($query);

$totalFilter=$totalData;
//Search
$sql ="SELECT * FROM public.urls WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND ('priority' Like '%".$request['search']['value']."%' ";
    $sql.=" OR ages Like '%".$request['search']['value']."%' ";
    $sql.=" OR mediadate Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'category' Like '%".$request['search']['value']."%' ";
	$sql.=" OR url Like '%".$request['search']['value']."%' ";
	$sql.=" OR title Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'id' Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'subUrlCount' Like '%".$request['search']['value']."%' ";
    $sql.=" OR 'totalsubUrlCount' Like '%".$request['search']['value']."%' ";
    $sql.=" OR description Like '%".$request['search']['value']."%' )";
}
//Order
$sql.=" ORDER BY \"".$col[$request['order'][0]['column']]."\" ".$request['order'][0]['dir']."  LIMIT ".
    $request['length']."  OFFSET ".$request['start']."  ";
$query=pg_query($sql);
$data=array();
while( $row=pg_fetch_assoc($query) ) {  // preparing an array
$nestedData=array(); 
	$nestedData[] = $row['id'];
	$nestedData[] = $row['priority'];
	$nestedData[] = $row['ages'];
	$nestedData[] = $row['mediadate'];
	$nestedData[] = $row['url'];
	$nestedData[] = $row['title'];
	$nestedData[] = $row['description'];
	$nestedData[] = $row['category'];
	$nestedData[] = $row['createdAt'];
	$nestedData[] = $row['updatedAt'];
$nestedData[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row['id'].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
                 <a href="index_Urls.php?delete='.$row['id'].'" onclick="return confirm(\'Are You Sure ?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
    $data[] = $nestedData;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data,
    "sql"				=> $sql
);

echo json_encode($json_data);
?>
