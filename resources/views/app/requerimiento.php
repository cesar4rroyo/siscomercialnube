<style>
.tr_hover{
	color:red;
}
.form-group{
    margin-bottom: 8px !important;
}
</style>
<div id="divMensajeError{!! $entidad !!}"></div>
{!! Form::model($movimiento, $formData) !!}	
	{!! Form::hidden('listar', $listar, array('id' => 'listar')) !!}
    {!! Form::hidden('listProducto', null, array('id' => 'listProducto')) !!}
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <div class="row col-lg-12 col-md-12 col-sm-12 p-0 m-0">
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('fecha', 'Fecha:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::date('fecha', date('Y-m-d'), array('class' => 'form-control input-xs', 'id' => 'fecha', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('numero', 'Nro:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::text('numero', '', array('class' => 'form-control input-xs', 'id' => 'numero', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 col-md-12 col-sm-12 p-0 m-0">
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('tipodocumento', 'Tipo Doc.:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::select('tipodocumento',$cboTipoDocumento, null, array('class' => 'form-control input-xs', 'id' => 'tipodocumento', 'onchange' => 'generarNumero();cambiarMotivo();actualizarProductos();')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('motivo_id', 'Motivo:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::select('motivo_id',$cboMotivo, null, array('class' => 'form-control input-xs', 'id' => 'motivo_id', 'onchange' => '')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 col-md-12 col-sm-12 p-0 m-0">
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('sucursal_id', 'Sucursal:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::select('sucursal_id',$cboSucursal, null, array('class' => 'form-control input-xs', 'id' => 'sucursal_id', 'onchange' => 'cambiarSucursalDestino()')) !!}
                        </div>
                    </div>
                </div>
                <div id="divsucursaldestino" class="col-lg-6 col-md-6 col-sm-6 p-0">
                    <div class="form-group">
                        {!! Form::label('sucursaldestino', 'Sucursal Destino:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! Form::select('sucursaldestino',$cboSucursalDestino, null, array('class' => 'form-control input-xs', 'id' => 'sucursaldestino', 'onchange' => '')) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <div class="form-group" style="display: none;">
        		{!! Form::label('persona', 'Proveedor:', array('class' => 'col-lg-2 col-md-2 col-sm-2 control-label')) !!}
        		<div class="col-lg-9 col-md-9 col-sm-9">
                    {!! Form::hidden('persona_id', 0, array('id' => 'persona_id')) !!}
                    {!! Form::hidden('ruc', '', array('id' => 'ruc')) !!}
            		{!! Form::text('persona', 'VARIOS', array('class' => 'form-control input-xs', 'id' => 'persona', 'placeholder' => 'Ingrese Proveedor')) !!}
        		</div>
                <div class="col-lg-1 col-md-1 col-sm-1">
                    {!! Form::button('<i class="fa fa-file fa-lg"></i>', array('class' => 'btn btn-info btn-xs', 'onclick' => 'modal (\''.URL::route('persona.create', array('listar'=>'SI','modo'=>'popup')).'\', \'Nueva Historia\', this);', 'title' => 'Nueva Persona')) !!}
        		</div>
        	</div>
            <div class="form-group">
                {!! Form::label('comentario', 'Comentario:', array('class' => 'col-lg-2 col-md-2 col-sm-2 control-label')) !!}
                <div class="col-lg-12 col-md-12 col-sm-12">
                    {!! Form::textarea('comentario', '', array('class' => 'form-control input-xs', 'id' => 'comentario', 'rows' => '3')) !!}
                </div>
            </div>
        	<div class="form-group">
        		<div class="col-lg-12 col-md-12 col-sm-12 text-right">
        			{!! Form::button('<i class="fa fa-check fa-lg"></i> '.$boton, array('class' => 'btn btn-success btn-sm', 'id' => 'btnGuardar', 'onclick' => '$(\'#listProducto\').val(carro);guardarPago(\''.$entidad.'\', this);')) !!}
        			{!! Form::button('<i class="fa fa-exclamation fa-lg"></i> Cancelar', array('class' => 'btn btn-warning btn-sm', 'id' => 'btnCancelar'.$entidad, 'onclick' => 'cerrarModal();')) !!}
        		</div>
        	</div>
         </div>
         <div class="col-lg-7 col-md-7 col-sm-7">
             <div class="row col-lg-12 col-md-12 col-sm-12 p-0 m-0">
                 @if ($conf_codigobarra=="S")
                 <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                         <div class="form-group">
                             {!! Form::label('codigo', 'Cod. Barra:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 {!! Form::text('codigobarra', null, array('class' => 'form-control input-xs', 'id' => 'codigobarra')) !!}
                             </div>
                         </div>
                 </div>
                 @endif
                 <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                     <div class="form-group">
                         {!! Form::label('descripcion', 'Producto:', array('class' => 'col-lg-12 col-md-12 col-sm-12 control-label')) !!}
                         <div class="col-lg-12 col-md-12 col-sm-12">
                             {!! Form::text('descripcion', null, array('class' => 'form-control input-xs', 'id' => 'descripcion', 'onkeypress' => '')) !!}
                         </div>
                     </div>
                 </div>
             </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12" id="divBusqueda">
            </div>
         </div>        
     </div>
     <div class="box">
        <div class="box-header">
            <h2 class="box-title col-lg-5 col-md-5 col-sm-5">Detalle </h2>
        </div>
        <div class="box-body">
            <table class="table table-condensed table-border" id="tbDetalle">
                <thead class="bg-navy">
                    <th class="text-center">Cant.</th>
                    @if ($conf_codigobarra=="S")
                        <th class="text-center">Cod. Barra</th>
                    @endif
                    <th class="text-center">Producto</th>
                    <th class="text-center">P. Compra</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center"></th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    @php
                        $colspan1 = ($conf_codigobarra=="S")?"4":"3";
                    @endphp
                    <th class="text-right" colspan="{{$colspan1}}">Total</th>
                    <th class="text-center" align="center">{!! Form::text('total', null, array('class' => 'input-xs', 'id' => 'total', 'size' => 3, 'readonly' => 'true', 'style' => 'width: 60px;')) !!}</th>
                    <th class="text-center" align="center"></th>
                </tfoot>
            </table>
        </div>
     </div>
{!! Form::close() !!}
<script type="text/javascript">
var valorbusqueda="";
$(document).ready(function() {
	configurarAnchoModal('1350');
	init(IDFORMMANTENIMIENTO+'{!! $entidad !!}', 'B', '{!! $entidad !!}');
    $(IDFORMMANTENIMIENTO + '{{ $entidad }} :input[id="total"]').inputmask('decimal', { radixPoint: ".", autoGroup: true, groupSeparator: "", groupSize: 3, digits: 2 });

    var personas2 = new Bloodhound({
		datumTokenizer: function (d) {
			return Bloodhound.tokenizers.whitespace(d.value);
		},
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
			url: 'compra/personautocompletar/%QUERY',
			filter: function (personas2) {
				return $.map(personas2, function (movie) {
					return {
						value: movie.value,
						id: movie.id,
                        ruc: movie.ruc,
					};
				});
			}
		}
	});
	personas2.initialize();
	$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="persona"]').typeahead(null,{
		displayKey: 'value',
		source: personas2.ttAdapter()
	}).on('typeahead:selected', function (object, datum) {
		$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="ruc"]').val(datum.ruc);
        $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="persona"]').val(datum.value);
        $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="persona_id"]').val(datum.id);
	});

    @if ($conf_codigobarra=="S")
        $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="codigobarra"]').focus();
    @else
        $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="descripcion"]').focus();
    @endif

    $(IDFORMMANTENIMIENTO + '{{ $entidad }} :input[id="sucursal_id"]').change(function (e) {
        actualizarProductos();
    });
    $(IDFORMMANTENIMIENTO + '{{ $entidad }} :input[id="motivo_id"]').change(function (e) {
        actualizarDivSucursal();
    });
    $("#divsucursaldestino").hide();
    $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="descripcion"]').on( 'keydown', function () {
        var e = window.event; 
        var keyc = e.keyCode || e.which;
        if(this.value.length>1 && keyc == 13){
            buscarProducto(this.value);
            valorbusqueda=this.value;
            this.focus();
            return false;
        }
        if(keyc == 38 || keyc == 40 || keyc == 13) {
            var tabladiv='tablaProducto';
			var child = document.getElementById(tabladiv).rows;
			var indice = -1;
			var i=0;
            $('#tablaProducto tr').each(function(index, elemento) {
                if($(elemento).hasClass("tr_hover")) {
    			    $(elemento).removeClass("par");
    				$(elemento).removeClass("impar");								
    				indice = i;
                }
                if(i % 2==0){
    			    $(elemento).removeClass("tr_hover");
    			    $(elemento).addClass("impar");
                }else{
    				$(elemento).removeClass("tr_hover");								
    				$(elemento).addClass('par');
    			}
    			i++;
    		});		 
			// return
			if(keyc == 13) {        				
			     if(indice != -1){
					var seleccionado = '';			 
					if(child[indice].id) {
					   seleccionado = child[indice].id;
					} else {
					   seleccionado = child[indice].id;
					}		 		
					seleccionarProducto(seleccionado);
				}
			} else {
				// abajo
				if(keyc == 40) {
					if(indice == (child.length - 1)) {
					   indice = 1;
					} else {
					   if(indice==-1) indice=0;
	                   indice=indice+1;
					} 
				// arriba
				} else if(keyc == 38) {
					indice = indice - 1;
					if(indice==0) indice=-1;
					if(indice < 0) {
						indice = (child.length - 1);
					}
				}	 
				child[indice].className = child[indice].className+' tr_hover';
			}
        }
    });
    
    $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="codigobarra"]').on( 'keydown', function () {
        var e = window.event; 
        var keyc = e.keyCode || e.which;
        if(this.value.length>1 && keyc == 13){
            buscarProductoBarra(this.value);
            this.value='';
        }
    });

}); 

