app.controller('OrderController', ['$scope', function ($scope) {
    
    $('#datetimepicker4').datetimepicker();

    $scope.datas = [
        {type: 'text', class: 'form-group', label: 'Firma', placeholder: 'Arnold'},
        {type: 'text', class: 'form-group', label: 'Vorname', placeholder: 'Tempees'},
        {type: 'text', class: 'form-group', label: 'Names', placeholder: 'Vorname'},
        {type: 'text', class: 'form-group', label: 'Strasse', placeholder: 'Lorem Ipsum'},
        {type: 'email', class: 'form-group', label: 'PLZ', placeholder: 'tempees@tempees.com'},
        {type: 'text', class: 'form-group', label: 'ort', placeholder: 'Fifth Avenue'},
    ];

}]);
