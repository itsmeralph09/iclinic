<!-- Edit -->
<div class="modal fade" id="vitals_<?php echo $appointment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_<?php echo $appointment_id; ?>" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel_<?php echo $appointment_id; ?>">
                        <i class="fa-solid fa-heart-pulse"></i> Set Vitals
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
                                <label class="control-label modal-label">Occupation</label>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-primary custom-input-text"><?php echo $occupation; ?></p>
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
                                <p class="text-primary custom-input-text"><?php echo $appointment_date; ?></p>
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
                        <hr class="my-0">
                        <p class="text-uppercase text-center font-weight-bold my-1">Patients Vital Information & Diagnosis</p>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group mb-3">
                                    <div class="col-sm-4">
                                        <label class="control-label modal-label" for="appointment_blood_pressure_<?php echo $appointment_id; ?>">Blood Pressure</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="appointment_blood_pressure_<?php echo $appointment_id; ?>" name="appointment_blood_pressure" value="" required>
                                        <div class="invalid-feedback">
                                            Please input a valid Blood Pressure
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group mb-3">
                                    <div class="col-sm-4">
                                        <label class="control-label modal-label" for="appointment_temperature_<?php echo $appointment_id; ?>">Temperature</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="appointment_temperature_<?php echo $appointment_id; ?>" name="appointment_temperature" value="" >
                                        <div class="invalid-feedback">
                                            Please input a valid Temperature
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group mb-3">
                                    <div class="col-sm-4">
                                        <label class="control-label modal-label" for="appointment_weight_<?php echo $appointment_id; ?>">Weight (kg)</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="appointment_weight_<?php echo $appointment_id; ?>" name="appointment_weight" value="" >
                                        <div class="invalid-feedback">
                                            Please input a valid Weight
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group mb-3">
                                    <div class="col-sm-4">
                                        <label class="control-label modal-label" for="appointment_height_<?php echo $appointment_id; ?>">Height (cm)</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="appointment_height_<?php echo $appointment_id; ?>" name="appointment_height" value="" >
                                        <div class="invalid-feedback">
                                            Please input a valid Height
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label" for="appointment_diagnosis_<?php echo $appointment_id; ?>">Diagnosis</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea type="number" class="form-control" id="appointment_diagnosis_<?php echo $appointment_id; ?>" name="appointment_diagnosis" value="" required></textarea>
                                <div class="invalid-feedback">
                                    Please input a valid Diagnosis
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary" id="completeAppointment_<?php echo $appointment_id; ?>">Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>
   