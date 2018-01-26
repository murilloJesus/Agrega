<div class="lances view">
<h2><?php echo __('Lance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endereco Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['endereco_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cliente Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['cliente_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endereco Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['endereco_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cliente Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['cliente_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cidade Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['cidade_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cidade Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['cidade_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['estado_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['estado_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['data_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['data_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefone Origem'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['telefone_origem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefone Destino'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['telefone_destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destino Tipo'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['destino_tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agendado'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['agendado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Peso Carga'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['peso_carga']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume Carga'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['volume_carga']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caminhao Tipo Id'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['caminhao_tipo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Produto'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['produto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carroceria Tipo Id'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['carroceria_tipo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caminhao Rastreado'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['caminhao_rastreado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valor Lance Inicial'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['valor_lance_inicial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tempo Para Finalizar Lance'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['tempo_para_finalizar_lance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Lance'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['status_lance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['user_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lance['Lance']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lance'), array('action' => 'edit', $lance['Lance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lance'), array('action' => 'delete', $lance['Lance']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $lance['Lance']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Lances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lance'), array('action' => 'add')); ?> </li>
	</ul>
</div>
