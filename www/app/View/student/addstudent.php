<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Student</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("student/create")?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">    
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">First Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Last Name</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="lastname" name="lastname" placeholder="Last Name" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile Number</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="mobile" name="mobile" placeholder="Mobile Number" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Address</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="address" name="address" placeholder="Address" class="form-control"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email Id</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="email" name="email" placeholder="Email Id" class="form-control"></div>
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
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Batch</label></div>
                        <div class="col-12 col-md-9">
                            <select name="batch" id="batch" class="form-control">
                                <option value="0">Please select course first</option>                                
                                }?>
                            </select>
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
    $("#course").change(function () {                            
            var course_id = this.value;
            $.ajax({
                url: "getbatchbycourseid",
                type: "POST",
                data: {
                    course_id: course_id
                },
                cache: false,
                success: function(result){
                    $("#batch").html(result);
                }
            });
        
        
    });  
</script>