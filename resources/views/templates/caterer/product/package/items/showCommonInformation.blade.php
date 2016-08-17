<h1> <% package.name %></h1>
<div class="table-responsive">
    <div class="caterer-pic-width" ng-hide="$flow.files.length">
        <img class="ithumbnail"  src="images/packages/<% package.avatar %>" , alt="Mountain View" />
    </div>
    <table class="table table-bordered table-striped table-hover mt20">
        <tbody>
        <tr>
            <th>ID</th>
            <td><% package.id %></td>
        </tr>
        <tr>
            <th> Name</th>
            <td><% package.name %> </td>
        </tr>
        <tr>
            <th>Price (EUR)</th>
            <td><% package.price %></td>
        </tr>
        </tbody>
    </table>
</div>