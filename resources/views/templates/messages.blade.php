<div class="error_message alert alert-danger alert-dismissible" role="alert" ng-if="errors">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p ng-repeat="error in errors"><% error %></p>
</div>
