<div id="divMensajeError{!! $entidad !!}"></div>
{!! Form::model($modelo, $formData) !!}
{!! Form::hidden('listar', $listar, array('id' => 'listar')) !!}
<?php 
$abreviatura = "";
if($modelo->tipodocumento_id=="4"){
    //$abreviatura="F";
}elseif($modelo->tipodocumento_id=="5"){
    //$abreviatura="B";    
}else{
	//$abreviatura="T"; 
}
?>
{!! '<blockquote><p class="text-danger">¿Esta seguro de anular el comprobante '.utf8_encode($abreviatura.$modelo->numero).' ?</p></blockquote>' !!}
<div class="form-group">
	<div class="col-lg-12 col-md-12 col-sm-12 text-right">
		{!! Form::button('<i class="fa fa-trash fa-lg"></i> '.$boton, array('class' => 'btn btn-danger btn-sm', 'id' => 'btnGuardar', 'onclick' => 'guardar(\''.$entidad.'\', this)')) !!}
		{!! Form::button('<i class="fa fa-undo fa-lg"></i> Cancelar', array('class' => 'btn btn-default btn-sm', 'id' => 'btnCancelar'.$entidad, 'onclick' => 'cerrarModal((contadorModal - 1));')) !!}
	</div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
	$(document).ready(function() {
		init(IDFORMMANTENIMIENTO+'{!! $entidad !!}', 'M', '{!! $entidad !!}');
		configurarAnchoModal('350');
	}); 
</script>