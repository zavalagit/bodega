@extends('cadenas.plantilla')

@section('titulo','REGISTRAR-CADENA')

@section('css')
   <style media="screen">
      textarea{
         padding: 0px !important;
      }
      blockquote{
         padding: 1px 0 !important;
         color: #fff !important;
         background-color: #112046 !important;
      }
      hr{
         border-color: #2196f3;
      }
      .btn{
         
         background-color: #bdbdbd;
   
      }
      .btn:hover{
         background-color: #112046 !important;
         color: #fff !important;  
      }

      .carousel {
    height:100vh;
}

   </style>

@endsection

@section('contenido')

   <div class="carousel carousel-slider center" data-indicators="true">

      <form class="col s12" id="form-registrar-cadena" autocomplete="off">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">


         <div class="carousel-fixed-item center">
            <a class="btn waves-effect white grey-text darken-text-2">button</a>
         </div>
         <div class="carousel-item blue lighten-4 white-text" href="#one!">
            <h2><b>CADENA DE CUSTODIA (ANEXO 3)</b></h2>

            <div class="row">
               <div class="input-field col s12 m6 l4">
                  <input type="text" name="nuc" value="1003">
                  <label for="nuc">NUC*</label>
               </div>
               <div class="input-field col s12 m6 l4">
                  <select name="unidad">
                     <option value="" disabled selected></option>
                     @foreach ($unidades as $unidad)
                        <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                     @endforeach
                  </select>
                  <label>Unidad administrativa*</label>
               </div>
               <div class="input-field col s12 m4 l4">
                  <input id="folio" type="text" name="folio">
                  <label for="folio">Folio</label>
               </div>
            </div>

            <div class="row">
               <div class="input-field col s12 m4 l4">
                  <textarea id="lugarIntervencion" class="materialize-textarea" name="intervencion_lugar"></textarea>
                  <label for="lugarIntervencion">Lugar de intervención*</label>
               </div>
               <div class="input-field col s6 m4 l4">
                  <input id="intervencion_hora" type="time" class="center-align" name="intervencion_hora">
                  <label class="active" for="horaIntervencion">Hora de intervención*</label>
               </div>
               <div class="input-field col s6 m4 l4">
                  <input id="intervencion_fecha" type="date" name="intervencion_fecha">
                  <label class="active" for="fechaIntervencion">Fecha de intervención*</label>
               </div>
            </div>

            <div class="row">
               <div class="col s3">
                  <p><b>Motivo del registro*</b></p>
               </div>
               <p class="col s8 m4 l3">
                  <input name="motivo" type="radio" id="localizacion" value="localizacion" />
                  <label for="localizacion">Localización</label>
               </p>
               <p class="col s8 m4 l3">
                  <input name="motivo" type="radio" id="descubrimiento" value="descubrimiento" />
                  <label for="descubrimiento">Descubrimiento</label>
               </p>
               <p class="col s8 offset-s3 m4 l3">
                  <input name="motivo" type="radio" id="aportacion" value="aportacion" />
                  <label for="aportacion">Aportación</label>
               </p>
            </div>

         </div><!--Primer panel-->


         <!--SEGUNDO PANEL-->
         <div class="carousel-item amber white-text" href="#two!">
            <h2><b>CADENA DE CUSTODIA (ANEXO 3)</b></h2>
            <section id="identidad">
            <blockquote class="center-align">
               <h6><b>1. IDENTIDAD (ÚNICAMENTE REGISTRAR INDICIOS QUE PRESENTEN LA MISMA NATURALEZA)</b></h6>
            </blockquote>
            <div class="row">
               <div class="col s2">
                  <a href="" id="add-desc"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
               </div>              
            </div>
            <div class="row">
               <div class="input-field col s12 m4 l2">
                  <input id="identificador" type="text" class="center-align" name="identificador[]">
                  <label for="identificador">IDENTIFICADOR*</label>
               </div>
               <div class="input-field col s12 m4 l9">
                  <textarea id="descripcion" class="materialize-textarea" name="descripcion[]"></textarea>
                  <label for="descripcion">DESCRIPCIÓN*</label>
               </div>               
               @if(Auth::user()->unidad_id == 1)
                  <div class="input-field col s12 m4 l6">
                     <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]"></textarea>
                     <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
                  </div>
                  <div class="input-field col s12 m4 l5">
                     <textarea id="recolectado_de" class="materialize-textarea" name="recolectado_de[]"></textarea>
                     <label for="recolectado_de">RECOLECTADO DE*</label>
                  </div>
                  <div class="input-field col s12 m4 l2">
                     <!--hora de recoleccion-->
                     <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]">
                     <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <!--fecha de recoleccion-->
                     <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]">
                     <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <input id="estado_indicio" type="text" name="estado_indicio[]">
                     <label for="estado_indicio">ESTADO DEL INDICIO</label>
                  </div>
                  <div class="input-field col s12 m6 l5">
                     <textarea id="observacion" class="materialize-textarea" name="observacion[]"></textarea>
                     <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
                  </div>
               @else
               <div class="input-field col s12 m4 l5">
                  <textarea id="ubicacion" class="materialize-textarea" name="ubicacion[]"></textarea>
                  <label for="ubicacion">UBICACIÓN DEL LUGAR*</label>
               </div>
                  <div class="input-field col s12 m4 l2">
                     <!--hora de recoleccion-->
                     <input id="hora-rec" type="time" class="center-align" name="recoleccion_hora[]">
                     <label class="active" for="hora-rec">HORA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <!--fecha de recoleccion-->
                     <input id="fecha-rec" type="date" class="center-align" name="recoleccion_fecha[]">
                     <label class="active" for="fecha-rec">FECHA DE RECOLECCIÓN*</label>
                  </div>
                  <div class="input-field col s6 m4 l2">
                     <input id="estado_indicio" type="text" name="estado_indicio[]">
                     <label for="estado_indicio">ESTADO DEL INDICIO</label>
                  </div>
                  <div class="input-field col s12 m6 l9">
                     <textarea id="observacion" class="materialize-textarea" name="observacion[]"></textarea>
                     <label for="observacion">OBSERVACIÓN EN ETIQUETA</label>
                  </div>
               @endif
               
            </div>
         </section>
         </div><!--Segundo Panel-->


         <div class="carousel-item green white-text" href="#three!">
            <h2>Third Panel</h2>
            <p class="white-text">This is your third panel</p>
         </div>
         <div class="carousel-item blue white-text" href="#four!">
            <h2>Fourth Panel</h2>
            <p class="white-text">This is your fourth panel</p>
         </div>
      </form>



  </div>

