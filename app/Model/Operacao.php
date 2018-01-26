<?php
App::uses('AppModel', 'Model');
/**
 * Operação Model
 *
 */
class Operacao extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */

	public $useTable = 'operacoes';

	public $displayField = 'nome';

}
