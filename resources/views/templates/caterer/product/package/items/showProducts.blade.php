<div ng-controller="CatererPackageController">
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Product</th>
            <th>Product Count</th>
        </tr>
        </thead>
        <tbody>
            <tr ng-repeat="product in filteredPackageProducts">
                <td><% (currentPackageProductsPage-1)*numPerPageForPackageProducts+$index+1  %></td>
                <td><% product.name +(product.subroduct ? " " + product.subroduct.name : "" ) %>  </td>
                <td><% product.pivot.product_count %></td>
            </tr>
        </tbody>
    </table>
</div>
<ul uib-pagination ng-model="currentPackageProductsPage"
    total-items="package.products.length"
    max-size="packageProductsMaxSize"
    boundary-links="true"
    items-per-page="numPerPageForPackageProducts"
    ng-show="currentPackageProductsPage">
</ul>
</div>

{{--product.subproduct ? " " + product.subproduct.name:""--}}