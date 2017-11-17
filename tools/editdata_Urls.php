<?php
require 'db_config.php';  
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM public.urls WHERE id=$id";
    $run_sql=pg_query($sql);
    while($row=pg_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_priority=$row[1];
        $per_ages=$row[2];
        $per_mediadate=$row[3];
        $per_url=$row[4];
        $per_title=$row[5];
        $per_description=$row[6];
        $per_category=$row[7];
    }
   echo json_encode($row);
?>
    <form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtid">ID</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtpriority">Priority</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtpriority" name="txtpriority" value="<?php echo $per_priority;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtages">Ages</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtages" name="txtages" value="<?php echo $per_ages;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtmediadate">Mediadate</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtmediadate" name="txtmediadate" value="<?php echo $per_mediadate;?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txturl">Urls</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txturl" name="txturl" value="<?php echo $per_url;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txttitle">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txttitle" name="txttitle" value="<?php echo $per_title;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtdescription">Description</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtdescription" name="txtdescription" value="<?php echo $per_description;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtcategory">Category Id</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="txtcategory" name="txtcategory" value="<?php echo $per_category;?>" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Cancel</button> 
                <button type="submit" class="btn btn-primary" name="btnEdit">Save</button>
            </div>
        </div>
    </form>
    
<?php
}//end if
?>









