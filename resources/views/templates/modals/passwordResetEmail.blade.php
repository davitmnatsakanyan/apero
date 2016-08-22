<div ng-controller="AuthController">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h4 class="modal-title">Reset password</h4>
        </div>
        <div class="modal-body">
            <form>
                <label>Enter your email</label>
                <input  name='email' ng-model="email"/>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">Reset password</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>