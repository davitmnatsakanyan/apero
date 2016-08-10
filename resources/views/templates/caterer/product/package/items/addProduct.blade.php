<div ng-controller="CatererPackageController" >

        <label for="zip_codes" class="title fmlbold fz17">Zip Codes</label>
        <ui-select multiple ng-model="selectedProduct" class="selectpicker form-control"
                   on-remove="removeProduct($item, $model)" on-select="addProduct($item, $model)">
            <ui-select-match placeholder="Select products"><% $item.name %></ui-select-match>
            <ui-select-choices repeat="product in addingProducts track by product.id">
                <% product.name %>
            </ui-select-choices>
        </ui-select>

    {{--<div ng-if="selectedProducts.length">--}}
        <form id="addProduct">
        <div data-ng-repeat="selectedProduct in filteredSelectedProducts track by $index">
            <label><% selectedProduct.name %></label>
            <input type="number" name="products[]" ng-model="selectedProduct.product_count" value="selectedProduct.product_count">
        </div>
        </form>
    <div ng-include='"templates/caterer/product/package/modals/products.blade.php"'></div>
        <ul uib-pagination ng-model="currentSelectedProductsPage"
            total-items="selectedProducts.length"
            max-size="selectedMaxSize"
            boundary-links="true"
            items-per-page="numPerPageForSelected"
            ng-show="currentSelectedProductsPage">
        </ul>
        <button type="submit" form="addProduct" ng-click="addProductsToPackage()" ng-if="location=='edit'">Add</button>
    {{--</div>--}}



</div>