function guardarHistoria (entidad, idboton) {
	var idformulario = IDFORMMANTENIMIENTO + entidad;
	var data         = submitForm(idformulario);
	var respuesta    = '';
	var btn = $(idboton);
	btn.button('loading');
	data.done(function(msg) {
		respuesta = msg;
	}).fail(function(xhr, textStatus, errorThrown) {
		respuesta = 'ERROR';
	}).always(function() {
		btn.button('reset');
		if(respuesta === 'ERROR'){
		}else{
		  //alert(respuesta);
            var dat = JSON.parse(respuesta);
			if (dat[0]!==undefined && (dat[0].respuesta=== 'OK')) {
				cerrarModal();
                $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="historia_id"]').val(dat[0].id);
                $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="numero_historia"]').val(dat[0].historia);
                $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="person_id"]').val(dat[0].person_id);
                $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="tipopaciente"]').val(dat[0].tipopaciente);
                alert('Historia Generada');
                window.open("historia/pdfhistoria?id="+dat[0].id,"_blank");
			} else {
				mostrarErrores(respuesta, idformulario, entidad);
			}
		}
	});
}

var contador=0;
function guardarPago (entidad, idboton) {
    var band=true;
    var msg="";
    if($("#persona").val()==""){
        band = false;
        msg += " No se seleccionó un proveedor.<br>";    
    }
    if(carro.length == 0){
        band = false;
        msg += " No se seleccionó ningún item.";    
    }
    if(band && contador==0){
        contador=1;
    	var idformulario = IDFORMMANTENIMIENTO + entidad;
    	var data         = submitForm(idformulario);
    	var respuesta    = '';
    	var btn = $(idboton);
    	btn.button('loading');
    	data.done(function(msg) {
    		respuesta = msg;
    	}).fail(function(xhr, textStatus, errorThrown) {
    		respuesta = 'ERROR';
            contador=0;
    	}).always(function() {
    		btn.button('reset');
            contador=0;
    		if(respuesta === 'ERROR'){
    		}else{
    		  //alert(respuesta);
                var dat = JSON.parse(respuesta);
                if(dat[0]!==undefined){
                    resp=dat[0].respuesta;    
                }else{
                    resp='VALIDACION';
                }
                console.log(resp)
    			if (resp === 'OK') {
    				cerrarModal();
                    buscarCompaginado('', 'Accion realizada correctamente', entidad, 'OK');
                    //window.open('/juanpablo/ticket/pdfComprobante3?ticket_id='+dat[0].ticket_id,'_blank')
    			} else if(resp === 'ERROR') {
                    //alert(dat[0].msg);
                    toastr.error(dat[0].msg, 'ERROR:');
    			} else {
    				mostrarErrores(respuesta, idformulario, entidad);
    			}
    		}
    	});
    }else{
        toastr.error(msg, 'Corregir los sgtes errores:');
    }
}

