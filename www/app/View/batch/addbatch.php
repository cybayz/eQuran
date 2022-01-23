<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Batch</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("batch/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Batch Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="batchname" name="batchname" placeholder="Batch" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Course</label></div>
                        <div class="col-12 col-md-9">
                            <select name="course" id="course" class="form-control">
                                <option value="0">Please select</option>
                                    <?php foreach($this->course_data as $row){?>
                                        <option value="<?=$row->id;?>"><?=$row->coursename;?></option>
                                    <?php                                 
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Description</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="batchdescription" name="batchdescription" placeholder="Description" class="form-control">
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>