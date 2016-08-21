<div ng-if="addingProduct.customize.length==0">
    <button ng-click="customize()" class="add-button add2">Customize</button>
</div>
<form id="addProduct">
    <div class="profil-form fl">
        <div class="info-box">
            <label class="title fmlbold fz17">Kitchen</label>
            <ui-select ng-model="addingProduct.kitchen" class="fmlreg fz13 mb1"
                       on-select="selectKitchen($select.selected, $model)">
                <ui-select-match placeholder="Select kitchen" class="select-zip"><% $select.selected.name %></ui-select-match>
                <ui-select-choices repeat="kitchen in allKitchens track by kitchen.id">
                    <% kitchen.name %>
                </ui-select-choices>
            </ui-select>
        </div>

        <div class="info-box">
            <label for="company" class="title fmlbold fz15">Name</label>
            <input type="text" class="text fmlreg fz13" id="name" ng-model="addingProduct.name"/>
        </div><!--end-->

        <div class="info-box" ng-if="addingProduct.customize.length==0">
            <label for="city" class="title fmlbold fz15">Price</label>
            <input type="text" class="text fmlreg fz13" id="ingredients" ng-model="addingProduct.price"/>
        </div><!--end-->

    </div>
    <div class="profil-form fl">
        <div class="info-box">
            <label class="title fmlbold fz15">Menu</label>
            <ui-select ng-model="addingProduct.menu" class="fmlreg fz13 mb1"
                       >
                <ui-select-match placeholder="Select menu" class="select-zip"><% $select.selected.name %></ui-select-match>
                <ui-select-choices repeat="menu in allMenus track by menu.id">
                    <% menu.name %>
                </ui-select-choices>
            </ui-select>
        </div>

        <div class="info-box">
            <label for="city" class="title fmlbold fz15">Ingredients</label>
            <input type="textarea" class="text fmlreg fz13" id="ingredients" ng-model="addingProduct.ingredients"/>
        </div><!--end-->
    </div>

</form>

<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>


<div class="save-btn">
    <input form="addProduct" type="submit" value="Save" class="fmlreg fz25" ng-click="createProduct()"/>
</div>

<div ng-include='"templates/caterer/product/single/modals/addImage.blade.php"'></div>