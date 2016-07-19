<!-- Modal -->
<div class="modal fade" id="changeOrderStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change status</h4>
            </div>
            <div class="modal-body">
                <form id="changeStatus" action="{{ url('admin/orders/changeStatus'  )}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form_group">
                        <label>Status</label><br/>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="Idle" value="0"  > Idle
                            </label>
                            <label class="radio-inline">
                                <input  type="radio"  name="status" id="Processing" value="1"  > Processing
                            </label>
                            <label class="radio-inline">
                                <input  type="radio" name="status" id="Shipping" value="2" > Shipping
                            </label>
                            <label class="radio-inline">
                                <input  type="radio" name="status" id="Complete" value="3" > Complete
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="Denied" value="4" > Denied
                            </label>
                    </div>
                    <div class="form_group">
                        <input type="hidden" name="order_id">
                        <input type="hidden" name="status1">
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
