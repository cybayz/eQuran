<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Pending Students</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= $this->makeURL("fees/pendingstudents") ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="col-lg-1">
                            <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                        </div>
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <div class="col-12 col-md-1"></div>
                                <div class="col-12 col-md-3">
                                    <input type="month" id="month" class="form-control" name="month" value="<?php echo date("Y-m");?>">
                                </div>
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
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="overflow-x: scroll; width:1010px;">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Student Name</th>
                                    <th>Course Name</th>
                                    <th>Juzz</th>
                                    <th>Mobile Number</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->student_data as $key=>$row){
                                $course_id_of_student=($row->courseid)-1;
                                $batch_id_of_student=($row->batchid)-1;?>
                                <tr>
                                    <td><?=$row->id;?></td>
                                    <td><a href="<?=$this->makeURL("student/details/").$row->id; ?>"><?=$row->firstname;?> <?=$row->lastname;?></a></td>
                                    <td><?=$this->course_data[$course_id_of_student]->coursename;?></td>
                                    <td><?=$row->juzz;?></td>
                                    <td><?=$row->mobile;?></td>
                                </tr><?php                                 
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
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