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
                              <div class="ima_tuki"></div>
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
                        <form class="form_pago form-horizontal" name="forma" >
                        
                              <div class="form-group">
                                <label for="exampleInputEmail1" class="col-xs-2 col-sm-2">Nombre</label>
                                <div class="col-xs-10 col-sm-10">
                                      <div class="col-xs-6 col-sm-6 spi">
                                             <input type="text" class="form-control" name="nombreU" ng-model="midato.info_usuario.first_name" placeholder="Nombre" required>
                                            <div class="men_error" ng-show="forma.nombreU.$dirty && forma.nombreU.$invalid">
                                                <p>Requerido</p>
                                            </div>
                                      </div>
                                      <div class="col-xs-6 col-sm-6 spd">
                                               <input type="text" class="form-control" name="apellidoU" ng-model="midato.info_usuario.last_name" placeholder="Apellido" required>
                                            <div class="men_error" ng-show="forma.apellidoU.$dirty && forma.apellidoU.$invalid">
                                                <p>Requerido</p>
                                            </div>
                                      </div>
                               
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1" class="col-xs-2 col-sm-2">Email</label>
                                <div class="col-xs-10 col-sm-10">
                                <input type="email" class="form-control"  name="emailU" ng-model="midato.email" placeholder="Correo Eletrónico" required>
                                <div class="men_error" ng-show="forma.emailU.$dirty && forma.emailU.$invalid">
                                    <p ng-show="forma.emailU.$error.required">El campo es obligatorio.</p>
                                    <p ng-show="forma.emailU.$error.email">Email invalido.</p>
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
                                <input type="number" class="form-control"  name="notarjetaU" ng-model="usuario.notarjeta" placeholder="**** **** **** ****" required>
                                <div class="men_error" ng-show="forma.notarjetaU.$dirty && forma.notarjetaU.$invalid">
                                    <p>El campo es obligatorio.</p>
                                </div>

                                </div>

                              </div>
                              <div class="col-sm-6 col-xs-6 spd spi">
                                <div class="form-group">
                                  <label for="exampleInputPassword1" class="col-sm-12">Fecha de Vencimiento</label>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="MM">
                                  </div>
                                  <div class="col-sm-6 col-xs-6">
                                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="AA">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 col-xs-6 spd">
                                <div class="form-group">
                                  <label for="exampleInputPassword1" class="col-sm-12">CVV</label>
                                  <div class="col-sm-6 ">
                                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="CVV">
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

                              <button type="submit" class="btn btn-default">Comprar</button>
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