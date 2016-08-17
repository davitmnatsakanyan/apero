<div ng-controller="CatererPackageController" >
        <label for="products" class="title fmlbold fz17">Select Products</label>
        <ui-select multiple ng-model="selectedProducts.selected" class="selectpicker form-control"
                   title="Choose a product" on-remove="removeProduct($item, $model)" on-select="addProduct($item, $model)">
            <ui-select-match placeholder="Select products"><% $item.name %></ui-select-match>
            <ui-select-choices repeat="product in addingProducts track by product.id">
                <% product.name %>
            </ui-select-choices>
        </ui-select>
        <form id="addProduct">
        <div data-ng-repeat="selectedProduct in filteredSelectedProducts track by $index" class="info-box">
            <label class="title fmlbold fz15 add-product-label packages-label"><% selectedProduct.name %></label>
            <input type="number" class="text fmlreg fz13" name="products[]" ng-model="selectedProduct.product_count" value="selectedProduct.product_count">
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

</div>
<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>
<div class="save-btn">
    <input form="addProduct" type="submit" value="Save" class="fmlreg fz25" ng-click="addProductsToPackage()" ng-if="location=='edit'"/>
</div>