function buscarProductoBarra(barra){
    if($(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="sucursal_id"]').val() == ""){
        toastr.warning("Debe seleccionar una sucursal", 'Error:');
    }else{
        $.ajax({
            type: "POST",
            url: "movimientoalmacen/buscarproductobarra",
            data: "tipodocumento="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="tipodocumento"]').val()+"&sucursal_id="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="sucursal_id"]').val()+"&codigobarra="+barra+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
            success: function(a) {
                datos=JSON.parse(a);
                if(datos.length > 0){
                    seleccionarProducto(datos[0].idproducto,datos[0].codigobarra,datos[0].producto,datos[0].preciocompra,datos[0].precioventa,datos[0].stock);
                }
            }
        });
    }
}


var valorinicial="";
function buscarProducto(valor){
    if($(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="sucursal_id"]').val() == ""){
        toastr.warning("Debe seleccionar una sucursal", 'Error:');
    }else{
        $.ajax({
            type: "POST",
            url: "movimientoalmacen/buscarproducto",
            data: "tipodocumento="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="tipodocumento"]').val()+"&sucursal_id="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="sucursal_id"]').val()+"&descripcion="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[id="descripcion"]').val()+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
            success: function(a) {
                datos=JSON.parse(a);
                var strTable = "<table class='table table-bordered table-condensed table-hover' border='1' id='tablaProducto'><thead class='bg-navy'><tr>";
                @if ($conf_codigobarra=="S")
                    strTable = strTable + "<th class='text-center'>Cod. Barra</th>";
                @endif   
                strTable = strTable + "<th class='text-center'>Producto</th><th class='text-center'>Stock</th><th class='text-center'>P. Unit.</th></tr></thead><tbody id='tbodyProducto'></tbody></table>";
                $("#divBusqueda").html(strTable);
                var pag=parseInt($("#pag").val());
                var d=0;
                for(c=0; c < datos.length; c++){
                    var a="<tr id='"+datos[c].idproducto+"' onclick=\"seleccionarProducto('"+datos[c].idproducto+"','"+datos[c].codigobarra+"','"+datos[c].producto+"','"+datos[c].preciocompra+"','"+datos[c].precioventa+"','"+datos[c].stock+"')\">";
                    @if ($conf_codigobarra=="S")
                        a = a + "<td align='center'>"+datos[c].codigobarra+"</td>";
                    @endif 
                    a = a + "<td>"+datos[c].producto+"</td><td align='right'>"+datos[c].stock+"</td><td align='right'>"+datos[c].precioventa+"</td></tr>";
                    $("#tbodyProducto").append(a);           
                }
                $('#tablaProducto').DataTable({
                    "scrollY":        "250px",
                    "scrollCollapse": true,
                    "paging":         false
                });
                $('#tablaProducto_filter').css('display','none');
                $("#tablaProducto_info").css("display","none");
            }
        });
    }
}

