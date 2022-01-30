<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Course List</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Teacher Id</th>
                                    <th>Teacher Name</th>
                                    <th>Qualification</th>
                                    <th>Mobile No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->data as $row){?>
                                <tr>
                                    <td><?=$row->id;?></td>
                                    <td><a href="<?=$this->makeURL("teacher/studentsunderteacher/").$row->id; ?>"><?=$row->name;?></a></td>
                                    <td><?=$row->qualification;?></td>
                                    <td><?=$row->mobile;?></td>
                                    <td><button id="<?=$row->id;?>" type="button" class="btn btn-danger btn-sm deletebtn" data-toggle="modal" data-target="#deleteModal" onclick="prefillid(this)">Delete</button></td>
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
            <form action="<?= $this->makeURL("course/delete")?>" method="post" enctype="multipart/form-data">
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
                        Do you want to remove this course?
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