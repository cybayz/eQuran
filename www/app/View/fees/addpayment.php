<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Payment</strong>
        </div>
        <div class="card-body card-block ">
            <form action="<?= $this->makeURL("mark/addmark") ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="col-lg-1">
                    <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                </div>
                <div class="col-lg-12">
                    <div class="row form-group">
                        <div class="col-12 col-md-3">
                            <select name="course" id="course" class="form-control">
                                <option value="0">Select Course</option>
                                <?php foreach ($this->course_data as $row) { ?>
                                    <option value="<?= $row->id; ?>"><?= $row->coursename; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-1"></div>
                        <div class="col-12 col-md-3">
                            <select name="batch" id="batch" class="form-control">
                                <option value="0">Select Batch</option>
                                }?>
                            </select>
                        </div>
                        <div class="col-12 col-md-1"></div>
                        <div class="col-12 col-md-3">
                            <select name="teacher" id="teacher" class="form-control">
                                <option value="0">Select Teacher</option>
                                <?php foreach ($this->teachers_data as $row) { ?>
                                    <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-4"></div>
                        <div class="col-12 col-md-8">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Get Students
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header">
            <strong class="card-title">Student List</strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Batch Name</th>
                        <th>Current Juzz</th>
                        <th>Teacher</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($this->student_data as $key=>$row){
                    $course_id_of_student=($row->courseid)-1;
                    $batch_id_of_student=($row->batchid)-1;
                    $teacher_id_of_student=($row->teacherid)-1;?>
                    <tr>
                        <td><?=$row->id;?></td>
                        <td><a href="<?=$this->makeURL("student/details/").$row->id; ?>"><?=$row->firstname;?> <?=$row->lastname;?></a></td>
                        <td><?=$this->course_data[$course_id_of_student]->coursename;?></td>
                        <td><?=$this->batch_data[$batch_id_of_student]->batchname;?></td>
                        <td><?=$row->juzz;?></td>
                        <td><?= ($teacher_id_of_student<0)?"No Teacher":$this->teachers_data[$teacher_id_of_student]->name;?></td>
                        <td><button id="<?=$row->id;?>" data-id="<?=$row->id;?>" data-studentname="<?=$row->firstname;?> <?=$row->lastname;?>" type="button" 
                            class="btn btn-danger btn-sm deletebtn" data-toggle="modal" data-target="#addpaymentModal" 
                            data-course="<?=$this->course_data[$course_id_of_student]->coursename;?>" data-batch = "<?=$this->batch_data[$batch_id_of_student]->batchname;?>" 
                            data-batchid = "<?=$batch_id_of_student;?>" data-courseid = "<?=$course_id_of_student;?>" 
                            onclick="prefillid(this)">Add Payment</button></td>
                    </tr><?php                                 
                }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addpaymentModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= $this->makeURL("fees/createpayment")?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                <input type="hidden" name="studentid" id="studentid">
                <input type="hidden" name="courseid" id="courseid">
                <input type="hidden" name="batchid" id="batchid">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                    <div class="col col-md-1"></div>
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Select Month</label></div>
                        <div class="col-12 col-md-3">
                            <input type="month" id="month" name="month" value="<?=date("Y-m");?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-1"></div>
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Amount</label></div>
                        <div class="col-12 col-md-3"><input type="text" id="amount" name="amount" placeholder="Amount" class="form-control"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
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
    function prefillid(element){
        var id      = $(element).attr('data-id');
        var course  = $(element).attr('data-course');
        var courseid= $(element).attr('data-courseid');
        var student = $(element).attr('data-studentname');
        var batch   = $(element).attr('data-batch');
        var batchid = $(element).attr('data-batchid');

        $('#studentid').val(id);
        $('#courseid').val(courseid);
        $('#batchid').val(batchid);
        $.ajax({
            url: "getstudentsmark",
            type: "POST",
            data: {
                id: id
            },
            cache: false,
            success: function(result){
                $("#batch").html(result);
            }
        });
    };
</script>