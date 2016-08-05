<div class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close(false)" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit cooking time</h4>
            </div>
            <div class="modal-body">
                <form>
                    <label>Time</label>
                    <input name="<% editCooking.group %>" value="<% editCooking.time %>" ng-model = "editCooking.time">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" ng-click="close(false)" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" ng-click="close(true)" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