var carro = new Array();
var carroDoc = new Array();
var copia = new Array();
function seleccionarProducto(idproducto,codigobarra,descripcion,preciocompra,precioventa,stock){
    var band=true;
    for(c=0; c < carro.length; c++){
        if(carro[c]==idproducto){
            band=false;
        }      
    }
    if(band){
        var strDetalle = "<tr id='tr"+idproducto+"'><td><input type='hidden' id='txtIdProducto"+idproducto+"' name='txtIdProducto"+idproducto+"' value='"+idproducto+"' /><input type='text' data='numero' style='width: 60px;' class='form-control input-xs' id='txtCantidad"+idproducto+"' name='txtCantidad"+idproducto+"' value='1' size='3' onkeydown=\"if(event.keyCode==13){calcularTotalItem("+idproducto+")}\" onblur=\"calcularTotalItem("+idproducto+")\" /></td>";
        @if ($conf_codigobarra=="S")
            strDetalle = strDetalle + "<td align='left'>"+codigobarra+"</td>";
        @endif
        strDetalle = strDetalle + "<td align='left'>"+descripcion+"</td>" + 
        "<td align='center'><input type='hidden' id='txtPrecioVenta"+idproducto+"' name='txtPrecioVenta"+idproducto+"' value='"+precioventa+"' /><input type='text' size='5' class='form-control input-xs' data='numero' id='txtPrecio"+idproducto+"' style='width: 60px;' name='txtPrecio"+idproducto+"' value='"+preciocompra+"' onkeydown=\"if(event.keyCode==13){calcularTotalItem("+idproducto+")}\" onblur=\"calcularTotalItem("+idproducto+")\" /></td>"+
        "<td align='center'><input type='text' readonly='' data='numero' class='form-control input-xs' size='5' name='txtTotal"+idproducto+"' style='width: 60px;' id='txtTotal"+idproducto+"' value='"+preciocompra+"' /></td>"+
        "<td><a href='#' onclick=\"quitarProducto('"+idproducto+"')\"><i class='fa fa-minus-circle' title='Quitar' width='20px' height='20px'></i></td></tr>";
        $("#tbDetalle").append(strDetalle);
            
        // $("#tbDetalle").append("<tr id='tr"+idproducto+"'><td><input type='hidden' id='txtIdProducto"+idproducto+"' name='txtIdProducto"+idproducto+"' value='"+idproducto+"' /><input type='text' data='numero' style='width: 40px;' class='form-control input-xs' id='txtCantidad"+idproducto+"' name='txtCantidad"+idproducto+"' value='1' size='3' onkeydown=\"if(event.keyCode==13){calcularTotalItem("+idproducto+")}\" onblur=\"calcularTotalItem("+idproducto+")\" /></td>"+
        //     // "<td align='left'>"+codigobarra+"</td>"+
        //     "<td align='left'>"+descripcion+"</td>"+
        //     "<td align='center'><input type='hidden' id='txtPrecioVenta"+idproducto+"' name='txtPrecioVenta"+idproducto+"' value='"+precioventa+"' /><input type='text' size='5' class='form-control input-xs' data='numero' id='txtPrecio"+idproducto+"' style='width: 60px;' name='txtPrecio"+idproducto+"' value='"+preciocompra+"' onkeydown=\"if(event.keyCode==13){calcularTotalItem("+idproducto+")}\" onblur=\"calcularTotalItem("+idproducto+")\" /></td>"+
        //     "<td align='center'><input type='text' readonly='' data='numero' class='form-control input-xs' size='5' name='txtTotal"+idproducto+"' style='width: 60px;' id='txtTotal"+idproducto+"' value='"+preciocompra+"' /></td>"+
        //     "<td><a href='#' onclick=\"quitarProducto('"+idproducto+"')\"><i class='fa fa-minus-circle' title='Quitar' width='20px' height='20px'></i></td></tr>");
        carro.push(idproducto);
        $(':input[data="numero"]').inputmask('decimal', { radixPoint: ".", autoGroup: true, groupSeparator: "", groupSize: 3, digits: 2 });
        calcularTotal();
    }else{
        $('#txtCantidad'+idproducto).focus();
    }
}

