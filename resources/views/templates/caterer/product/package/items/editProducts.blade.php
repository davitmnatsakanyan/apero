<div ng-controller="CatererPackageController">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Product</th>
                <th>Product Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="product in filteredPackageProducts">
                <td><% (currentPackageProductsPage-1) * numPerPageForPackageProducts+$index+1 %></td>
                <td><% product.name +(product.subroduct ? " " + product.subroduct.name : "" ) %></td>
                <td>
                    <form href="#" id="editCount" method="post">
                        <input type="number" name="product" ng-model="product.pivot.product_count">
                    </form>
                </td>
                <td>
                    <input form="editCount" type="submit" value="Edit" ng-click="updateProductCount(product.id)"/>
                </td>
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