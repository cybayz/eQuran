<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Update Juzz</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Student Name</th>
                                    <th>Course Name</th>
                                    <th>Batch Name</th>
                                    <th>Juzz</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->student_data as $key=>$row){
                                $course_id_of_student=($row->courseid)-1;
                                $batch_id_of_student=($row->batchid)-1;?>
                                <tr>
                                    <form action="<?= $this->makeURL("student/updatestudentjuzz")?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="studentid" id="studentid" value="<?=$row->id;?>">
                                        <td><?=$row->id;?></td>
                                        <td><a href="<?=$this->makeURL("student/details/").$row->id; ?>"><?=$row->firstname;?> <?=$row->lastname;?></a></td>
                                        <td><?=$this->course_data[$course_id_of_student]->coursename;?></td>
                                        <td><?=$this->batch_data[$batch_id_of_student]->batchname;?></td>
                                        <td><select name="juzz" id="juzz" class="form-control">
                                                <option value="0" <?=($row->juzz==0)?" selected":"";?>>Select Juzz</option>
                                                <option value="1" <?=($row->juzz==1)?" selected":"";?>>1/4 Juzz</option>
                                                <option value="2" <?=($row->juzz==2)?" selected":"";?>>1/2 Juzz</option>
                                                <?php for($i=3;$i<33;$i++){
                                                    echo ("<option value=".$i.(($row->juzz==$i)?" selected":"").">Juzz ".($i-2)."</option>");
                                                }?>
                                            </select>
                                        </td>
                                        <td><?=$row->mobile;?></td>
                                        <td><button id="<?=$row->id;?>" type="submit" class="btn btn-success btn-sm">Update Juzz</button></td>
                                    </form>
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" data-backdrop="static" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="<?= $this->makeURL("student/delete")?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                <input type="hidden" name="deletionId" id="deletionId">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Do you want to remove this student?
                    </p>
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
    function prefillid(element){
        $(deletionId).val(element.id);
    };
</script>