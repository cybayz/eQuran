<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Course</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("course/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Course Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="coursename" name="coursename" placeholder="Course" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Duration</label></div>
                        <div class="col-12 col-md-9">
                            <select name="courseduration" id="courseduration" class="form-control">
                                <option value="0">Please select</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="3">3 Month</option>
                                <option value="4">4 Month</option>
                                <option value="5">5 Month</option>
                                <option value="6">6 Month</option>
                                <option value="7">7 Month</option>
                                <option value="8">8 Month</option>
                                <option value="9">9 Month</option>
                                <option value="10">10 Month</option>
                                <option value="11">11 Month</option>
                                <option value="12">12 Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Description</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="coursedescription" name="coursedescription" placeholder="Description" class="form-control">
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