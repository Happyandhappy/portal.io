<div class="modal fade" id="exchange_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title hide">Edit Item</span>
                    <span class="add-title">Add New Item</span>
                </h4>
            </div>
            <form action="<?php echo admin_url('exchange/add'); ?>" id="exchange_form" method="post" accept-charset="utf-8">            
              <input type="hidden" name="itemid" id="itemid" value="">
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">                          
                          <div class="form-group" app-field-wrapper="name">
                            <label for="name" class="control-label"> 
                              <small class="req text-danger">* </small>Name
                            </label>
                            <input type="text" id="name" name="name" class="form-control" value="" required="">
                          </div>                        
                          <div class="form-group" app-field-wrapper="description">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                          </div>                        
                      </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Save</button>
              </div>
            </form>
        </div>
    </div>
</div>