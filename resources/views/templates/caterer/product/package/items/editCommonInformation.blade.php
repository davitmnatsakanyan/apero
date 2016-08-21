<div flow-init="{
            singleFile: true, testChunks: true,
            query: { '_token':  '{{ csrf_token() }}', 'path': 'images\\packages'}
             }"
     flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
     flow-files-submitted="$flow.update( $files, $event, $flow )"
     flow-file-success="setFileName($flow.files)">

<form id="editCommon">

    <label for="packageImage">
        <div class="inputfile-label wdth228 mt20">Upload Image</div>
    </label>
    <input type="file" flow-btn name="avatar" class="inputfile" id="packageImage"/>
        {{--<input type="file" flow-btn name="avatar"/>--}}

        <div class="cater-pic caterer-pic-width" ng-hide="$flow.files.length">
            <img class="cater-pic-width image-size"  ng-src="../images/packages/<% package.avatar %>" alt="no picture"/>
        </div>

        <div class="cater-pic caterer-pic-width" ng-show="$flow.files.length">
            <img class="cater-pic-width image-size" flow-img="$flow.files[0]" />
        </div>

    <div class="profil-form fl mt30">
        <div class="info-box">
            <label for="company" class="title fmlbold add-product-label  fz17">Name</label>
            <input type="text" class="text fmlreg fz13" id="company" ng-model="package.name"/>
        </div><!--end-->
    </div><!--end-->

    <div class="profil-form fl mt30">
        <div class="info-box">
            <label for="city" class="title fmlbold  add-product-label fz17">Price</label>
            <input type="text" class="text fmlreg fz13" id="city" ng-model="package.price"/>
        </div><!--end-->
    </div><!--end-->
</form>
<div class="clear-both"></div>
<div class="profile-border-box">
    <div class="profil-border"></div>
</div>
<div class="save-btn package-save-package" ng-if="location!=='add'">
    <input form="editCommon" type="submit" value="Save" class="fmlreg fz25" ng-click="update('edit',$files, $event, $flow)"/>
</div>'

<div class="save-btn" ng-if="location==='add'">
    <input form="editCommon" type="submit" value="Save" class="fmlreg fz25" ng-click="update('add',$files, $event, $flow)"/>
</div>
</div>