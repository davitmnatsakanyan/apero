<div flow-init="{
            singleFile: true, testChunks: true,
            query: { '_token':  '{{ csrf_token() }}', 'path': 'images\\products'}
             }"
     flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
     flow-files-submitted="$flow.updateProduct( $files, $event, $flow )"
     flow-file-success="setFileName($flow.files)"  class="ml20 mt20">
    <input type="file" flow-btn name="avatar" class="inputfile" id="productImage"/>
    <label for="productImage">
        <div class="inputfile-label wdth228">Upload Image</div>
    </label>
    <div class="cater-pic image-size2" ng-hide="$flow.files.length">
        <img class="cater-pic-width image-size" ng-src="../images/products/<%product.avatar%>" alt="No image"/>
    </div>
    <div class="cater-pic image-size2" ng-show="$flow.files.length">
        <img class="cater-pic-width image-size" flow-img="$flow.files[0]"/>
    </div>
    <form id="addProduct">
        <div class="profil-form fl ml0">
            <div class="info-box">
                <label for="ingredients" class="title fmlbold fz15 ing-label">Ingredients</label>
                {{--<input type="textarea" class="text fmlreg fz13" id="ingredients" ng-model="product.ingredients"/>--}}

                <div class="col-sm-6 no-padding ml9">
                    <textarea rows="3" cols="50" ng-model="caterer.description"
                              class="text fmlreg fz13" ng-model="product.ingredients">
                    </textarea>
                </div>
            </div><!--end-->

        </div>
        <div class="profil-form fl mt212">

            <div class="info-box">
                <label class="title fmlbold fz15">Kitchen</label>
                <ui-select ng-model="product.kitchen" class="fmlreg fz13 mb1"
                           on-select="selectKitchenForEdit($select.selected, $model)">
                    <ui-select-match placeholder="Select kitchen" class="select-zip"><% $select.selected.name %>
                    </ui-select-match>
                    <ui-select-choices repeat="kitchen in allKitchens track by kitchen.id">
                        <% kitchen.name %>
                    </ui-select-choices>
                </ui-select>
            </div>
            <div class="info-box">
                <label class="title fmlbold fz15">Menu</label>
                <ui-select ng-model="product.menu" class="fmlreg fz13 mb1"
                           on-select="selectMenuForEdit($select.selected, $model)">
                    <ui-select-match placeholder="Select menu" class="select-zip"><% $select.selected.name %>
                    </ui-select-match>
                    <ui-select-choices repeat="menu in allMenus track by menu.id">
                        <% menu.name %>
                    </ui-select-choices>
                </ui-select>
            </div>

            <div class="info-box">
                <label for="nem" class="title fmlbold fz15">Name</label>
                <input type="text" class="text fmlreg fz13" id="name" ng-model="product.name"/>
            </div><!--end-->

            <div class="info-box" ng-if="product.subproducts.length==0 && product.cusomize.length!==0">
                <label for="price" class="title fmlbold fz15">Price</label>
                <input type="text" class="text fmlreg fz13" id="price" ng-model="product.price"/>
            </div><!--end-->



        </div><!--end-->


    </form>
    <div class="save-btn product-edit-save">
        <input form="addProduct" type="submit" value="Save" class="fmlreg fz25"
               ng-click="updateProduct($files, $event, $flow)"/>
    </div>
</div>
