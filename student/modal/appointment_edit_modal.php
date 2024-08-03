<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $appointment_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_<?php echo $appointment_id; ?>" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel_<?php echo $appointment_id; ?>">
                        <i class="fas fa-pen-to-square fa-sm"></i> Edit Appointment
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?php echo $appointment_id; ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
                        <div class="row form-group">
                            <div class="col-4">
                                <label class="control-label modal-label" for="appointment_no_<?php echo $appointment_id; ?>">Appointment No.</label>
                            </div>
                            <div class="col-8">
                                <p class="text-primary custom-input-text"><?php echo $appointment_no; ?></p>
                            </div>
                        </div>
                        <hr class="">
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="appointment_date_<?php echo $appointment_id; ?>">Appointment Date</label>
                            </div>
                            <div class="col-12">
                                <input class="form-control" id="appointment_date_<?php echo $appointment_id; ?>" name="appointment_date" type="date" required value="<?php echo $appointment_date; ?>">
                                <div class="invalid-feedback">
                                    Please choose a valid Appointment Date.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3" id="descriptionDiv_<?php echo $appointment_id; ?>">
                            <div class="col-sm-12">
                                <label class="control-label modal-label" for="appointment_description_<?php echo $appointment_id; ?>">Appointment Description</label>
                            </div>
                            <div class="col-sm-12">
                                <select name="appointment_description" class="form-control form-select custom-select" id="appointment_description_<?php echo $appointment_id; ?>" required>
                                   <!-- <option value="" disabled selected>Select a description or reason</option> -->
                                   <option value="Medical Checkup" <?php echo $appointment_description == 'MEDICAL CHECKUP' ? 'selected' : ''; ?>>Medical Checkup</option>
                                   <option value="Medical Consultation" <?php echo $appointment_description == 'MEDICAL CONSULTATION' ? 'selected' : ''; ?>>Medical Consultation</option>
                                   <option value="Dental Checkup" <?php echo $appointment_description == 'DENTAL CHECKUP' ? 'selected' : ''; ?>>Dental Checkup</option>
                                   <option value="Dental Consultation" <?php echo $appointment_description == 'DENTAL CONSULTATION' ? 'selected' : ''; ?>>Dental Consultation</option>
                                   <option value="Others" <?php echo $appointment_description == 'OTHERS' ? 'selected' : ''; ?>>Others</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please choose a Description or Reason.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3 <?php echo ($appointment_description == 'OTHERS') ? '' : 'd-none'; ?>" id="descriptionDivOthers_<?php echo $appointment_id; ?>">
                            <div class="col-12">
                                <label class="control-label modal-label" for="appointment_description_others_<?php echo $appointment_id; ?>">Please Input Other Appointment Description</label>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" id="appointment_descriptionOthers_<?php echo $appointment_id; ?>" name="appointment_description_others" <?php echo ($appointment_description == 'OTHERS') ? 'required' : ''; ?>><?php echo $appointment_description_others; ?></textarea>
                                <div class="invalid-feedback">
                                    Please input a valid Description or Reason.
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary" id="updateAppointment_<?php echo $appointment_id; ?>">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
   