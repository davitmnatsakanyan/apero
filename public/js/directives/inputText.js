app.directive('inputText', function () {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: 'templates/input.html',
        link: function (scope, element, attribute) {
            scope.class = attribute.class;
            scope.label = attribute.label;
            scope.placeholder = attribute.placeholder;
            scope.type = attribute.type;
        }
    };
});