@endsection

@section('js')

   <script type="text/javascript">
      $(function(){
         $('.carousel.carousel-slider').carousel({fullWidth: true});
      });
   </script>


   @if(Auth::user()->unidad_id == 1 )
      <script src="{{asset('js/cadenas/indicios_genetica.js')}}"></script>
   @else
      <script src="{{asset('js/cadtemp.js')}}"></script>
   @endif

<script src="{{asset('js/autocompletar.js')}}"></script>

<script src="{{asset('js/cadenas/horas_fechas.js')}}"></script>

<script type="text/javascript">
   $('.li-consultar-cadena').removeClass('active');
   $('.li-registrar-cadena').addClass('active');
</script>

   <script type="text/javascript">
      var int=self.setInterval("refresh()",5000);
      function refresh(){
         var motivo = $("input:radio[name=motivo]:checked").val();
       
         if(motivo=='localizacion' || motivo=='descubrimiento'){               
            var fecha1 = $('#intervencion_fecha').val();
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else if(fecha1 == $(this).val()){
                        var hora1 = $('#intervencion_hora').val();
                        if(hora1!=''){
                           $('input[name^="recoleccion_hora"').each(function (){
                              if($(this).val() !=''){
                                 if(hora1 >= $(this).val()){
                                    alertify.logPosition("top right");
                                    alertify.error("Verifica la hora");
                                 }                           
                              }                     
                           });
                        }
                     }                     
                  }
               });            
            }           
         }
         else if(motivo=='aportacion'){            
            var fecha1 = $('#intervencion_fecha').val();
            console.log(fecha1);
            if(fecha1!=''){
               $('input[name^="recoleccion_fecha"').each(function (){
                  if($(this).val() !=''){
                     if(fecha1 > $(this).val()){
                        alertify.logPosition("top right");
                        alertify.error("Verifica la fecha");
                     }
                     else if(fecha1 == $(this.val())){
                        var hora1 = $('#intervencion_hora').val();
                        if(hora1!=''){
                           $('input[name^="recoleccion_hora"').each(function (){
                              if($(this).val() !=''){
                                 if(hora1 > $(this).val()){
                                    alertify.logPosition("top right");
                                    alertify.error("Verifica la hora");
                                 }                           
                              }
                           });
                        }
                     }
                  }
               });            
            }  

         }
      }
      </script> 

   <script type="text/javascript">
      
         $('#manual').change(function(){
            console.log($('#manual').val());
            console.log($('#instrumental').val());

            var man = $('#manual').val();
            var ins = $('#instrumental').val();
            var int = 0;

            for(var i =0; i < man.length; i++){
               for(var j =0; j < ins.length; j++){
                     if(man[i] == ins[j]){
                        console.log(man[i]);
                        console.log(ins[j]);                     
                        int = 1;
                        break;
                     }
               }              
               if(int == 1){
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ man[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });  

            $('#instrumental').change(function(){
            console.log($('#manual').val());
            console.log($('#instrumental').val());

            var man = $('#manual').val();
            var ins = $('#instrumental').val();
            var int = 0;

            for(var i =0; i < man.length; i++){
               for(var j =0; j < ins.length; j++){
                     if(man[i] == ins[j]){
                        console.log(man[i]);
                        console.log(ins[j]);                     
                        int = 1;
                        break;

                        //desabiliar 
                     }
               }              
               if(int == 1){
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ man[i] +"no puede estar en Manual e Intrumental");
               }
//               break;
            }
           });         
   </script>   

   <script type="text/javascript">

         $('#bolsa').change(function(){
            var bol  = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec  = $('#recipiente').val();
            var int  = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(bol[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < bol.length; i++){
               for(var j =0; j < rec.length; j++){
                        if(bol[i] == rec[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < rec.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(rec[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }             
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ bol +" no puede estar en un tipo de embalaje");
               }
//               break;
            
         });
         $('#caja').change(function(){           
            var bol = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec = $('#recipiente').val();
            var int = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(bol[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < bol.length; i++){
               for(var j =0; j < rec.length; j++){
                        if(bol[i] == rec[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < rec.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(rec[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }              
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El identificador "+ caja+" no puede estar en un tipo de embalaje");
               }
           });
         $('#recipiente').change(function(){           
            var bol = $('#bolsa').val();
            var caja = $('#caja').val();
            var rec = $('#recipiente').val();
            var int = 0;

            for(var i =0; i < bol.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(bol[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < bol.length; i++){
               for(var j =0; j < rec.length; j++){
                        if(bol[i] == rec[j]){
                           int = 1;
                           break;
                        }
               }
            }
            for(var i =0; i < rec.length; i++){
               for(var j =0; j < caja.length; j++){
                        if(rec[i] == caja[j]){
                           int = 1;
                           break;
                        }
               }
            }             
               if(int == 1){
               //   console.log('se repite');
                  alertify.logPosition("top right");
                  alertify.error("El Identificador"+ rec +" no puede estar en un tipo de embalaje");
               }
         });  

   </script> 


   </script> 
@endsection

