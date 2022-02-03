<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Mark List</strong>
                    </div>
                    <div class="card-body" style="overflow-x: scroll; width:1010px;">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>1/4 Juzz</th>
                                    <th>1/2 Juzz</th>
                                    <?php
                                        for($i=3;$i<33;$i++){?>
                                            <th>Juzz <?=($i-2); ?></th> <?php
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->studentdata as $row){?>
                                <tr>
                                    <td><?=$row->id;?></td>
                                    <td><?=$row->firstname;?></td>
                                    <td><?=$row->mobile;?></td>
                                    <?php
                                        for($i=1;$i<33;$i++){
                                            $markofrow = 0;
                                            foreach($this->markdata as $mark){
                                                if(($mark->juzz==$i)&&($mark->studentid==$row->id)){
                                                    $markofrow=$mark->mark;
                                                }
                                            }
                                        ?><td><?=$markofrow; ?></td> <?php 
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
    $(document).ready(function () {
      $('#bootstrap-data-table-export').DataTable({
  
        // Enable the horizontal scrolling
        // of data in DataTable
        scrollX: true
      });
    }); 
</script>