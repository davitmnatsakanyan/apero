<div ng-controller="EditProductController">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Edit Subproduct</h3>
        </div>
        <div class="modal-body">

            <form>
                <label for="name">Name</label>
                <input name="name" type="text" ng-model="subproduct.name"/><br/>
                <label for="price">Price</label>
                <input name="price" type="number" ng-model="subproduct.price"/>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>