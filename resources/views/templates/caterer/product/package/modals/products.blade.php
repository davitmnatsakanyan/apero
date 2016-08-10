{{--<div class="modal fade" >--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" ng-click="close(false)" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                {{--<h4 class="modal-title">Edit cooking time</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<form>--}}
                    {{--<div data-ng-repeat="subroduct in product.subproducts">--}}
                        {{--<label> <% subroduct.name %></label>--}}
                        {{--<input type="radio" ng-model="selectedSubproduct" ng-value="subroduct" name="subroduct">--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" ng-click="modalCancelSubproduct()" class="btn btn-default" data-dismiss="modal">No</button>--}}
                {{--<button type="button" ng-click="modalAddSubproduct()" class="btn btn-primary" data-dismiss="modal">Yes</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div ng-controller="CatererPackageController">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">I'm a modal!</h3>
        </div>
        <div class="modal-body">

            <form>
            <div data-ng-repeat="subroduct in product.subproducts">
            <label> <% subroduct.name %></label>
            <input type="radio" ng-model="selected.item" ng-value="subroduct" name="subroduct">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>