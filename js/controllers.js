function HeaderController($scope, $location) 
{ 
    $scope.isActive = function (viewLocation) {
     var active = (viewLocation === $location.path());
     return active;
	};

}