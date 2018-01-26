<div class="ofertas index">

	<header class="page-header">


                    <div class="panel-actions">

                        <!-- <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a> -->

                         <?=$this->Html->link('<i class="fa fa-plus"></i>', array(
										'controller'=>'ofertas',
										'action'=>'add',
										'admin'=>true,
										), array(
											'escape' => false,
										))?>

                        <a href="#modalAnim" id="modaladicionaradmlink" class="panel-action fa fa-plus modal-with-zoom-anim" style="display:none;"><i class="fa fa-plus"></i></a>

                    </div>

            <h2 class="panel-title">
				<?php echo __('Ofertas'); ?>
			</h2>

    </header>

             <?php echo $this->Session->flash(); ?>

	<div class="panel-heading">
		<h2 class="panel-title">
			<?php echo __('Filtros'); ?>
		</h2>
	</div>
	<?php
	$options['inputDefaults'] = array(
						'label' => false,
						'div' => false,
						'error'=> false,
						'class' => 'form-control',

					);


	echo $this->Form->create('Oferta', $options);
	?>
	<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Data</label>
								<?php echo $this->Form->text('data_origem', 
															  array('class' => 'form-control',
																	'required' => false)
															);?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Operação</label>
									<?php echo $this->Form->input('operacao_id',array(
									'empty' => 'Todos',
									'options' => $operacoes,
									'required' => false,
									));?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Status</label>
								<?php echo $this->Form->input('status_transporte',array(
									'empty' => 'Todos',
									'options' => $status,
									));?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Tipo</label>
								<?php echo $this->Form->input('tipo_lance',array(
									'empty' => 'Todos',
									'options' => $tipo,
									'required' => false,
									));?>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<button name="data[Oferta][status_show_app]" value="0" class="col-md-12 btn btn-warning">Importados</button>
						</div>
						<div class="col-md-6"></div>
						<div class="col-md-3">
							<button class="col-md-12 btn btn-primary">Filtrar</button>
						</div>
					</div>
	</div>
	<br>             
	<div class="panel-heading">
		<h2 class="panel-title">
			<?php echo __('Ofertas'); ?>
		</h2>
	</div>
	<div class="panel-body">

<!-- 	 <div class="search-control-wrapper" style="margin-bottom: 20px;margin-top: 20px;">
              <form action="" method="get">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" name="buscar" value="">
                    <span class="input-group-btn">
                      <button class="btn btn-primary">Buscar</button>
                    </span>
                  </div>
                </div>
               

              </form>
            </div> -->


	<div class="table-responsive">
	<table class= "table mb-none" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		
		
			<th><?php echo $this->Paginator->sort('cliente_origem'); ?></th>
			<th><?php echo $this->Paginator->sort('cliente_destino'); ?></th>

			<!-- <th><?php echo $this->Paginator->sort('cidade_origem'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('cidade_destino'); ?></th> -->

			<th><?php echo $this->Paginator->sort('data_origem'); ?></th>
			<th><?php echo $this->Paginator->sort('data_destino'); ?></th>

			<th><?php echo $this->Paginator->sort('peso_carga'); ?></th>
		
			<!-- <th><?php echo $this->Paginator->sort('volume_carga'); ?></th> -->

			<th><?php echo $this->Paginator->sort('caminhao_tipo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('carroceria_tipo_id'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('produto'); ?></th> -->
		
			<!-- <th><?php echo $this->Paginator->sort('valor_lance_inicial'); ?></th> -->

			<th><?php echo $this->Paginator->sort('Encerramento da Oferta'); ?></th>
		
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ofertas as $oferta): ?>
	<tr>
	
		
		<td><?php echo h($oferta['Cliente_origem']['nome']); ?>&nbsp;</td>
		<td><?=!empty($oferta['cliente_destino']['nome']) ? $oferta['cliente_destino']['nome'] : 'Nenhum'; ?>&nbsp;</td>

		<!-- <td><?php echo h($oferta['Oferta']['cidade_origem']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($oferta['Oferta']['cidade_destino']); ?>&nbsp;</td> -->

		<!-- <td><?php echo h($oferta['Oferta']['data_origem']); ?>&nbsp;</td> -->
		<td><?php echo $this->Time->format('d/m/Y', $oferta['Oferta']['data_origem'], $invalid = false, $timezone = null); ?></td>
		<!-- <td><?php echo h($oferta['Oferta']['data_destino']); ?>&nbsp;</td> -->
		<td><?php echo $this->Time->format('d/m/Y', $oferta['Oferta']['data_destino'], $invalid = false, $timezone = null); ?></td>

		
		<td><?php echo h($oferta['Oferta']['peso_carga'].' '.$oferta['Oferta']['und_medida']); ?>&nbsp;</td>
		
		<!-- <td><?php echo h($oferta['Oferta']['volume_carga']); ?>&nbsp;</td> -->
		
		<td><?php echo h($oferta['TipoVeiculo']['nome']); ?>&nbsp;</td>

		<td><?php echo h($oferta['TipoCarrocerium']['nome']); ?>&nbsp;</td>
		<!-- <td><?php echo h($oferta['Produto']['nome']); ?>&nbsp;</td> -->
	

		<!-- <td><?php echo h($oferta['Oferta']['valor_lance_inicial']); ?>&nbsp;</td> -->
		<td><?php echo h($oferta['Oferta']['data_encerramento']); ?>&nbsp;</td>
	
	
	
	
		<td class="actions">
			
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $oferta['Oferta']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $oferta['Oferta']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $oferta['Oferta']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
	<div class="panel-footer">
				<div class="dataTables_paginate paging_bs_normal">
				  <ul class="pagination">
				         <?php
				              echo $this->Paginator->prev(__('«'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				              echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li'));
				              echo $this->Paginator->next(__('»'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
				          ?>
				      </ul>
				</div>

			</div>


<script type="text/javascript">
	 $( function() {

		        $("#dataFiltroOfertas").datepicker("option", "monthNames", ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]);

		        $("#dataFiltroOfertas").datepicker("option", "dayNamesMin", ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'] );

			  } );
</script>