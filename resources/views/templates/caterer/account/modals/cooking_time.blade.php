<div ng-controller="CatererProfileController">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h4 class="modal-title">Edit cooking time</h4>
        </div>
        <div class="modal-body">
            <form>
                <label>Time</label>
                <input name="<% editCooking.group %>" value="<% editCooking.time %>"
                       ng-model="editCooking.time">
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>
