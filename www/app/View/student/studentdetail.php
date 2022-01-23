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
                                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src= "<?= $this->makeURL("/images/profile_img.png")?>">
                                    </a>
                                    <div class="media-body">
                                        <h2 class="text-white display-6"><?= $this->student_data[0]->firstname." ".$this->student_data[0]->lastname;?></h2>
                                        <p class="text-light"><?= $this->student_data[0]->coursename." ".$this->student_data[0]->batchname;?></p>
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
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Fees</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            Name:<?= $this->student_data[0]->firstname." ".$this->student_data[0]->lastname;?>
                            Address:<?= $this->student_data[0]->address;?>
                            Email:<?= $this->student_data[0]->email;?>
                        </div>
                        <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            Current Juzz: <?= $this->student_data[0]->juzz;?>
                            Mark List: #to do;
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