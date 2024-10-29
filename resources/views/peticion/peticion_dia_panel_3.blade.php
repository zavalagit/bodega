<div class="row">
   <div class="col s12" style="margin-top: 10px;">
      <table id="tabla-panel-dos" class="highlight bordered">
         <caption>Peticiones atendidas en el día, pero registradas en fecha anterior</caption>
         <thead>
            <tr>
            <th width="2%" class="th-center">No.</th>
            <th width="8%">REGISTRADO A LAS</th>
            <th width="8%">N.U.C.</th>
            <th width="3%" class="th-center">VER</th>
            @if (Auth::user()->tipo == 'administrador_peticiones') <th width="9%">REGIÓN</th> @endif
            @if ( in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']) ) <th width="8%">UNIDAD</th> @endif
            @if (Auth::user()->tipo != 'usuario') <th width="10%">PERITO</th> @endif
            <th width="10%">ESPECIALIDAD</th>
            <th width="">SOLICITUD</th>
            <th width="8%">FECHA CÓMO ATENDIDA EN SISTEMA</th>
            <th width="8%">DOCUMENTO EMITIDO</th>
            <th width="4%" class="th-center">ESTUDIOS</th>
            <th width="5%" class="th-center">ESTADO</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($rezago->values() as $i => $peticion)
               <tr>
                  <!--index-->
                  <td class="td-index">{{$i+1}}</td>
                  <!--fecha de regitro en sistema-->
                  <td>{{date('H:i:s d-m-Y',strtotime($peticion->created_at))}}</td>
                  <!--nuc-->
                  <td>{{$peticion->nuc}}</td>
                  <!--informacion peticion-->
                  <td class="td-center">
                     <a href="" class="peticion-info" data-peticion-id={{$peticion->id}}>
                        <i class="fas fa-eye i-btn"></i>
                     </a>
                  </td>
                  <!--region-->
                  @if (Auth::user()->tipo == 'administrador_peticiones') <td>{{$peticion->fiscalia2->nombre}}</td> @endif
                  <!--unidad-->
                  @if ( in_array(Auth::user()->tipo,['administrador_peticiones','coordinador_peticiones_region']) ) <td>{{$peticion->unidad->nombre}}</td> @endif
                  <!--perito-->
                  @if (Auth::user()->tipo != 'usuario') <td>{{$peticion->user->name}}</td> @endif
                  <!--especialidad-->
                  <td>{{$peticion->solicitud->especialidad->nombre}}</td>
                  <!--solicitud-->
                  <td>{{$peticion->solicitud->nombre}}</td>                     
                  <!--la peticion hay que mantenerla pendiente sino se atendio en el dia-->                              
                  <!--fecha_sistema-->
                  <td class="td-center">{{date('d-m-Y',strtotime($peticion->fecha_sistema))}}</td>
                  <!--documento_emitido-->
                  <td>{{strtoupper($peticion->documento_emitido)}}</td>
                  <!--estudios-->
                  <td class="td-center">{{$peticion->cantidad_estudios}}</td>
                  <!--estado-->
                  <td class="td-center">{{strtoupper($peticion->estado)}}</td>
               </tr>
            @empty
               <tr>
                  <td colspan="13" class="td-aviso">NO HAY COINCIDENCIAS</td>
               </tr>   
            @endforelse
         </tbody>
      </table>
   </div>
</div>