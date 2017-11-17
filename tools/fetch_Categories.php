<?php
require 'db_config.php'; 

$request=$_REQUEST;
$col =array(
   0 =>'id', 
	1 =>'topic',
	2=>'title',
	3=>'description',
	4=>'subUrlCount',
	5=>'totalSubUrlCount',
	6=>'createdAt',
	7=>'updatedAt'
);  //create column like table in database

$sql ="SELECT * FROM public.categories";
$query=pg_query($sql);

$totalData=pg_num_rows($query);

$totalFilter=$totalData;
//Search
$sql ="SELECT * FROM public.categories WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (topic Like '%".$request['search']['value']."%' ";
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
$nestedData[] = $row['topic'];
$nestedData[] = $row['title'];
$nestedData[] = $row['description'];
$nestedData[] = $row['subUrlCount'];
$nestedData[] = $row['totalSubUrlCount'];
$nestedData[] = $row['createdAt'];
$nestedData[] = $row['updatedAt'];
$nestedData[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row['id'].'"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button>
                <a href="index_Categories.php?delete='.$row['id'].'" onclick="return confirm(\'Are You Sure ?\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash">&nbsp;</i>Delete</a>';
    $data[] = $nestedData;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
?>
