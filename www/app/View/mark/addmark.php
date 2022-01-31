<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Mark</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("course/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-6">
                                     
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