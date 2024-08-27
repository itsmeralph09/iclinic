<!-- Edit -->
<div class="modal fade" id="vitalsview_<?php echo $appointment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_<?php echo $appointment_id; ?>" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel_<?php echo $appointment_id; ?>">
                        <i class="fa-solid fa-eye"></i> View Completed Appointment Info
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?php echo $appointment_id; ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" class="form-control" name="appointment_id" value="<?php echo $appointment_id; ?>">
                        <hr class="my-0">
                        <p class="text-uppercase text-center font-weight-bold my-1">Appointment Information</p>
                        <hr class="mt-0">
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Name</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $fullname; ?></p>
                            </div>
                        </div>
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Course & Year</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $course_year; ?></p>
                            </div>
                        </div>
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Appointment No.</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $appointment_no; ?></p>
                            </div>
                        </div>
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Appointment Date</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $formatted_date; ?></p>
                            </div>
                        </div>
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Appointment Description</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $appointment_description_text; ?></p>
                            </div>
                        </div>
                        <div class="row form-group mb-0">
                            <div class="col-sm-6">
                                <label class="control-label modal-label">Date Completed</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $formatted_date_completed; ?></p>
                            </div>
                        </div>
                        <hr class="my-0">
                        <p class="text-uppercase text-center font-weight-bold my-1">Patients Vital Information & Diagnosis</p>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group mb-0">
                                    <div class="col-sm-5">
                                        <label class="control-label modal-label">Blood Pressure</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-primary custom-input-text"><?php echo $blood_pressure; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group mb-0">
                                    <div class="col-sm-5">
                                        <label class="control-label modal-label">Temperature</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-primary custom-input-text"><?php echo $temperature; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group mb-0">
                                    <div class="col-sm-5">
                                        <label class="control-label modal-label">Weight (kg)</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-primary custom-input-text"><?php echo $weight; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group mb-0">
                                    <div class="col-sm-5">
                                        <label class="control-label modal-label">Height (cm)</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-primary custom-input-text"><?php echo $height; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group mb-0">
                                    <div class="col-sm-5">
                                        <label class="control-label modal-label">Diagnosis</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-primary custom-input-text"><?php echo $diagnosis; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary" id="printAppointment_<?php echo $appointment_id; ?>">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
   