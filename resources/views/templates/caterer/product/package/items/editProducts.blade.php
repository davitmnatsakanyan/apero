<div ng-controller="CatererPackageController">
    <div class="table-responsive cooking-time">
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
                        <input type="number" name="product_count" ng-model="product.pivot.product_count"/>
                    </form>
                </td>
                <td>
                    <button class="btn btn-primary btn-xs" title="Edit product count"
                            ng-click="updateProductCount(product.pivot.product_id,product.pivot.subproduct_id)">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
                    </button>
                    {{--<input form="editCount" type="submit" value="Edit" ng-click="updateProductCount(product.pivot.product_id,product.pivot.subproduct_id)"/>--}}
                    <button type="submit" class="btn btn-danger btn-xs"  ng-click="removeProductFromPackage(product.pivot.product_id,product.pivot.subproduct_id)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Remove product" /></button>
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
