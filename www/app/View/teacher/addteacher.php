<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Teacher</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("teacher/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="teachername" name="teachername" placeholder="Teacher Name" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Qualification</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="qualification" name="qualification" placeholder="Qualification" class="form-control">
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile No</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control">
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