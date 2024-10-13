<!-- Edit -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2">
            		<h4 class="modal-title float-left text-success" id="myModalLabel">
            			<i class="fas fa-plus fa-sm"></i> New Admin
            		</h4>
            	</div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
	            <div class="modal-body">
					<div class="container-fluid">

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="no">Employee No.</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="no" name="no" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Employee No.
							    </div>
							</div>
						</div>
						
						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="first_name">First Name</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="first_name" name="first_name" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid First Name.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="middle_name">Middle Name</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="middle_name" name="middle_name" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Middle Name.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="last_name">Last Name</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="last_name" name="last_name" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Last Name.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="suffix_name">Name Suffix</label>
							</div>
							<div class="col-sm-12">
								<select name="suffix_name" class="form-control form-select custom-select" id="suffix_name" required>
                                   <option value="na" selected>N/A</option>
                                   <option value="JR">JR</option>
                                   <option value="SR">SR</option>
                                   <option value="II">II</option>
                                   <option value="III">III</option>
                                   <option value="IV">IV</option>
                                   <option value="V">V</option>
                                </select>
                                <div class="invalid-feedback">
							    	Please choose a Valid Name Suffix.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="contact_no">Contact No.</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="contact_no" name="contact_no" type="number" required>
							    <div class="invalid-feedback">
							    	Please input a valid Contact No.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="email">Email</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="email" name="email" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Email.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="occupation">Occupation</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="occupation" name="occupation" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Occupation.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="password">Password</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="password" name="password" type="password" required>
							    <div class="invalid-feedback">
							    	Please input a valid Password.
							    </div>
							</div>
						</div>

						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="confirm_password">Confirm Password</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="confirm_password" name="confirm_password" type="password" required>
							    <div class="invalid-feedback">
							    	Please input a valid Password.
							    </div>
							</div>
						</div>

		            </div> 
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" name="edit" class="btn btn-success" id="addAdmin">Save Admin</button>
	            </div>
            </form>
        </div>
    </div>
</div>
