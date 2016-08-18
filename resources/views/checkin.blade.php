@extends('layouts.app')

@section('content')
<div class="container">
		      <div class="caja" ng-controller="CheckinCtrl">

            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#comprar" aria-controls="comprar" role="tab" data-toggle="tab">Comprar</a></li>
                <!--
              <li role="presentation"><a href="#cobrar" aria-controls="cobrar" role="tab" data-toggle="tab">Cobrar</a></li>
               -->
            </ul>
             <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="comprar">
                 <div class="col-sm-12">
                   <div class="caja_paquete">
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
                   </div>
                   <div class="caja_tarjeta">
                      <div class="col-sm-12">
                        <p class="monto">Monto a pagar $ @{{mipaquete.monto_dolar | number:2}}</p>
                      </div>
                      <div class="col-sm-12">
                        <form class="form_pago form-horizontal" name="forma" ng-submit="enviarCompra()" >
                              <div class="form-group">
                                <h3 class="info_user"><strong>Usuario </strong> @{{midato.info_usuario.first_name}} @{{midato.info_usuario.last_name}}</h3>
                                     <h3 class="info_user"><strong>Correo </strong> @{{midato.email}}</h3>
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
                                <label for="exampleInputPassword1" class="col-sm-2 col-xs-2">No.ID</label>
                                <div class="col-sm-10 col-xs-10">
                                <input type="text" class="form-control" name="dpiU" ng-model="midato.info_usuario.noid" placeholder="Documento de Identificación DPI/ID" required>
                                <div class="men_error" ng-show="forma.dpiU.$dirty && forma.dpiU.$invalid">
                                    <p>El campo es obligatorio.</p>
                                </div>
                                </div>
                              </div>
                         
                              <div class="col-sm-12">
                                <div class="ico_tarjetas">
                                  <ul>
                                    <li class="t_visa"></li>
                                    <li class="t_master"></li>
                                    <li class="t_amer"></li>
                                    <li class="t_debito"></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-2">N.Tarjeta</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control"  name="notarjetaU" ng-model="usuario.notarjeta" placeholder="**** **** **** ****" required minlength="16" maxlength="16" ng-maxlength="16" ng-pattern="/^[0-9]*$/">
                                <div class="men_error" ng-show="forma.notarjetaU.$dirty && forma.notarjetaU.$invalid">
                                    <p>Requerido, Mínimo 16 números</p>
                                </div>

                                </div>

                              </div>
                              <div class="col-sm-6 col-xs-6 spd spi">
                                <div class="form-group">
                                  <label for="exampleInputPassword1" class="col-sm-12">Fecha de Vencimiento</label>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="text"  name="mesU" class="form-control"  ng-model="usuario.mestarjeta"  placeholder="MM" maxlength="2" ng-maxlength="2" ng-pattern="/^[0-9]*$/" required>
                                   <div class="men_error" ng-show="forma.mesU.$dirty && forma.mesU.$invalid">
                                    <p>Núm.</p>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="text" name="anioU" class="form-control" ng-model="usuario.aniotarjeta" placeholder="AA" maxlength="2" ng-maxlength="2" ng-pattern="/^[0-9]*$/" required>
                                   <div class="men_error" ng-show="forma.anioU.$dirty && forma.anioU.$invalid">
                                    <p>Núm.</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 col-xs-6 spd">
                                <div class="form-group">
                                  <label for="exampleInputPassword1" class="col-sm-12">CVV</label>
                                  <div class="col-sm-12 ">
                                   <input type="text" name="cvvU" class="form-control" ng-model="usuario.cvvtarjeta" placeholder="CVV" maxlength="3" ng-maxlength="4" ng-pattern="/^[0-9]*$/" required>
                                   <div class="men_error" ng-show="forma.cvvU.$dirty && forma.cvvU.$invalid">
                                    <p>Núm.</p>
                                    </div>
                                  </div>

                                </div>
                              </div>
                              <div class="col-sm-12 spd spi">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox"> Aceptas los términos y condiciones
                                  </label>
                                </div>
                              </div>

                              <button type="submit" class="btn btn-default" ng-disabled="forma.$invalid">Comprar</button>
                            </form>
                      </div>
                   </div>
                   <div class="caja_footer">
                   	 <div class="col-sm-12 spd spi">
	                     <div class="col-sm-6 spd spi">
	                       <h5>Políticas de Compra</h5>
	                     </div>
	                     <div class="col-sm-6 spd spi">
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