<!DOCTYPE html>
<html>
	<title>Urls</title>
	<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.colVis.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="js/dataTables.colVis.js"></script>
		<script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
		
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
			   var dataTable =  $('#employee-grid').DataTable( {
			   	dom: 'T<"clear">lfrtip',
			   		"tableTools": {
			   	   	"sSwfPath": "swf/copy_csv_xls_pdf.swf",
			   	    	"sRowSelect": "multi",
				    	"aButtons": [
					        	"select_all", 
					        	"select_none",
							{
						    		"sExtends":    "collection",
						    		"sButtonText": "Export",
						    		"aButtons":    [ "csv", "xls", "pdf"]
							}
				    	]
				},
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"fetch_Urls.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
		
			 var colvis = new $.fn.dataTable.ColVis( dataTable, {
					buttonText: 'Show / hide columns',
					activate: 'mouseover',
					exclude: [ 0 ]	
    			   } );
			   $( colvis.button() ).prependTo('th:nth-child(1)');
		    
			} );
		</script>


	</head>
	<body>
	<?php include 'header.php';?>
<div class="container1">
		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="container">
				<button type="button" style="height:40px;width:170px;background-color:tear;margin:auto;display:block;padding-top: 0px;" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Create Urls
				</button>
		        </div>
		    </div>
		</div>
		<div class="container1">
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" >
					 <thead>
            <tr>
                            <th>Id</th>
							<th>Priority</th>
							<th>Ages</th>
							<th>Mediadate</th>
							<th>Url</th>
							<th>Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>createdAt</th>
							<th>updatedAt</th>
                            <th>Action</th>
            </tr>
            </thead>
            
        </table>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>
    </div>

	    <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create Urls</h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="http://localhost:8888/tools/create_Urls.php" method="POST">
		      		
		      		<div class="form-group">
							<label class="control-label" for="urls">Urls:</label>
							<input type="text" name="urls" class="form-control" data-error="Please enter urls." required />
							<div class="help-block with-errors"></div>
						</div>

		      			<div class="form-group">
							<label class="control-label" for="title">Title:</label>
							<input type="text" name="title" class="form-control" data-error="Please enter title." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="category">Category Id:</label>
							<input type="number" name="category" class="form-control" data-error="Please enter category id." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn crud-submit btn-success" >Submit</button>
						</div>

		      		</form>

		      </div>
		    </div>

		  </div>
		</div>
    <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"fetch_Urls.php",
                    type:"post"
                }
            });
        });
    </script>
   
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            $('#content-data').html('');
            $.ajax({
                url:'editdata_Urls.php',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
                $('#content-data').html('<p>Error</p>');
            });
            
        });
    </script>
</body>
</html>
<?php
require 'db_config.php';
if(isset($_POST['btnEdit'])){
    $new_id=pg_escape_string($_POST['txtid']);
    $new_priority=pg_escape_string($_POST['txtpriority']);
    $new_ages=pg_escape_string($_POST['txtages']);
    $new_mediadate=pg_escape_string($_POST['txtmediadate']);
    $new_url=pg_escape_string($_POST['txturl']);
    $new_title=pg_escape_string($_POST['txttitle']);
    $new_description=pg_escape_string($_POST['txtdescription']);
    $new_category=pg_escape_string($_POST['txtcategory']);
    $sqlupdate="UPDATE public.Urls SET priority=$new_priority,
    ages='$new_ages',mediadate='$new_mediadate',url='$new_url',
                title='$new_title',description='$new_description',category='$new_category'
                WHERE id='$new_id'";
    $result_update=pg_query($sqlupdate);
    if($result_update){
        echo '<script>window.location.href="index_Urls.php"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sqldelete="DELETE FROM public.Urls WHERE id='$id'";
    $result_delete=pg_query($sqldelete);
    if($result_delete){
        echo'<script>window.location.href="index_Urls.php"</script>';
    }
    else{
   
        echo'<script>alert("Delete Failed")</script>';
    }
}
?>