function calcularTotal(){
    var total2=0;
    for(c=0; c < carro.length; c++){
        var tot=parseFloat($("#txtTotal"+carro[c]).val());
        total2=Math.round((total2+tot) * 100) / 100;        
    }
    $("#total").val(total2);
}

function calcularTotalItem(id){
    var cant=parseFloat($("#txtCantidad"+id).val());
    var pv=parseFloat($("#txtPrecio"+id).val());
    var total=Math.round((pv*cant) * 100) / 100;
    $("#txtTotal"+id).val(total);
    calcularTotal();
}

function quitarProducto(id){
    $("#tr"+id).remove();
    for(c=0; c < carro.length; c++){
        if(carro[c] == id) {
            carro.splice(c,1);
        }
    }
    calcularTotal();
}

function agregarDetalle(id){
    $.ajax({
        type: "POST",
        url: "ticket/agregardetalle",
        data: "id="+id+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
        success: function(a) {
            datos=JSON.parse(a);
            for(d=0;d < datos.length; d++){
                if(datos[d].idservicio>0){
                    datos[d].id=datos[d].idservicio;
                }else{
                    datos[d].id="00"+Math.round(Math.random()*100);
                }
                //console.log(datos[d].idservicio);
                datos[d].idservicio="01"+Math.round(Math.random()*100)+datos[d].idservicio;
                $("#tbDetalle").append("<tr id='tr"+datos[d].idservicio+"'><td><input type='hidden' id='txtIdTipoServicio"+datos[d].idservicio+"' name='txtIdTipoServicio"+datos[d].idservicio+"' value='"+datos[d].idtiposervicio+"' /><input type='hidden' id='txtIdServicio"+datos[d].idservicio+"' name='txtIdServicio"+datos[d].idservicio+"' value='"+datos[d].id+"' /><input type='text' data='numero' style='width: 40px;' class='form-control input-xs' id='txtCantidad"+datos[d].idservicio+"' name='txtCantidad"+datos[d].idservicio+"' value='"+datos[d].cantidad+"' size='3' onkeydown=\"if(event.keyCode==13){calcularTotal()}\" onblur=\"calcularTotalItem('"+datos[d].idservicio+"')\" /></td>"+
                    "<td><input type='checkbox' id='chkCopiar"+datos[d].idservicio+"' onclick=\"checkMedico(this.checked,'"+datos[d].idservicio+"')\" /></td>"+
                    "<td><input type='text' class='form-control input-xs' id='txtMedico"+datos[d].idservicio+"' name='txtMedico"+datos[d].idservicio+"' value='"+datos[d].medico+"' /><input type='hidden' id='txtIdMedico"+datos[d].idservicio+"' name='txtIdMedico"+datos[d].idservicio+"' value='"+datos[d].idmedico+"' /></td>"+
                    "<td align='left'>"+datos[d].tiposervicio+"</td><td>"+datos[d].servicio+"</td>"+
                    "<td><input type='hidden' id='txtPrecio2"+datos[d].idservicio+"' name='txtPrecio2"+datos[d].idservicio+"' value='0' /><input type='text' size='5' class='form-control input-xs' style='width: 60px;' data='numero' id='txtPrecio"+datos[d].idservicio+"' name='txtPrecio"+datos[d].idservicio+"' value='0' onkeydown=\"if(event.keyCode==13){calcularTotalItem2('"+datos[d].idservicio+"')}\" onblur=\"calcularTotalItem2('"+datos[d].idservicio+"')\" /></td>"+
                    "<td><input type='text' size='5' style='width: 60px;' class='form-control input-xs' data='numero' id='txtDescuento"+datos[d].idservicio+"' name='txtDescuento"+datos[d].idservicio+"' value='0' onkeydown=\"if(event.keyCode==13){calcularTotalItem2('"+datos[d].idservicio+"')}\" onblur=\"calcularTotalItem2('"+datos[d].idservicio+"')\" style='width:50%' /></td>"+
                    "<td><input type='hidden' id='txtPrecioHospital2"+datos[d].idservicio+"' name='txtPrecioHospital2"+datos[d].idservicio+"' value='0' /><input type='text' size='5' style='width: 60px;' class='form-control input-xs' data='numero'  id='txtPrecioHospital"+datos[d].idservicio+"' name='txtPrecioHospital"+datos[d].idservicio+"' value='0' onblur=\"calcularTotalItem2("+datos[d].idservicio+")\" /></td>"+
                    "<td><input type='hidden' id='txtPrecioMedico2"+datos[d].idservicio+"' name='txtPrecioMedico2"+datos[d].idservicio+"' value='0' /><input type='text' size='5' class='form-control input-xs' data='numero'  id='txtPrecioMedico"+datos[d].idservicio+"' name='txtPrecioMedico"+datos[d].idservicio+"' value='0' style='width: 60px;' /></td>"+
                    "<td><input type='text' style='width: 60px;' readonly='' data='numero' class='form-control input-xs' size='5' name='txtTotal"+datos[d].idservicio+"' id='txtTotal"+datos[d].idservicio+"' value=0' /></td>"+
                    "<td><a href='#' id='Quitar"+datos[d].idservicio+"' onclick=\"quitarServicio('"+datos[d].idservicio+"')\"><i class='fa fa-minus-circle' title='Quitar' width='20px' height='20px'></i></td></tr>");
                if(datos[d].situacionentrega!="A"){
                    carro.push(datos[d].idservicio);
                }else{
                    $("#Quitar"+datos[d].idservicio).css('display','none');
                }
                calcularTotalItem(datos[d].idservicio);
                $(':input[data="numero"]').inputmask('decimal', { radixPoint: ".", autoGroup: true, groupSeparator: "", groupSize: 3, digits: 2 });
                eval("var planes"+datos[d].idservicio+" = new Bloodhound({"+
                    "datumTokenizer: function (d) {"+
                        "return Bloodhound.tokenizers.whitespace(d.value);"+
                    "},"+
                    "limit: 10,"+
                    "queryTokenizer: Bloodhound.tokenizers.whitespace,"+
                    "remote: {"+
                        "url: 'medico/medicoautocompletar/%QUERY',"+
                        "filter: function (planes"+datos[d].idservicio+") {"+
                            "return $.map(planes"+datos[d].idservicio+", function (movie) {"+
                                "return {"+
                                    "value: movie.value,"+
                                    "id: movie.id,"+
                                "};"+
                            "});"+
                        "}"+
                    "}"+
                "});"+
                "planes"+datos[d].idservicio+".initialize();"+
                "$('#txtMedico"+datos[d].idservicio+"').typeahead(null,{"+
                    "displayKey: 'value',"+
                    "source: planes"+datos[d].idservicio+".ttAdapter()"+
                "}).on('typeahead:selected', function (object, datum) {"+
                    "$('#txtMedico"+datos[d].idservicio+"').val(datum.value);"+
                    "$('#txtIdMedico"+datos[d].idservicio+"').val(datum.id);"+
                    "copiarMedico('"+datos[d].idservicio+"');"+
                "});");
                $("#txtMedico"+datos[d].idservicio).focus(); 

            } 
            $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="coa"]').attr("readonly","true");
            $(".datofactura").css("display","none");
        }
    });
}

