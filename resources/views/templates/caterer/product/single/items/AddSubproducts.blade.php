<div ng-controller="CatererProductsController">
    <button ng-click="add()" class="add-button">Add</button>

    <form>
            <div ng-repeat="customize in filteredCustomize">
                <div class="profil-form fl no-margin no-margin-top no-margin-bottom">
                    <div class="info-box">
                        <label for="name" class="title fmlbold fz17">Name</label>
                        <input type="text" class="text fmlreg fz13" id="name"
                               ng-model= "customize.name"/>
                        <label for="price" class="title fmlbold fz17">Price</label>
                        <input type="text" class="text fmlreg fz13" id="price"
                               ng-model= "customize.price"/>
                        <button  class="btn btn-danger btn-xs" ng-click="remove((currentCustomizePage-1)*numPerPageForCustomize+$index)">
                            <span class="glyphicon glyphicon-minus" aria-hidden="true"/></button>
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

