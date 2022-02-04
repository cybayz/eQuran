<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Monthly Batch Attendance</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= $this->makeURL("attendance/monthlybatchattendance") ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                    <th>Name</th>
                                    <?php
                                        for($i=1;$i<32;$i++){?>
                                            <th><?=$i; ?></th> <?php
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($this->student_data as $row){?>
                                    <tr>
                                        <td><?=$row->id;?></td>
                                        <td><?=$row->firstname." ".$row->lastname;?></td>
                                        <?php
                                            for($i=1;$i<32;$i++){
                                                $present = 1;
                                                foreach($this->attendance_data as $attendance){
                                                    if(($attendance->studentid==$row->id)&&($attendance->dateday==$i)){
                                                        $present=$attendance->status;
                                                    }
                                                }
                                            ?><td><?=($present)?"P":"A"; ?></td> <?php 
                                            }
                                        ?>
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