function buscarProducto2(valor){
    $.ajax({
        type: "POST",
        url: "compra/buscarproducto",
        data: "descripcion="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val()+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
        success: function(a) {
            datos=JSON.parse(a);
            var strTable = "<table class='table table-bordered table-condensed table-hover' border='1' id='tablaProducto'><thead class='bg-navy'><tr>";
            @if ($conf_codigobarra=="S")
                strTable = strTable + "<th class='text-center'>Cod. Barra</th>";
            @endif   
            strTable = strTable + "<th class='text-center'>Producto</th><th class='text-center'>Stock</th><th class='text-center'>P. Unit.</th></tr></thead><tbody id='tbodyProducto'></tbody></table>";
            $("#divBusqueda").html(strTable);
            var pag=parseInt($("#pag").val());
            var d=0;
            
            $('#tablaProducto').DataTable({
                "scrollY":        "250px",
                "scrollCollapse": true,
                "paging":         false
            });
            $('#tablaProducto_filter').css('display','none');
            $("#tablaProducto_info").css("display","none");
        }
    });
}
buscarProducto2();
function generarNumero(){
    $.ajax({
        type: "POST",
        url: "movimientoalmacen/generarNumero",
        data: "tipodocumento="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="tipodocumento"]').val()+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
        success: function(a) {
            $(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="numero"]').val(a);
        }
    });
}

