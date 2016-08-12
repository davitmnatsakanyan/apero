<div ng-controller="CatererProductsController">
    <button ng-click="add()">Add</button>

    <form>
            <div ng-repeat="customize in filteredCustomize">
                <div class="profil-form fl">
                    <div class="info-box">
                        <label for="name" class="title fmlbold fz17">Name</label>
                        <input type="text" class="text fmlreg fz13" id="name"
                               ng-model= "customize.name"/>
                        <label for="price" class="title fmlbold fz17">Price</label>
                        <input type="text" class="text fmlreg fz13" id="price"
                               ng-model= "customize.price"/>
                        <button ng-click="remove((currentCustomizePage-1)*numPerPageForCustomize+$index)">Remove</button>
                    </div><!--end-->
                </div><!--end-->
            </div>
    </form>
    <ul uib-pagination ng-model="currentCustomizePage"
        total-items="addingProduct.customize.length"
        max-size="customizeMaxSize"
        boundary-links="true"
        items-per-page="numPerPageForCustomize"
        ng-show="currentCustomizePage">
    </ul>
</div>

