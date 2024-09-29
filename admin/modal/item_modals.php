<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $item_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_<?php echo $item_id; ?>" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel_<?php echo $item_id; ?>">
                        <i class="fas fa-pen-to-square fa-sm"></i> Edit Item
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?php echo $item_id; ?>">
                <div class="modal-body">
                    <div class="container-fluid">

                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" required>
                        <input type="hidden" name="quantity_in_stock_old" value="<?php echo $quantity_in_stock; ?>" required>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" required>

                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="item_name_<?php echo $item_id; ?>">Item Name</label>
                            </div>
                            <div class="col-12">
                                <input class="form-control" id="item_name_<?php echo $item_id; ?>" name="item_name" type="text" required value="<?php echo $item_name; ?>">
                                <div class="invalid-feedback">
                                    Please input a valid Item Name.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="item_description_<?php echo $item_id; ?>">Item Description</label>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" id="item_description_<?php echo $item_id; ?>" name="item_description" required><?= $description ?></textarea>
                                <div class="invalid-feedback">
                                    Please input a valid Item Description.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="quantity_in_stock_<?php echo $item_id; ?>">Item Stock Quantity</label>
                            </div>
                            <div class="col-12">
                                <input class="form-control" id="quantity_in_stock_<?php echo $item_id; ?>" name="quantity_in_stock" type="number" required value="<?php echo $quantity_in_stock; ?>">
                                <div class="invalid-feedback">
                                    Please input a valid Item Stock Quantity.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="unit_<?php echo $item_id; ?>">Unit (ml, mg, etc.)</label>
                            </div>
                            <div class="col-12">
                                <input class="form-control" id="unit_<?php echo $item_id; ?>" name="unit" type="text" required value="<?php echo $unit; ?>">
                                <div class="invalid-feedback">
                                    Please input a valid Unit.
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-12">
                                <label class="control-label modal-label" for="expiry_date_<?php echo $item_id; ?>">Expiry Date</label>
                            </div>
                            <div class="col-12">
                                <input class="form-control" id="expiry_date_<?php echo $item_id; ?>" name="expiry_date" type="date" required value="<?php echo $expiry_date; ?>">
                                <div class="invalid-feedback">
                                    Please select a valid Expiry Date.
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary" id="updateItem_<?php echo $item_id; ?>">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
