<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Attendance</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("attendance/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-9">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Select Date</label></div>
                        <div class="col-12 col-md-4">
                            <input type="date" id="date" class="form-control" name="date" value="<?php echo date("Y-m-d");?>">   
                        </div>
                    </div>          
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ids of absent students</label></div>
                        <div class="col-12 col-md-9">
                            <textarea id="absentstudent" name="absentstudent" class="form-control" placeholder="Student Ids">   </textarea>
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
<script>
  $( function() {
    $("#datepicker").datepicker();
  } );
  </script>