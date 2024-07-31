<!-- Edit -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2">
            		<h4 class="modal-title float-left text-success" id="myModalLabel">
            			<i class="fas fa-plus fa-sm"></i> New Appointment
            		</h4>
            	</div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
	            <div class="modal-body">
					<div class="container-fluid">
						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="appointment_date">Appointment Date</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="appointment_date" name="appointment_date" type="date" required>
							    <div class="invalid-feedback">
							    	Please choose a valid Appointment Date.
							    </div>
							</div>
						</div>
						<div class="row form-group mb-3" id="descriptionDiv">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="appointment_description">Appointment Description</label>
							</div>
							<div class="col-sm-12">
								<select name="appointment_description" class="form-control form-select custom-select" id="appointment_description" required>
                                   <option value="" disabled selected>Select a description or reason</option>
                                   <option value="Medical Checkup">Medical Checkup</option>
                                   <option value="Medical Consultation">Medical Consultation</option>
                                   <option value="Dental Checkup">Dental Checkup</option>
                                   <option value="Dental Consultation">Dental Consultation</option>
                                   <option value="Others">Others</option>
                                </select>
                                <div class="invalid-feedback">
							    	Please choose a Description or Reason.
							    </div>
							</div>
						</div>
						<div class="row form-group d-none mb-3" id="descriptionDivOthers">
							<div class="col-12">
								<label class="control-label modal-label" for="appointment_description_others">Please Input Other Appointment Description</label>
							</div>
							<div class="col-12">
								<textarea class="form-control" id="appointment_description_others" name="appointment_description_others"></textarea>
								<div class="invalid-feedback">
							    	Please input a valid Description or Reason.
							    </div>
							</div>
						</div>
		            </div> 
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" name="edit" class="btn btn-success" id="addAppointment">Save Appointment</button>
	            </div>
            </form>
        </div>
    </div>
</div>
