<?php
require 'db_config.php'; 

$request=$_REQUEST;
$col =array(
  	0 =>'category', 
	1 =>'rtype',
	2=>'resource',
	3=>'title',
	4=>'childId',
	5=>'SubCatCount',
	6=>'totalSubCatCount',
	7=>'createdAt',
	8=>'updatedAt'
);  //create column like table in database

$sql ="SELECT * FROM public.resources";
$query=pg_query($sql);

$totalData=pg_num_rows($query);

$totalFilter=$totalData;
//Search
$sql ="SELECT * FROM public.resources WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (rtype Like '%".$request['search']['value']."%' ";
    $sql.=" OR resource Like '%".$request['search']['value']."%' ";
     $sql.=" OR title Like '%".$request['search']['value']."%' ";
      $sql.=" OR 'category' Like '%".$request['search']['value']."%' ";
       $sql.=" OR 'childId' Like '%".$request['search']['value']."%' ";
      $sql.=" OR 'subUrlCount' Like '%".$request['search']['value']."%' ";
       $sql.=" OR 'totalsubUrlCount' Like '%".$request['search']['value']."%' )";
}
//Order
$sql.=" ORDER BY \"".$col[$request['order'][0]['column']]."\" ".$request['order'][0]['dir']."  LIMIT ".
    $request['length']."  OFFSET ".$request['start']."  ";
$query=pg_query($sql);
$data=array();
while( $row=pg_fetch_assoc($query) ) {  // preparing an array
$nestedData=array(); 
$nestedData[] = $row['category'];
	$nestedData[] = $row['rtype'];
	$nestedData[] = $row['resource'];
	$nestedData[] = $row['title'];
	$nestedData[] = $row['childId'];
	$nestedData[] = $row['subCatCount'];
	$nestedData[] = $row['totalSubCatCount'];
	$nestedData[] = $row['createdAt'];
	$nestedData[] = $row['updatedAt'];
$nestedData[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row['id'].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
                <a href="index_Resources.php?delete='.$row['category'].'" onclick="return confirm(\'Are You Sure ?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
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
