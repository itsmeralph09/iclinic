<!-- Edit -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="row float-left ml-2">
            		<h4 class="modal-title float-left text-success" id="myModalLabel">
            			<i class="fas fa-plus fa-sm"></i> New Item
            		</h4>
            	</div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
	            <div class="modal-body">
					<div class="container-fluid">
						<input type="hidden" name="added_by" value="<?php echo $user_id; ?>" required readonly>
						<div class="row form-group mb-3">
							<div class="col-12">
								<label class="control-label modal-label" for="item_name">Item Name</label>
							</div>
							<div class="col-12">
								<input class="form-control" id="item_name" name="item_name" type="text" required>
							    <div class="invalid-feedback">
							    	Please input a valid Item Name.
							    </div>
							</div>
						</div>
						<div class="row form-group mb-3">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="item_description">Item Description</label>
							</div>
							<div class="col-sm-12">
								<textarea class="form-control" id="item_description" name="item_description" required></textarea>
                                <div class="invalid-feedback">
							    	Please input a valid Item Description.
							    </div>
							</div>
						</div>
						<div class="row form-group mb-3">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="quantity_in_stock">Item Stock Quantity</label>
							</div>
							<div class="col-sm-12">
								<input class="form-control" id="quantity_in_stock" name="quantity_in_stock" type="number" required>
                                <div class="invalid-feedback">
							    	Please input a valid Item Stock Quantity.
							    </div>
							</div>
						</div>
						<div class="row form-group mb-3">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="unit">Unit (ml, mg, etc.)</label>
							</div>
							<div class="col-sm-12">
								<input class="form-control" id="unit" name="unit" type="text" required>
                                <div class="invalid-feedback">
							    	Please input a valid Unit.
							    </div>
							</div>
						</div>
						<div class="row form-group mb-3">
							<div class="col-sm-12">
								<label class="control-label modal-label" for="expiry_date">Expiry Date</label>
							</div>
							<div class="col-sm-12">
								<input class="form-control" id="expiry_date" name="expiry_date" type="date" required>
                                <div class="invalid-feedback">
							    	Please select a valid Expiry Date.
							    </div>
							</div>
						</div>

		            </div> 
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" name="edit" class="btn btn-success" id="addItem">Save Item</button>
	            </div>
            </form>
        </div>
    </div>
</div>
