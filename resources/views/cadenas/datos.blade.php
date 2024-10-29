@extends('cadenas.plantilla')

@section('css')
   <style media="screen">
      .fa-search{
         color: #4db6ac;
      }
      .row{
         margin: 0 !important;
         padding: 0 !important;
      }
      .fa-file-pdf-o{
         color: #d50000;
      }
      thead{
         background-color:
      }
      .fa-check{
         color: #4caf50;
      }
      .fa:hover{
         font-size: 1.3em;
      }
      .icon-check:hover{
         font-size: 1.5em;
      }

      .tabla {
       overflow-x: scroll;
       overflow-y: hidden;
       white-space: nowrap;
      }

     table {
       display: inline-block;
     }

   </style>
@endsection

@section('contenido')

  <div class="row">
      <form class="col s12" action="{{ url('/cambiar-password') }}" method="POST">
         <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
         <input type="hidden" name="id"  value="{{Auth::user()->id}}">
         <div class="row">
            <div class="input-field col s12 m4 l2">
               <input id="nuc" disabled type="text" name="folio" value="{{Auth::user()->folio}}">
               <label for="folio">FOLIO GAFET</label>
            </div>
            <div class="input-field col s12 m8 l4 l6">
               <input id="nuc" disabled type="text" name="name" value="{{Auth::user()->name}}">
               <label for="nombre">NOMBRE</label>
            </div>        
            <div class="input-field col s12 m6 l4">
              <input type="text" disabled name="cargo" value="{{Auth::user()->cargo->nombre}}">
              <label for="nombre">CARGO</label>
            </div> 
            <div class="input-field col s12 m6 l4">
              <input type="text" disabled name="tipo" value="{{Auth::user()->unidad->nombre}}">              
              <label for="nombre">UNIDAD</label>
            </div> 
            <div class="input-field col s12 m6 l4">
              <input type="password" min="6" max="10" autofocus="autofocus" name="pass">
                 <label for="folio">CONTRASEÑA*</label>
            </div>   
            <div class="input-field col s12 m6 l4">
              <input type="password" min="6" max="10" autofocus="autofocus" name="pass2">
               <label for="folio">CONFIRMAR CONTRASEÑA*</label>
            </div>   
          </div>
          <div class="row">  
            <div class="col s4 offset-s2 m4 offset-m8 l2 offset-l10">
               <button class="btn waves-effect waves-light orange lighten-1" disabled="on" type="submit" id="btn-pass" data-id="{{Auth::user()->id}}" name="action">
                  Cambiar Contraseña
               </button>
         </div>
       </form>
     </div>

@endsection

@section('js')
   <script type="text/javascript">
      $('.li-cadenas').removeClass('active');
      $('.li-cedulas').addClass('active').css({'font-weight':'bold'});
   </script>

   <script type="text/javascript">
  
      $(document).ready(function() {
        //variables
        var pass1 = $('[name=pass]');
        var pass2 = $('[name=pass2]');
        var confirmacion = "Las contraseñas si coinciden";
        var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
        var negacion = "No coinciden las contraseñas";
        var vacio = "La contraseña no puede estar vacía";
        //oculto por defecto el elemento span
        var span = $('<span></span>').insertAfter(pass2);
        span.hide();
        //función que comprueba las dos contraseñas
        function coincidePassword(){
          var valor1 = pass1.val();
          var valor2 = pass2.val();
          //muestro el span
          span.show().removeClass();
          //condiciones dentro de la función
          if(valor1 != valor2){
            $('#btn-pass').attr("disabled", true);
            span.text(negacion).addClass('negacion'); 
            console.log("if 1");
          }
          if(valor1.length==0 || valor1==""){
            $('#btn-pass').attr("disabled", true);
            span.text(vacio).addClass('negacion');  
            console.log("if 2");

          }
          if(valor1.length<6 || valor1.length>10){
            $('#btn-pass').attr("disabled", true);
            span.text(longitud).addClass('negacion');
            console.log("if 3");
          }
          if(valor1.length!=0 && valor1==valor2){
            span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
            $('#btn-pass').removeAttr('disabled');
            console.log("if 4");
          }
        }
        //ejecuto la función al soltar la tecla
        pass1.keyup(function(){
          coincidePassword();
        });

        pass2.keyup(function(){
          coincidePassword();
        });
      });    
   </script>
@endsection
