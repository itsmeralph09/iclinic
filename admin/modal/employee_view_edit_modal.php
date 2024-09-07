<!-- View -->
<div class="modal fade" id="view_<?php echo $user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel">
                        <i class="fas fa-pen-to-square fa-sm"></i> View Employee Info
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" enctype="multipart/form-data" id="editForm_<?php echo $user_id; ?>">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="mr-1">
                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="first_name" class="col-form-label text-primary">First Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="first_name" value="<?php echo $first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="middle_name" class="col-form-label text-primary">Middle Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="middle_name" value="<?php echo $mid_name; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="last_name" class="col-form-label text-primary">Last Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="last_name" value="<?php echo $last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="suffix_name" class="col-form-label text-primary">Suffix Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="suffix_name" value="<?php echo $suffix_name; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-4">
                                            <label for="student_no" class="col-form-label text-primary">Employee No</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="employee_no" value="<?php echo $employee_no; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <p class="text-primary">Profile</p>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                         <div class="image-preview-container" style="width: 180px; height: 180px; border-radius: 5px; overflow: hidden;">
                                            <img class="img-fluid rounded" id="profilePreview_<?php echo $user_id; ?>" src="../img/profiles/<?php echo $profile; ?>" alt="Profile Picture Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <hr class="">

                        <div class="col-lg-12">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="address" class="col-form-label text-primary">Personal Address</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea readonly class="form-control-plaintext custom-readonly-input" id="address" rows="1"><?php echo $address; ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group row">
                                        <label for="birthdate" class="col-sm-12 col-form-label text-primary">Birthdate</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="birthdate" value="<?php echo $formatted_birthdate; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group row">
                                        <label for="age" class="col-sm-12 col-form-label text-primary">Age</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="age" value="<?php echo $age; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group row">
                                        <label for="sex" class="col-sm-12 col-form-label text-primary">Sex</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="sex" value="<?php echo $sex; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group row">
                                        <label for="contact" class="col-sm-12 col-form-label text-primary">Contact No</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="contact" value="<?php echo $contact; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-12 col-form-label text-primary">Email</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group row">
                                        <label for="course" class="col-sm-12 col-form-label text-primary">Occupation</label>
                                        <div class="col-sm-12">
                                            <input type="text" readonly class="form-control-plaintext custom-readonly-input" id="course" value="<?php echo $occupation; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>                                           
                                    
                        </div>

                        <hr>

                        <div class="col-lg-12">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="emergency_person" class="col-form-label text-primary">Emergency Contact Person</label>
                                </div>
                                <div class="col-sm-9">
                                    <input readonly class="form-control-plaintext custom-readonly-input" id="emergency_person" value="<?php echo $emergency_person; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="emergency_no" class="col-form-label text-primary">Contact No</label>
                                </div>
                                <div class="col-sm-9">
                                    <input readonly class="form-control-plaintext custom-readonly-input" id="emergency_no" value="<?php echo $emergency_no; ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label for="emergency_address" class="col-form-label text-primary">Address</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea readonly class="form-control-plaintext custom-readonly-input" id="emergency_address" rows="1"><?php echo $emergency_address; ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
