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
                              <h3>X 25</h3>
                            </div>
                         </div>
                         <div class="col-sm-6 col-xs-6">
                              <h4>$ 3.25</h4>
                         </div>
                   </div>
                   <div class="caja_tarjeta">
                      <div class="col-sm-12">
                        <p class="monto">Monto a pagar $3.25 (Q25.00)</p>
                      </div>
                      <div class="col-sm-12">
                        <form class="form_pago form-horizontal" name="forma">
                              <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2">Nombre</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombreU" ng-model="usuario.nombre" placeholder="Nombre y Apellido" required>
                                <div class="men_error" ng-show="forma.nombreU.$dirty && forma.nombreU.$invalid">
                                    <p>El campo es obligatorio.</p>
                                </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-2">Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control"  name="emailU" ng-model="usuario.email" placeholder="Correo Eletrónico" required>
                                <div class="men_error" ng-show="forma.emailU.$dirty && forma.emailU.$invalid">
                                    <p ng-show="forma.emailU.$error.required">El campo es obligatorio.</p>
                                    <p ng-show="forma.emailU.$error.email">Email invalido.</p>
                                </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-2">Teléfono</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" name="telefonoU" ng-model="usuario.telefono" placeholder="Telefono: 5555-5555" required>
                                <div class="men_error" ng-show="forma.telefonoU.$dirty && forma.telefonoU.$invalid">
                                    <p>El campo es obligatorio.</p>
                                </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-2">No.ID</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="dpiU" ng-model="usuario.dpi" placeholder="Documento de Identificación DPI/ID" required>
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
               <div role="tabpanel" class="tab-pane" id="cobrar">

               </div>
             </div>

        </div>


</div>
@endsection
@push('scripts')
    <script src="/js/script.js"></script>
@endpush