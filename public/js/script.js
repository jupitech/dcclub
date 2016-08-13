var DCApp= angular.module('DCApp', ['ngRoute', 'ngCookies','ngAnimate','ngResource', 'ngSanitize','ui.bootstrap','angularMoment']);
DCApp.config(function($locationProvider) {
       $locationProvider.html5Mode({
			  enabled: true,
			  requireBase: false
			});
     });
DCApp.controller('CheckinCtrl',function($location,$scope, $http, $timeout, $log,$uibModal){
	    $scope.api_token = $location.search().api_token;
	    $scope.paquete_id = $location.search().paquete;
	    console.log('Token:',$scope.api_token);
	    console.log('Paquete ID:',$scope.paquete_id);

      $http.get('/api/checkin/user/'+ $scope.api_token).success(

              function(midato) {
                        $scope.midato = midato.datos;
                        $scope.miid=midato.datos.id;
            }).error(function(error) {
                 $scope.error = error;
            });
            
        $http.get('/api/checkin/paquete/'+ $scope.paquete_id).success(

              function(mipaquete) {
                        $scope.mipaquete = mipaquete.datos;

            }).error(function(error) {
                 $scope.error = error;
            });      
});