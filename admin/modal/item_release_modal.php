<!-- Edit -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-success" id="myModalLabel">
                        <i class="fas fa-plus fa-sm"></i> Release Item
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="released_by" value="<?php echo $user_id; ?>" required readonly>
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="item_name">Item</label>
                            </div>
                            <div class="col-12">
                                <select class="" id="item_name" name="item_id" required></select>
                                <div class="invalid-feedback">
                                    Please select an Item.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-sm-12">
                                <label class="control-label modal-label" for="quantity_released">Quantity to Release</label>
                            </div>
                            <div class="col-sm-12">
                                <input class="form-control" id="quantity_released" name="quantity_released" type="number" required>
                                <div class="invalid-feedback">
                                    Please input a valid Quantity to Release.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
						    <div class="col-12">
						        <label class="control-label modal-label" for="released_type">Recipient Type</label>
						    </div>
						    <div class="col-12">
						        <select class="form-control custom-select" id="released_type" name="released_type" required>
						        	<option value="" selected disabled>Select recipient type</option>
						        	<option value="student">Student</option>
						        	<option value="employee">Employee</option>
						        </select>
						        <div class="invalid-feedback">
						            Please select a Recipient Type.
						        </div>
						    </div>
						</div>
                        <div class="row form-group mb-3">
						    <div class="col-12">
						        <label class="control-label modal-label" for="released_to">Release To</label>
						    </div>
						    <div class="col-12">
						        <select class="" id="released_to" name="released_to" required></select>
						        <div class="invalid-feedback">
						            Please select a Recipient.
						        </div>
						    </div>
						</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success" id="ReleaseItem">Release Item</button>
                </div>
            </form>
        </div>
    </div>
</div>