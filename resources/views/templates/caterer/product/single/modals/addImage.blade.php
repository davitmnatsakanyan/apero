<div ng-controller="CatererProductsController">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Select image for product</h3>
        </div>
        <div class="modal-body">

            <div flow-init="{
            singleFile: true, testChunks: true,
            query: { '_token':  '{{ csrf_token() }}', 'path': 'images\\products'}
             }"
                 flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]"
                 flow-files-submitted="$flow.submit( $files, $event, $flow )"
                 flow-file-success="setFileName($flow.files)">


                <input type="file" flow-btn name="avatar"/>
                <div class="cater-pic" ng-hide="$flow.files.length">
                    <img class="ithumbnail" src="../images/restaurant-pic.png"/>
                </div>
                <div class="cater-pic" ng-show="$flow.files.length">
                    <img class="ithumbnail" flow-img="$flow.files[0]"/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" ng-click="submit($files, $event, $flow)">OK</button>
                    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
                </div>
            </div>
         </div>
    </script>
</div>