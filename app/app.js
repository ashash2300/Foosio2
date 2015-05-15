var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = 'services/'
    var obj = {};
    
	obj.calculateRecoveryDate = function (hours) {
	    return $http.post(serviceBase + 'calculateRecoveryDate?hours=' + hours).then(function (status) {
	        return status.data;
	    });
	};

    return obj;   
}]);


app.controller('foosio', function ($scope, $rootScope, $location, $routeParams, services) {
		$scope.calculateRecoveryDate = function(hours) {
        $location.path('/');
        if(hours>0)
        services.calculateRecoveryDate(hours);
      };
});

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      .when('/calculateRecoveryDate/:hours', {
        title: 'calculateRecoveryDate',
        templateUrl: 'partials/foosio.html',
        controller: 'foosio',
        }
      })
      .otherwise({
        redirectTo: '/'
      });
}]);
app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);