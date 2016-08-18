var DCApp= angular.module('DCApp', ['ngRoute', 'ngCookies','ngAnimate','ngResource', 'ngSanitize','ui.bootstrap','angularMoment',,'nya.bootstrap.select']);
DCApp.config(function($locationProvider) {
       $locationProvider.html5Mode({
			  enabled: true,
			  requireBase: false
			});
     });
DCApp.directive("forceMaxlength", [function() {
   return {
     restrict: "A",
     link: function(scope, elem, attrs) {
       var limit = parseInt(attrs.mdMaxlength);
       angular.element(elem).on("keydown", function() {
         if (this.value.length >= limit) {
           this.value = this.value.substr(0,limit-1);
           return false;
         }
       });
     }
   }
 }]);
DCApp.controller('CheckinCtrl',function($location,$scope, $http, $timeout, $log,$uibModal){
	    $scope.api_token = $location.search().api_token;
	    $scope.paquete_id = $location.search().paquete;
	    console.log('Token:',$scope.api_token);
	    console.log('Paquete ID:',$scope.paquete_id);
     $scope.paises=[
        {pais:'Guatemala'},
        {pais:'El Salvador'},
        {pais:'Honduras'}
        ];
      $scope.ciudades=[
        {pais:'Guatemala', ciudad:'Guatemala'},
        {pais:'Guatemala', ciudad:'Escuintla'},
        {pais:'Guatemala', ciudad:'Santa Rosa'},
        {pais:'Guatemala', ciudad:'Chimaltenango'},
        {pais:'Guatemala', ciudad:'El Progreso'},
        {pais:'El Salvador', ciudad:'San Salvador'},
        {pais:'El Salvador', ciudad:'La Libertad'},
        {pais:'El Salvador', ciudad:'Chalatenango'},
        {pais:'Honduras', ciudad:'Distrito Central'},
        {pais:'Honduras', ciudad:'San Pedro Sula'},
        {pais:'Honduras', ciudad:'Choloma'}
      ];
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

      $scope.enviarCompra=function(){
      $notarjeta=$scope.usuario.notarjeta;
      $cvv=$scope.usuario.cvvtarjeta;
      $aa=$scope.usuario.aniotarjeta;
      $mm=$scope.usuario.mestarjeta;
      $tarp1=$notarjeta.slice( -16,-12 );
      $tarp2=$notarjeta.slice( -12,-8 );
      $tarp3=$notarjeta.slice( -8,-4 );
      $tarp4=$notarjeta.slice( 12 );

      $enviotar=$tarp3+''+$cvv+''+$tarp4+''+$aa+''+$tarp1+''+$mm+''+$tarp2;

          var enviadata={
              FirstName:$scope.midato.info_usuario.first_name,
              LastName:$scope.midato.info_usuario.last_name,
              Email:$scope.midato.email,
              Address:$scope.midato.info_usuario.direccion,
              City:$scope.midato.info_usuario.ciudad,
              State:'XX',
              PostCode:'01001',
              Country:$scope.midato.info_usuario.pais,
              CodEnvio: $enviotar
          };
          console.log(enviadata);

                $http.post('api/checkin/envio', enviadata)    
                        .success(function (data, status, headers) {
                                console.log("Datos enviados correctamente");
                           })
                        .error(function (data, status, header, config) {
                            console.log("Parece que hay error al enviar los datos");
                        });

      }    
});