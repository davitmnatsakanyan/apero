<form id="addProduct">
    <ui-select ng-model="addingProduct.kitchen" class="selectpicker form-control" on-select="selectKitchen($item, $model)">
        <ui-select-match placeholder="Select kitchen"><% $item.name %></ui-select-match>
        <ui-select-choices repeat="kitchen in allKitchens track by kitchen.id">
            <% kitchen.name %>
        </ui-select-choices>
    </ui-select>

    <ui-select ng-model="addingProduct.menu" class="selectpicker form-control" on-select="selectMenu($item, $model)">
        <ui-select-match placeholder="Select menu"><% $item.name %></ui-select-match>
        <ui-select-choices repeat="menu in allMenus track by menu.id">
            <% menu.name %>
        </ui-select-choices>
    </ui-select>


    <div flow-init
         {{--flow-files-submitted="$flow.upload()"--}}
         flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
         flow-file-success="$file.msg = $message">

        <input type="file" flow-btn name="avatar"/>
        <div class="cater-pic caterer-pic-width" ng-show="$flow.files.length">
            <img class="ithumbnail cater-pic-width" flow-img="$flow.files[0]" />
        </div>

    </div>
    </div>
    <div class="profil-form fl">
        <div class="info-box">
            <label for="company" class="title fmlbold fz17">Name</label>
            <input type="text" class="text fmlreg fz13" id="name" ng-model="addingProduct.name"/>
        </div><!--end-->
    </div><!--end-->

    <div class="profil-form fl">
        <div class="info-box">
            <label for="city" class="title fmlbold fz17">Ingredients</label>
            <input type="textarea" class="text fmlreg fz13" id="ingredients" ng-model="addingProduct.ingredients"/>
        </div><!--end-->
    </div><!--end-->

    <div class="profil-form fl" ng-if="addingProduct.customize.length==0">
        <div class="info-box">
            <label for="city" class="title fmlbold fz17">Price</label>
            <input type="text" class="text fmlreg fz13" id="ingredients" ng-model="addingProduct.price"/>
        </div><!--end-->
    </div><!--end-->

</form>

<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>
<div ng-if = "addingProduct.customize.length==0">
    <button ng-click = "customize()">Customize</button>
</div>

<div class="save-btn">
    <input form="addProduct" type="submit" value="Save" class="fmlreg fz25" ng-click="createProduct()"/>
</div>