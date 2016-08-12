<div ng-controller="CatererProductsController">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Subroduct name</th>
                <th>Subroduct pice</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="subproduct in filteredSubproducts">
                <td><% (currentSubproductsPage-1)*numPerPageForSubproducts+$index+1  %></td>
                <td><% subproduct.name  %>  </td>
                <td><% subproduct.price %></td>
            </tr>
            </tbody>
        </table>
    </div>
    <ul uib-pagination ng-model="currentSubproductsPage"
        total-items="subproducts.length"
        max-size="subproductsMaxSize"
        boundary-links="true"
        items-per-page="numPerPageForSubproducts"
        ng-show="currentSubproductsPage">
    </ul>
</div>

{{--product.subproduct ? " " + product.subproduct.name:""--}}