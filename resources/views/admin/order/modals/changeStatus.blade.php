<!-- Modal -->
<div class="modal fade" id="changeOrderStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change status</h4>
            </div>
            <div class="modal-body">
                <form id="changeStatus" action="{{ url('caterer/order/change-status'  )}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form_group">
                        <label>Status</label><br/>
                            <label class="radio-inline">
                                <input name="status" id="Idle" value="0" type="radio" > Idle
                            </label>
                            <label class="radio-inline">
                                <input name="status" id="Processing" value="1"  type="radio" > Processing
                            </label>
                            <label class="radio-inline">
                                <input name="status" id="Shipping" value="2" type="radio"> Shipping
                            </label>
                            <label class="radio-inline">
                                <input name="status" id="Complete" value="3" type="radio"> Complete
                            </label>
                            <label class="radio-inline">
                                <input name="status" id="Deleted" value="4" type="radio"> Deleted
                            </label>
                            <label class="radio-inline">
                                <input name="status" id="Denied" value="5" type="radio"> Denied
                            </label>

                        <input type="hidden" name="order_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                <button type="submit" class="btn btn-primary" form="changeStatus">Update</button>
            </div>
        </div>
    </div>
</div>
