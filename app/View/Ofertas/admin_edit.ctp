<?php
// print_r($municipios);
// exit();
?>



<script type="text/javascript">
$.ajax({
	url: 'http://mobitap.com.br/agrega_backoffice/json_estados/estados_cidades.json',
	type: 'GET',
	dataType: 'json',

})
.done(function(data) {

	var items = [];
	var options = '<option value="">Escolha um estado</option>';

	$.each(data, function (key, val) {
					options += '<option value="' + val.sigla + '">' + val.nome + '</option>';
				});	

	// $("#OfertaEstadoOrigem").html(options);



	$("#OfertaEstadoOrigem").change(function () {				
				
					var options_cidades = '<option value="">Escolha uma cidade</option>';
					var str = "";					
					
					$("#OfertaEstadoOrigem option:selected").each(function () {
						str += $(this).text();
					});
					
					localStorage.setItem('str',str);

					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.cidades, function (key_city, val_city) {
								options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					// $("#OfertaCidadeOrigem").html(options_cidades);


					
				}).change();


	
})
.fail(function() {
	console.log("error");
})
.always(function() {
	console.log("complete");
});


$.ajax({
	url: 'http://mobitap.com.br/agrega_backoffice/json_estados/estados_cidades.json',
	type: 'GET',
	dataType: 'json',
	async: true,

})
.done(function(data) {

	var items = [];
	var options1 = '<option value="">Escolha um estado</option>';

	$.each(data, function (key, val) {
					options1 += '<option value="' + val.sigla + '">' + val.nome + '</option>';
				});	

	// $("#OfertaEstadoDestino").html(options1);
	


	// $("#OfertaEstadoDestino").change(function () {				
				
	// 				var options_cidades = '<option value="">Escolha uma cidade</option>';
	// 				var str = "";					
					
	// 				$("#OfertaEstadoDestino option:selected").each(function () {
	// 					str += $(this).text();
	// 				});
					
	// 				$.each(data, function (key, val) {
	// 					if(val.nome == str) {							
	// 						$.each(val.cidades, function (key_city, val_city) {
	// 							options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
	// 						});							
	// 					}
	// 				});

	// 				// $("#OfertaCidadeDestino").html(options_cidades);
					
	// 			}).change();


	
})
.fail(function() {
	console.log("error");
})
.always(function() {
	console.log("complete");
});


	// $("#OfertaEstadoDestino").html(options);


	
	



</script>
<div class="Oferta form">

	<div class="row">
		<div class="col-md-12">
			<div class="panel">

			<header class="page-header">


                    <div class="panel-actions">

                        <!-- <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a> -->

                        <!-- <a href="http://mobitap.com.br/agrega_backoffice/admin/produtos/add" class="btadicionaradm panel-action"><i class="fa fa-plus"></i></a> -->

                        <a href="#modalAnim" id="modaladicionaradmlink" class="panel-action fa fa-plus modal-with-zoom-anim" style="display:none;"><i class="fa fa-plus"></i></a>

                    </div>

                    <h2 class="panel-title">Ofertas</h2>

            </header>
<?php echo $this->Session->flash(); ?>


 
				<div class="panel-heading">
					<h3 class="panel-title">
						<?php echo __('Editar Frete'); ?>
					</h3>
				</div>
				<div class="panel-body">




					<?php

					$options['inputDefaults'] = array(
						'label' => false,
						'div' => false,
						'error'=> false,
						'class' => 'form-control',

					);


					$options['novalidate'] = 'novalidate';

					// $options['type'] ='file';

					$options1 = array(
						'label' => false,
						'class' => 'btn btn-primary',
						'action' => 'edit',

					);



					echo $this->Form->create('Oferta', $options);
					?>

				<h3> Dados dos Clientes </h3>
				<div class="row">
					<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Cliente origem</label>

								<?php echo $this->Form->input('cliente_origem',array(
									'empty' => 'Escolha',
									'options' => $clientes,
									));?>




							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
							<label class="control-label">Cliente destino</label>

								<?php echo $this->Form->input('cliente_destino',array(
									'empty' => 'Escolha',
									'options' => $clientes,
									));?>

							</div>
						</div>
					</div>


						<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Estado de origem</label>
								<span class="required" aria-required="true">*</span>

				
								<?php echo $this->Form->input('estado_origem',array(
									'empty' => 'Escolha',
									'options' => $estados,
									// 'class' => 'selectpicker',
									// 'data-live-search' => 'true',	  
									));?>

								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								
								<label class="control-label">Estado de destino</label>

						
								<?php echo $this->Form->input('estado_destino',array(
									'empty' => 'Escolha',
									'options' => $estados,
									// 'class' => 'selectpicker',
									// 'data-live-search' => 'true',
									));?>
								
							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Cidade de origem</label>
								
								<select class="selectpicker form-control" data-none-selected-text="Selecione o Motorista" data-live-search="true">

									<?php 
								foreach ($municipios as $key => $value) {
									echo "<option data-tokens='$key $value' value='$key' >$value</option>";
								}
								 ?>

									
								</select>


								
								<!-- <?php echo $this->Form->input('cidade_origem',array(
									'empty' => 'Escolha',
									'options' => $municipios,
									// 'class' => 'selectpicker1',
									// 'data-live-search' => 'true',
									));?> -->



							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Cidade de destino</label>
								<!-- <select class="selectpicker form-control" data-none-selected-text="Selecione o Motorista" data-live-search="true"> -->


								<?php echo $this->Form->input('cidade_origem',array(
									'empty' => 'Escolha',
									'options' => $municipios,
									'class' => array('form-control','selectpicker'),
									'data-live-search' => 'true',
									'data-none-selected-text'=>'Selecione o estado'
									));?> 


								<!-- </select> -->
							</div>
						</div>
					</div>


					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Endereço de origem</label>

								<?php echo $this->Form->input('endereco_origem');?>




							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Endereço de destino</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('endereco_destino');?>

							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">data de origem</label>

								<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar">

									</i>

								</span>
								<?php echo $this->Form->input('data_origem',
								array(
								'class'=>'form-control',
								'type' => 'datetime-local',
								'timeFormat'=>'24',
								'dateFormat' => 'DMYHS',
								));?>

							</div>




							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							
								<label class="control-label">data de destino</label>
								<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar">

									</i>

								</span>
								<?php echo $this->Form->date('data_destino',
								array(
								'class'=>'form-control',
								'type' => 'datetime-local',
								'timeFormat'=>'24',
								'dateFormat' => 'DMYHS',
								));?>

							</div>


							</div>
						</div>
					</div>


					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

							<div class="form-group">
								<label class="control-label">telefone de origem</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('telefone_origem');?>

							</div>




							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">telefone de destino</label>

								<?php echo $this->Form->input('telefone_destino');?>


							</div>
						</div>
					</div>


					<hr>

					<h3>Dados da Carga</h3>

					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Agendado?</label>

								<?php echo $this->Form->input('agendado',array(
									'empty' => 'Escolha',
									'options' => $agendados,
									));?>




							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Peso da Carga</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('peso_carga');?>

							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Unidade de Medida</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('und_medida',array(
									'empty' => 'Escolha',
									'options' => $und_medidas,
									));?>

							</div>
						</div>

					</div>

					<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">volume da carga</label>

								<?php echo $this->Form->input('volume_carga');?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tipo de caminhao</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('veiculo_tipo_id',array(
									'empty' => 'Escolha',
									'options' => $TipoVeiculo,
									));?>

							</div>
						</div>
					</div>

						<div class="row">
							<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Produto</label>

								<?php echo $this->Form->input('produto_id',array(
									'empty' => 'Escolha',
									'options' => $produtos,
									));?>




							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">tipo carroceria</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('carroceria_tipo_id',array(
									'empty' => 'Escolha',
									'options' => $carrocerias,
									));?>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">

								<label class="control-label">Caminhao rastreado</label>

								<?php echo $this->Form->input('caminhao_rastreado',array(
									'empty' => 'Escolha',
									'options' => $arrayOptions,
									));?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Status da Oferta</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('status_lance',array(
									'empty' => 'Escolha',
									'options' => $status_possiveis,
									));?>

							</div>
						</div>
					</div>

					<hr>

					<h2>Dados do Motorista</h2>

					<hr>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Motorista</label>
								<span class="required" aria-required="true">*</span>
								<select class="selectpicker form-control" data-none-selected-text="Selecione o Motorista" name="data[Oferta][motorista_id]" data-live-search="true">
										<option data-tokens='Nenhum' value=''>Nenhum</option>
										<?php 
										foreach ($motoristas as $key => $value) {
											echo "<option data-tokens='$key $value' value='$key' >$value</option>";
										}
										 ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">CNH</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('cnh');?>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">RENAVAM</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('renavam');?>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nº OT</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('ot');?>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Placa Cavalo</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('plc_cavalo');?>

							</div>
						</div><div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Placa Carreta</label>
								<span class="required" aria-required="true">*</span>
								<?php echo $this->Form->input('plc_carreta');?>

							</div>
						</div>
					</div>

					<h2>Dados da Oferta</h2>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo Oferta</label>
									<span class="required" aria-required="true">*</span>

									<?php echo $this->Form->input('tipo_lance',array(
										'empty' => 'Escolha',
										'options' => $TipoOferta,

										));?>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">

									<label class="control-label">tempo finalizar lance</label>
									<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-calendar">

										</i>

									</span>
										<?php echo $this->Form->input('data_encerramento',
												array( 
												'type' => 'datetime-local',
												'timeFormat'=>'24',
												'dateFormat' => 'DMYHS',
												 
												));

										?>
								</div>
							</div>
						</div>				
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">valor do lance inicial</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('valor_lance_inicial',array(

									'id' => 'inicial',
									'type' => 'text',

								));?>

							</div>
						</div>
						<div class="col-md-6">	
						<div class="form-group">
								<label class="control-label">Valor do lance mínimo</label>
								<span class="required" aria-required="true">*</span>

								<?php echo $this->Form->input('lance_minimo',array(

									'id' => 'minimo',
									'type' =>'text'
									));?>

							</div>
						</div>


					</div>



<br>


<!-- <?php echo $this->Form->end(__('Editar')); ?> -->


<!-- <?php echo $this->Form->postLink(__('Editar'), array('action' => 'delete', )); ?> -->

<?php echo $this->Form->button('Editar',$options1); ?>


</div>

