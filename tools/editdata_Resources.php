<?php
require 'db_config.php';  
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="SELECT * FROM public.resources WHERE id=$id";
    $run_sql=pg_query($sql);
    while($row=pg_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_topic=$row[1];
        $per_title=$row[2];
        $per_description=$row[3];
    }
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
                            <label class="col-sm-4 control-label" for="txttopic">Topic</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txttopic" name="txttopic" value="<?php echo $per_topic;?>">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Cancel</button> 
                <button type="submit" class="btn btn-primary" name="btnEdit">Save</button>
            </div>
        </div>
    </form>










