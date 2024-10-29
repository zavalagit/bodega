<table class="highlight bordered">
   <caption><b>DOCUMENTO EMITIDO</b></caption>
   <tbody>
       <tr>
           <td class="td-izq">Dictamenes</td>
           <td class="td-der">
           {{$atendidas->where('documento_emitido','dictamen')
                               ->count()
           }}
           </td>
        </tr>
        <tr>
            <td class="td-izq">Certificados</td>
            <td class="td-der">
                {{$atendidas->where('documento_emitido','certificado')
                                    ->count()
                }}
            </td>
        </tr>
       <tr>
           <td class="td-izq">Informes</td>
           <td class="td-der">
               {{$atendidas->where('documento_emitido','informe')
                                   ->count()
               }}
           </td>
       </tr>
       <tr>
           <td class="td-izq">Juzgados</td>
           <td class="td-der">
               {{$atendidas->where('documento_emitido','salida_juzgado')
                                   ->count()
               }}
           </td>
       </tr>
	   {{--
       @if (Auth::user()->unidad_id == 1)
        <tr>
            <td class="td-izq">Tarjeta informativa</td>
            <td class="td-der">
                {{$colectivos->count()}}
            </td>
        </tr>
       @endif
	   --}}
       <tr>
           <td class="td-izq">Archivo</td>
           <td class="td-der">
               {{$atendidas->where('documento_emitido','archivo')
                                   ->count()
               }}
           </td>
       </tr>
       <tr>
           <td class="td-izq-total"><b>Total de documentos emitidos</b></td>
           <td class="td-der-total">
              <b>
              {{$atendidas->count()}}
              </b>   
           </td>
        </tr>
   </tbody>
</table>