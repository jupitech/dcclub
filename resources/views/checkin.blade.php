@extends('layouts.app')

@section('content')
<div class="container">
		      <div class="caja" ng-controller="CheckinCtrl" ng-cloak>

            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                   <span ng-click="close()" class="ico_atras"></span>
                 <a aria-controls="comprar" role="tab" data-toggle="tab"> 
                   
                    <p class="monto">Monto: $ @{{mipaquete.monto_dolar | number:2}} ( @{{mipaquete.tukis_paquete}} TUKIS )</p>
                </a>
             
              </li>
                <!--
              <li role="presentation"><a href="#cobrar" aria-controls="cobrar" role="tab" data-toggle="tab">Cobrar</a></li>
               -->
            </ul>
             <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="comprar">
                 <div class="col-sm-12 spd spi">
                  {{--  <div class="caja_paquete">
                         <div class="col-sm-6 col-xs-6 spd">
                            <div class="col-sm-6 col-xs-6 spd spi">
                              <div ng-if="mipaquete.nombre_paquete" class="ima_tuki" style="background: url('css/img/@{{mipaquete.nombre_paquete}}.png') no-repeat center;"></div>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                              <h3>X @{{mipaquete.tukis_paquete}}</h3>
                            </div>
                         </div>
                         <div class="col-sm-6 col-xs-6">
                              <h4>$  @{{mipaquete.monto_dolar | number:2}}</h4>
                         </div>
                   </div> --}}
                   <div class="caja_tarjeta">
                      
                      <div class="col-sm-12" ng-if="formulario_pago">
                        <form class="form_pago form-horizontal" name="forma" ng-submit="enviarCompra()" >
                              <div class="form-group">
                               
                                     <h3 class="info_user"><strong>Correo </strong> @{{midato.email}}</h3>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-6 col-xs-6">
                                   
                                      <label for="exampleInputPassword1" class="col-sm-12 spd spi">Nombre</label>
                                      <div class="col-sm-12 spd spi">
                                       <input type="text" name="first_name" class="form-control" ng-model="midato.info_usuario.first_name" required>
                                       <div class="men_error" ng-show="forma.first_name.$dirty && forma.first_name.$invalid">
                                        <p>Requerido</p>
                                        </div>
                                      </div>
                                  </div>
                                   <div class="col-sm-6 col-xs-6">
                                   
                                      <label for="exampleInputPassword1" class="col-sm-12 spd spi">Apellido</label>
                                      <div class="col-sm-12 spd spi">
                                       <input type="text" name="last_name" class="form-control" ng-model="midato.info_usuario.last_name" required>
                                       <div class="men_error" ng-show="forma.last_name.$dirty && forma.last_name.$invalid">
                                        <p>Requerido</p>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="col-sm-2 col-xs-2">Dirección</label>
                                    <div class="col-sm-10 col-xs-10">
                                    <input type="text" class="form-control" name="direccionU" ng-model="midato.info_usuario.direccion" placeholder="5 ave. 4-5" required>
                                    <div class="men_error" ng-show="forma.direccionU.$dirty && forma.direccionU.$invalid">
                                        <p>Requerido</p>
                                    </div>
                                    </div>
                               </div>
                               <div class="form-group estilo_drop">
                                    <label for="exampleInputPassword1" class="col-sm-2 col-xs-2">País</label>
                                    <div class="col-sm-10 col-xs-10">
                                    <ol class="nya-bs-select" ng-model="midato.info_usuario.pais" title="Selecciona un pais..." name="paisU"  data-live-search="true" >
                                            <li nya-bs-option="pais in paises" data-value="pais.pais">
                                              <a>
                                                @{{ pais.pais }}
                                              </a>
                                            </li>
                                     </ol>
                                    <div class="men_error" ng-show="forma.paisU.$dirty && forma.paisU.$invalid">
                                        <p>Requerido</p>
                                    </div>
                                    </div>
                               </div>
                                <div class="form-group ">
                                    <label for="exampleInputPassword1" class="col-sm-2 col-xs-2">Depto.</label>
                                     <div class="col-sm-10 col-xs-10">
                                    <input type="text" class="form-control" name="ciudadU" ng-model="midato.info_usuario.ciudad" placeholder="Departamento/Ciudad" required>
                                    <div class="men_error" ng-show="forma.ciudadU.$dirty && forma.ciudadU.$invalid">
                                        <p>El campo es obligatorio.</p>
                                    </div>
                                    </div>
                               </div>


                              <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-2 col-xs-2">Teléfono</label>
                                <div class="col-sm-10 col-xs-10">
                                <input type="number" class="form-control" name="telefonoU" ng-model="midato.info_usuario.telefono" placeholder="55555555" required>
                                <div class="men_error" ng-show="forma.telefonoU.$dirty && forma.telefonoU.$invalid">
                                    <p>El campo es obligatorio.</p>
                                </div>
                                </div>
                              </div>
                             
                              
                              <div class="form-group">
                                 
                                <label for="exampleInputPassword1" class="col-sm-2">N.Tarjeta</label>
                                <div class="col-sm-10 posirela">
                                <input type="text" class="form-control"  name="notarjetaU" ng-model="usuario.notarjeta" placeholder="**** **** **** ****" required minlength="16" maxlength="16" ng-maxlength="16" ng-pattern="/^[0-9]*$/">
                                      <div class="men_error" ng-show="forma.notarjetaU.$dirty && forma.notarjetaU.$invalid">
                                          <p>Requerido, Mínimo 16 números</p>
                                      </div>
                                      <div class="ico_tarjetas">
                                        <ul>
                                            <li class="t_@{{usuario.notarjeta | validacard}}"></li>
                                        </ul>
                                       
                                      </div>
                                </div>

                              </div>
                              <div class="form-group">
                              <div class="col-sm-6 col-xs-6 spd spi">
                                
                                  <label for="exampleInputPassword1" class="col-sm-12">Fecha de Vencimiento</label>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="text"  name="mesU" class="form-control"  ng-model="usuario.mestarjeta"  placeholder="Mes" maxlength="2" ng-maxlength="2" ng-pattern="/^[0-9]*$/" required>
                                   <div class="men_error" ng-show="forma.mesU.$dirty && forma.mesU.$invalid">
                                    <p>Núm.</p>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="text" name="anioU" class="form-control" ng-model="usuario.aniotarjeta" placeholder="Año" maxlength="2" ng-maxlength="2" ng-pattern="/^[0-9]*$/" required>
                                   <div class="men_error" ng-show="forma.anioU.$dirty && forma.anioU.$invalid">
                                    <p>Núm.</p>
                                    </div>
                                  </div>
                                </div>
                            
                                  <div class="col-sm-6 col-xs-6 spd">
                                   
                                      <label for="exampleInputPassword1" class="col-sm-12">Cod. Seguridad</label>
                                      <div class="col-sm-12 ">
                                       <input type="text" name="cvvU" class="form-control" ng-model="usuario.cvvtarjeta" placeholder="CVV" maxlength="3" ng-maxlength="4" ng-pattern="/^[0-9]*$/" required>
                                       <div class="men_error" ng-show="forma.cvvU.$dirty && forma.cvvU.$invalid">
                                        <p>Núm.</p>
                                        </div>
                                      </div>
                                  </div>
                                  
                                </div>
                             
                               <div class="form-group">
                              <button type="submit" class="btn btn-default" ng-disabled="forma.$invalid">Comprar</button>
                              </div>
                            </form>
                           <!--  <div class="col-sm-12 abajo_data">
                             <p>Datos de respuesta: @{{midata}}</p>
                           </div> -->
                      </div>

                      {{-- Respuesta de tarjeta enviada --}}
                      <div class="col-sm-12" ng-if="respuesta_tarjeta">
                          {{-- Tarjeta aceptada --}}
                          <div class="col-sm-12 caja_respuesta">
                            <h3>Felicidades!</h3>
                            <div class="ima_aceptada"></div>
                            <h2>Ya tienes 25 TUKIS en tu cuenta.</h2>
                            <h2>Tarjeta aceptada!</h2>
                            <a href="" class="btn_regreso"><p>Regresar a</p> <span>Don Campeón</span></a>
                          </div>
                      </div>

                       {{-- Respuesta de tarjeta rechazada --}}
                      <div class="col-sm-12" ng-if="rechazada_tarjeta">
                          {{-- Tarjeta aceptada --}}
                          <div class="col-sm-12 caja_respuesta">
                            <h3>Ups!</h3>
                            <div class="ima_rechaza"></div>
                            <h2>Tarjeta rechazada!</h2>
                            <h2></h2>
                            <a ng-click="btn_intenta()" class="btn_intentar"><p>Intentar </p> <span>Otra vez!</span></a>
                              <a href="" class="btn_regreso"><p>Regresar a</p> <span>Don Campeón</span></a>
                            
                            
                          </div>
                      </div>


                   </div>
                   <div class="caja_footer">
                   	 <div class="col-xs-12 col-sm-12 spd spi">
	                     <div class=" col-xs-6 col-sm-6 spd spi">
	                       <h5>Políticas de Compra</h5>
	                     </div>
	                     <div class="col-xs-6 col-sm-6 spd spi">
	                       <h5>Términos y Condiciones</h5>
	                     </div>
	                   </div>
                   </div>
	                  
                 </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="cobrar">

               </div>
             </div>

        </div>


</div>

@endsection
@push('scripts')
    <script src="/js/script.js"></script>
@endpush