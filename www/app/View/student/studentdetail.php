<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Student Detail</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <section class="card">
                            <div class="twt-feed blue-bg">
                                <div class="media">
                                    <a href="#">
                                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?= $this->makeURL("/images/profile_img.png") ?>">
                                    </a>
                                    <div class="media-body">
                                        <h2 class="text-white display-6"><?= $this->student_data[0]->firstname . " " . $this->student_data[0]->lastname; ?></h2>
                                        <p class="text-light">Course Name: <?= $this->student_data[0]->coursename; ?></p>
                                        <p class="text-light">Batch: <?= $this->student_data[0]->batchname; ?></p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Profile</a>
                            <a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Academics</a>
                            <a class="nav-item nav-link" id="nav-attendance-tab" data-toggle="tab" href="#nav-attendance" role="tab" aria-controls="nav-attendance" aria-selected="false">Attendance</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Fees</a>
                        </div>
                    </nav>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row form-group">
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">First Name</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->firstname; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">Last Name</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->lastname; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">Address</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->address; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">Email Id</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->email; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">Age</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->age; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-3"><label class=" form-control-label">Mobile No</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static"><?= $this->student_data[0]->mobile; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <p class="form-control-static">Current Teacher : <?= $this->student_data[0]->teachername; ?></p>
                                    <br>
                                    <label class=" form-control-label">Student progress :</label> 
                                        
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?=($this->student_data[0]->juzz/32*100);?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <br><hr><br>
                                    <div class="row form-group">
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-4"><label class=" form-control-label">Current Juzz :</label></div>
                                            <div class="col-12 col-md-2">
                                                <?php
                                                    switch($this->student_data[0]->juzz){
                                                        case 1:
                                                            $juzz="1/4";
                                                            break;
                                                        case 2:
                                                            $juzz="1/2";
                                                            break;
                                                        default:
                                                            $juzz=$this->student_data[0]->juzz;
                                                            break;
                                                    }

                                                ?>
                                                <p class="form-control-static"><?= $juzz ?></p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="col col-md-4"><label class=" form-control-label">Total Juzz :</label></div>
                                            <div class="col-12 col-md-2">
                                                <p class="form-control-static">30</p>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>1/4 Juzz</th>
                                                <th>1/2 Juzz</th>
                                                <?php
                                                    for($i=3;$i<11;$i++){?>
                                                        <th>Juzz <?=($i-2); ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=1;$i<11;$i++){
                                                        $markofrow = 0;
                                                        foreach($this->mark_data as $mark){
                                                            if(($mark->juzz==$i)){
                                                                $markofrow=$mark->mark;
                                                            }
                                                        }
                                                    ?><td><?=$markofrow; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                    for($i=11;$i<22;$i++){?>
                                                        <th>Juzz <?=($i-2); ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=11;$i<22;$i++){
                                                        $markofrow = 0;
                                                        foreach($this->mark_data as $mark){
                                                            if(($mark->juzz==$i)){
                                                                $markofrow=$mark->mark;
                                                            }
                                                        }
                                                    ?><td><?=$markofrow; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                    for($i=22;$i<33;$i++){?>
                                                        <th>Juzz <?=($i-2); ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=22;$i<33;$i++){
                                                        $markofrow = 0;
                                                        foreach($this->mark_data as $mark){
                                                            if(($mark->juzz==$i)){
                                                                $markofrow=$mark->mark;
                                                            }
                                                        }
                                                    ?><td><?=$markofrow; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade" id="nav-attendance" role="tabpanel" aria-labelledby="nav-attendance-tab">
                                    <div class="col-12 col-md-8">
                                        <div class="col col-md-3"><label class=" form-control-label">Join date :</label></div>
                                        <div class="col-12 col-md-3">
                                            <p class="form-control-static"><?= date("d-m-Y", strtotime($this->student_data[0]->createddate));?></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="col col-md-3"><label class=" form-control-label">Total Absent :</label></div>
                                        <div class="col-12 col-md-2">
                                            <p class="form-control-static"><?=$this->total_absent[0]->totalabsent;?></p>
                                        </div>
                                    </div>
                                    <form action="<?= $this->makeURL("student/details/")?><?= $this->student_data[0]->id;?>#nav-attendance" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                                        <div class="col-12 col-md-8">
                                            <div class="col col-md-3"><label class=" form-control-label">Select Month :</label></div>
                                            <div class="col-12 col-md-5">
                                                <input type="month" id="month" class="form-control" name="month" value="<?= ($this->ismonthfiltered!='')?$this->ismonthfiltered:date("Y-m");?>">
                                                <input type="hidden" name="studentid" id="studentid" value="<?= $this->student_data[0]->id;?>">
                                            </div>
                                            <div class="row form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Get Details
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <br><br>
                                    <br><br>
                                    <br><hr><br>
                                    <?php
                                        $todaysdate             = date("d");
                                        $monthandyear           = date("Y-m");
                                        $joineddate             = date("d", strtotime($this->student_data[0]->createddate));
                                        $joinedmonthandyear     = date("Y-m", strtotime($this->student_data[0]->createddate));
                                        $removeupcommingdates   = 0;
                                        $removebeforejoindates  = 0;
                                        if($this->ismonthfiltered=='' || $this->ismonthfiltered==$monthandyear){
                                            $removeupcommingdates=1;
                                        }
                                        if($this->ismonthfiltered>$monthandyear){
                                            $removeupcommingdates=2;
                                        }
                                        if($joinedmonthandyear==$monthandyear || $joinedmonthandyear == $this->ismonthfiltered){
                                            $removebeforejoindates=1;
                                        }
                                        if($this->ismonthfiltered!='' && $this->ismonthfiltered<$joinedmonthandyear){
                                            $removebeforejoindates=2;
                                        }
                                    ?>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                    for($i=1;$i<11;$i++){?>
                                                        <th>Day <?=$i; ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=1;$i<11;$i++){
                                                        $present = "P";
                                                        foreach($this->attendance_data as $attendance){
                                                            if(($attendance->dateday==$i)){
                                                                $present=($attendance->status==0)?"A":"P";
                                                            }
                                                        }
                                                        if(($removeupcommingdates==1 && $todaysdate<$i)||($removebeforejoindates==1 && $joineddate>$i)){
                                                            $present="-";
                                                        }
                                                        if($removeupcommingdates==2 || $removebeforejoindates==2){
                                                            $present="-";
                                                        }
                                                    ?><td><?=$present; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                    for($i=11;$i<21;$i++){?>
                                                        <th>Day <?=$i; ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=11;$i<21;$i++){
                                                        $present = "P";
                                                        foreach($this->attendance_data as $attendance){
                                                            if(($attendance->dateday==$i)){
                                                                $present=($attendance->status==0)?"A":"P";
                                                            }
                                                        }
                                                        if(($removeupcommingdates==1 && $todaysdate<$i)||($removebeforejoindates==1 && $joineddate>$i)){
                                                            $present="-";
                                                        }
                                                        if($removeupcommingdates==2 || $removebeforejoindates==2){
                                                            $present="-";
                                                        }
                                                    ?><td><?=$present; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                    for($i=21;$i<32;$i++){?>
                                                        <th>Day <?=$i; ?></th> <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                    for($i=21;$i<32;$i++){
                                                        $present = "P";
                                                        foreach($this->attendance_data as $attendance){
                                                            if(($attendance->dateday==$i)){
                                                                $present=($attendance->status==0)?"A":"P";
                                                            }
                                                        }
                                                        if(($removeupcommingdates==1 && $todaysdate<$i)||($removebeforejoindates==1 && $joineddate>$i)){
                                                            $present="-";
                                                        }
                                                        if($removeupcommingdates==2 || $removebeforejoindates==2){
                                                            $present="-";
                                                        }
                                                    ?><td><?=$present; ?></td> <?php 
                                                    }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    Fee details: $to do;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){   
        var hash = location.hash.replace(/^#/, ''); 
        if (hash) {
            $('#nav-profile-tab').removeClass('active show');
            $('#nav-profile').removeClass('active show');
            $('#'+hash+'-tab').removeClass('active show').addClass('active show');
            $('#'+hash).removeClass('active show').addClass('active show');
        } 
    });
</script>