function cambiarMotivo() {
    var tipo = $(IDFORMMANTENIMIENTO + '{{ $entidad }}' + " :input[id='tipodocumento']").val();	
    var data = $.ajax({
        type: "POST",
        url: "movimientoalmacen/cambiarMotivo",
        data: "tipo="+tipo+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
    });
    //var ruta = 'movimientoalmacen/cambiarMotivo?tipo='+tipo;
    //var respuesta = '';
    //var data = sendRuta(ruta);
    data.done(function(msg) {
        respuesta = msg;
    }).fail(function(xhr, textStatus, errorThrown) {
        
    }).always(function() {
        data = JSON.parse(respuesta);
        $(IDFORMMANTENIMIENTO + '{{ $entidad }}' + " :input[id='motivo_id']").html(data.motivos);
        actualizarDivSucursal();
    });
    
}

function cambiarSucursalDestino() {
    var sucursal_id = $(IDFORMMANTENIMIENTO + '{{ $entidad }}' + " :input[id='sucursal_id']").val();
    if(sucursal_id == ""){
        $(IDFORMMANTENIMIENTO + '{{ $entidad }}' + " :input[id='sucursaldestino']").html("<option value=''>SELECCIONE SUCURSAL</option>");
    }else{
        var data = $.ajax({
            type: "POST",
            url: "movimientoalmacen/cambiarSucursalDestino",
            data: "sucursal_id="+sucursal_id+"&_token="+$(IDFORMMANTENIMIENTO + '{!! $entidad !!} :input[name="_token"]').val(),
        });
        data.done(function(msg) {
            respuesta = msg;
        }).fail(function(xhr, textStatus, errorThrown) {
            
        }).always(function() {
            data = JSON.parse(respuesta);
            $(IDFORMMANTENIMIENTO + '{{ $entidad }}' + " :input[id='sucursaldestino']").html(data.sucursales);
        });
    }	
}

function actualizarProductos() {
    var producto = $(IDFORMMANTENIMIENTO + '{{ $entidad }} :input[id="descripcion"]').val();
    if(producto != ""){
        buscarProducto();
    }else{
        buscarProducto2();
    }
}

function actualizarDivSucursal() {
    $("#divsucursaldestino").hide();
    var motivo = $(IDFORMMANTENIMIENTO + '{{ $entidad }} :input[id="motivo_id"]').val();
    if(motivo == "3"){
        $("#divsucursaldestino").show();
    }
}

@php
if(!is_null($movimiento)){
    echo "agregarDetalle(".$movimiento->id.");";
}else{
    echo "generarNumero()";
}
@endphp
</script>

<style>
    .dataTables_scrollBody{
        overflow-x: scroll;
        border-radius: 0.25rem;
        border: 1px solid #001f3f;
        cursor: pointer;
    }
    .dataTables_scrollBody::-webkit-scrollbar{ 
        width: 10px;
        background-color: #001f3f;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb{ 
        border-radius: 5px;
        background-color: #e9ecef;
        border-left: 0.5px solid #001f3f;
    }
</style>