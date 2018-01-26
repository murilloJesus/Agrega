<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">

			<h2 class="panel-title">Selecionar Planilha</h2>
		</header>
		<div class="panel-body">
			<?php //echo $this->Flash->render(); ?>
			
			
			<?php 
				echo $this->Form->create('Oferta', $options = array(
					'url' => 'import',
				));
			?>
				
				<div class="form-group col-md-4">
					<?=$this->Form->input('operacao', array(
						"empty" => 'Selecione..',
						"options" => $operacao,
						"class" => "form-control",
						'required' => true
						)
					); ?>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Upload de planilha</label>
					<div class="col-md-8">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="input-append">
								<div class="uneditable-input">
									<i class="fa fa-file fileupload-exists"></i>
									<span class="fileupload-preview"></span>
								</div>
								<span class="btn btn-default btn-file">
									<span class="fileupload-exists">Alterar</span>
									<span class="fileupload-new">Selecione o arquivo</span>
									<?php 
										echo $this->Form->file('Planilha', array());
									?>
									<!-- <input type="file"> -->
								</span>
								<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remover</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<?php  
						echo $this->Form->submit('Enviar', array(
							'class' => 'btn btn-primary'
						));
					?>
				</div>
		</div>
	</section>
</div>




<?php 

	
/*
	echo $this->Form->file('Planilha', array(
		'accept'=>".xls,.xlsx"
	));

	echo $this->Form->submit('Enviar');
*/
 ?>

 
