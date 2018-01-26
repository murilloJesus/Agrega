<?php

App::import('Vendor', 'Twilio', array('file' => 'Twilio' . DS . 'autoload.php'));
use Twilio\Rest\Client;
App::uses('AppController', 'Controller');
App::import('Vendor', 'PhpExcel', array('file' => 'PHPExcel/PHPExcel.php'));
App::uses('CakeTime', 'Utility');
/**
 * Ofertas Controller
 *
 * @property Oferta $Oferta
 * @property PaginatorComponent $Paginatorim
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class OfertasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash', 'PhpExcel');
	public $uses = array('Oferta', 'Produto','TipoCarrocerium','Usuario','Cliente','Produto', 'TipoVeiculo', 'Municipio', 'Estado', 'Operacao');

	public function beforeFilter(){
    parent::beforeFilter();

     header("Access-Control-Allow-Origin: *");
     
     $this->response->header(array(
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json'
        )
    );
}

/**
 * index method
 *
 * @return void
 */
	public function api_teste(){

			$sid = "AC8b7f68ca96e8e1d80488ece04a4531f7";
			$token = "6324fff070f1faae98c63700a9e37714";

			$client = new Client($sid, $token);
		
			$teste = $client->account->messages->create(
				    '+55-01599788-0780',
				    array(

				        'from' => '+1-509-956-4310',
				        'body' => "Uma nova senha foi gerada, Anote Sua Senha"
				    )
				);

	if($teste->IsError){

		echo($teste->ErrorMessage);
	}else{

		echo'sent sms';
	}

exit();
}



	public function api_filtro_oferta(){

	$q = $this->request->query;


	// $teste = explode(",",$q['produtos']);
		// print_r($q);
		// print_r($q['estado_origem']);
		// echo'<br>';
		// print_r($q['cidade_origem']);
		// 	echo'<br>';
		// print_r($q['estado_destino']);
		// 	echo'<br>';
		// print_r($q['cidade_destino']);



		// 	if($q['estado_origem'] == 0)
		// {

		// 	$q['estado_origem'] = '';
		// }

		// if($q['estado_destino'] == 0)
		// {

		// 	$q['estado_destino'] = '';
		// }


		// 	if($q['cidade_destino'] == 0)
		// {

		// 	$q['cidade_destino'] = '';
		// }

		// 	if($q['cidade_origem'] == 0)
		// {

		// 	$q['cidade_origem'] = '';
		// }



			if($q['estado_origem'] !== '')
		{
				//estado origem
		$options1['conditions']['Estado.UF'] = $q['estado_origem'];
		$ofertas1 = $this->Estado->find('all',$options1);

		$id_estado1 = $ofertas1[0]['Estado']['id'];
			
		}else{

				$id_estado1 = '';
		}

	
			if($q['estado_destino'] !== '')
		{
		//estado destino
	
		$options2['conditions']['Estado.UF'] = $q['estado_destino'];
		$ofertas2 = $this->Estado->find('all',$options2);

		$id_estado2 = $ofertas2[0]['Estado']['id'];
		

		}else{

				$id_estado2 = '';
		}



			if($q['cidade_origem'] !== '')
		{

		//cidade origem
		

		$options3['conditions']['Municipio.Nome'] = $q['cidade_origem'];
		$ofertas3 = $this->Municipio->find('all',$options3);

		$id_cidade1 = $ofertas3[0]['Municipio']['Id'];
	
		}else{

				$id_cidade1 = '';
		}

			if($q['cidade_destino'] !== '')
		{
		//cidade destino
		

		$options4['conditions']['Municipio.Nome'] = $q['cidade_destino'];
		$ofertas4 = $this->Municipio->find('all',$options4);

		$id_cidade2 = $ofertas4[0]['Municipio']['Id'];

		}else{

				$id_cidade2 = '';
		}

		



		$options['conditions']['AND']['Oferta.estado_origem LIKE'] = "%".$id_estado1."%";
		$options['conditions']['AND']['Oferta.cidade_origem LIKE'] = "%".$id_cidade1."%";

		$options['conditions']['AND']['Oferta.estado_destino LIKE'] = "%".$id_estado2."%";
		$options['conditions']['AND']['Oferta.cidade_destino LIKE'] = "%".$id_cidade2."%";

		$options['conditions']['AND']['Oferta.produto_id LIKE'] = "%".$q['produtos']."%";



		$options['conditions']['AND']['Oferta.carroceria_tipo_id LIKE'] = "%".$q['caminhao']."%";


		if($q['leilao'] != '' && $q['oferta'] !=''){


		$options['conditions']['AND']['Oferta.tipo_lance LIKE'] = "%";

		}else if($q['leilao'] != '' ){

		$options['conditions']['AND']['Oferta.tipo_lance LIKE'] = "%".$q['leilao']."%";
			
		}else if($q['oferta'] !=''){

		$options['conditions']['AND']['Oferta.tipo_lance LIKE'] = "%".$q['oferta']."%";
			
		}

		

		$usuario_id = $q['usuario'];
		$outros = $q['outros']; 
		// echo "<pre>";
			
			

		if(!empty($outros)){

			$ofertas = $this->Oferta->find('all',$options);

		

		}else{


		$conditions_user = array('conditions' => array(
		
				'Usuario.id' => $usuario_id,

				) 
			);


			$usuario = $this->Usuario->find('all',$conditions_user);


			$tipo_veiculo = $usuario['0']['Usuario']['tipo_veiculo'];
			$tipo_carroceria = $usuario['0']['Usuario']['tipo_carroceria'];

			

		$options['conditions']['AND']['Oferta.veiculo_tipo_id LIKE'] = "%".$tipo_veiculo."%";
		$options['conditions']['AND']['Oferta.carroceria_tipo_id LIKE'] = "%".$tipo_carroceria."%";


		}
			$ofertas = $this->Oferta->find('all',$options);
		
			if(!empty($ofertas)){

			echo json_encode($ofertas);
				
			}else{

			$ofertas['msg'] = 'nenhuma oferta';

			echo json_encode($ofertas);
			}
		// print_r($ofertas);
				exit();
}



	public function api_produtos(){

	$list = $this->Produto->find('list');

	echo json_encode($list);

	exit();
	}


	public function api_caminhoes(){


	$list = $this->TipoCarrocerium->find('list');

	

	// $list = $this->TipoCaminhao->find('list');
	
	echo json_encode($list);

	exit();
	}




	public function api_filtro_destino(){

		if ($this->request->is('post')) {

			$usuario_id = $this->request->data['usuario'];
			
			$estado_origem = $this->request->data['estado_origem'];
			$cidade_origem = $this->request->data['cidade_origem'];

			$estado_destino = $this->request->data['estado_destino'];
			$cidade_destino = $this->request->data['cidade_destino'];

			$caminhao = $this->request->data['caminhao'];
			$produtos = $this->request->data['produtos'];
			$outros = $this->request->data['outros'];


			if(!empty($outros)){



				
				$conditions = array('conditions' => array(

				
				'estado_destino' => $estado_destino,
				'cidade_destino' => $cidade_destino,
				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',
				

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

			}else{



				
				$conditions_user = array('conditions' => array(
		
				'Usuario.id' => $usuario_id,

				) 
			);


			$usuario = $this->Usuario->find('all',$conditions_user);


			$tipo_veiculo = $usuario['0']['Usuario']['tipo_veiculo'];
			$tipo_carroceria = $usuario['0']['Usuario']['tipo_carroceria'];

			$conditions = array('conditions' => array(

				
				'estado_origem' => $estado_origem,
				'cidade_origem' => $cidade_origem,
				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',
				// 'veiculo_tipo_id' => $tipo_veiculo,
				// 'carroceria_tipo_id' => $tipo_carroceria,

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

				


			}


			
			// 	echo "<pre>";
			// print_r($usuario);
					
			

			if(!empty($ofertas)){

				// echo "<pre>";
				echo json_encode($ofertas);
			// print_r($ofertas);	
			}else{
				// echo "<pre>";
				$resul['msg'] = 'nenhuma oferta';
				echo json_encode($resul);

			}
			
		}

		exit();

	}


	public function api_filtro_origem(){

		if ($this->request->is('post')) {

			$usuario_id = $this->request->data['usuario'];
			
			$estado_origem = $this->request->data['estado_origem'];
			$cidade_origem = $this->request->data['cidade_origem'];

			$estado_destino = $this->request->data['estado_destino'];
			$cidade_destino = $this->request->data['cidade_destino'];


			$outros = $this->request->data['outros'];

			$caminhao = $this->request->data['caminhao'];
			$produtos = $this->request->data['produtos'];


			if(!empty($outros)){



				
				$conditions = array('conditions' => array(

				
				'estado_origem' => $estado_origem,
				'cidade_origem' => $cidade_origem,
				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',
				

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

			}else{



				
				$conditions_user = array('conditions' => array(
		
				'Usuario.id' => $usuario_id,

				) 
			);


			$usuario = $this->Usuario->find('all',$conditions_user);


			$tipo_veiculo = $usuario['0']['Usuario']['tipo_veiculo'];
			$tipo_carroceria = $usuario['0']['Usuario']['tipo_carroceria'];

			$conditions = array('conditions' => array(

				
				'estado_origem' => $estado_origem,
				'cidade_origem' => $cidade_origem,
				
				'veiculo_tipo_id' => $tipo_veiculo,
				'carroceria_tipo_id' => $tipo_carroceria,
				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

				echo json_encode($ofertas);
				exit();


			}


			
			// 	echo "<pre>";
			// print_r($usuario);
					
			

			if(!empty($ofertas)){

				// echo "<pre>";
				echo json_encode($ofertas);
			// print_r($ofertas);	
			}else{
				// echo "<pre>";
				$resul['msg'] = 'nenhuma oferta';
				echo json_encode($resul);

			}
			
		}

		exit();

	}



	public function api_filtro(){

		if ($this->request->is('post')) {

			$usuario_id = $this->request->data['usuario'];
			
			$estado_origem = $this->request->data['estado_origem'];
			$cidade_origem = $this->request->data['cidade_origem'];

			$estado_destino = $this->request->data['estado_destino'];
			$cidade_destino = $this->request->data['cidade_destino'];


			$outros = $this->request->data['outros'];

			$caminhao = $this->request->data['caminhao'];
			$produtos = $this->request->data['produtos'];


			if(!empty($outros)){

				$conditions = array('conditions' => array(

				
				'Oferta.estado_origem' => $estado_origem,
				'Oferta.cidade_origem' => $cidade_origem,
				'Oferta.estado_destino' => $estado_destino,
				'Oferta.cidade_destino' => $cidade_destino,

				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

			}else{



				
				$conditions_user = array('conditions' => array(
		
				'Usuario.id' => $usuario_id,

				) 
			);


			$usuario = $this->Usuario->find('all',$conditions_user);


			$tipo_veiculo = $usuario['0']['Usuario']['tipo_veiculo'];
			$tipo_carroceria = $usuario['0']['Usuario']['tipo_carroceria'];

			$conditions = array('conditions' => array(

				
				'estado_origem' => $estado_origem,
				'cidade_origem' => $cidade_origem,
				'estado_destino' => $estado_destino,
				'cidade_destino' => $cidade_destino,
				'Oferta.produto_id LIKE' => $produtos.'%',
				'Oferta.carroceria_tipo_id LIKE' => $caminhao.'%',
				// 'carroceria_tipo_id' => '3', s

				) 
			);


			$ofertas = $this->Oferta->find('all',$conditions);

				// echo json_encode($ofertas);
				// exit();


			}


			
			// 	echo "<pre>";
			// print_r($usuario);
					
			

			if(!empty($ofertas)){

				// echo "<pre>";
				echo json_encode($ofertas);
			// print_r($ofertas);	
			}else{
				// echo "<pre>";
				$resul['msg'] = 'nenhuma oferta';
				echo json_encode($resul);

			}
			
		}

		exit();

	}



public function api_contratos(){

	if(!empty($this->request->query)){

		$usuario_id = $this->request->query['usuario'];

	

		$conditions = array('conditions' => array(
			'user_winner_id' => $usuario_id,
			) 
		);

		$ofertas = $this->Oferta->find('all',$conditions);
		
		
	

	}


		
		if(!empty($ofertas)){

			echo json_encode($ofertas);

		}else{

			$result['erro'] = "sem contrato";

			echo json_encode($result);

		}

	exit();

}



public function api_list(){

			
	if(!empty($this->request->query)){


		// $this->Paginator->settings = array('limit' => 5);

		$conditions =  array('conditions' => array(
			'Usuario.id' => $this->request->query['usuario'],
		) );

		$usuario = $this->Usuario->find('first',$conditions);

		// print_r($usuario);
		// exit();
		// $origem_favorito = $usuario['Usuario']['origem_favorito'];
		// $destino_favorito = $usuario['Usuario']['destino_favorito'];

			if(!empty($origem_favorito) && !empty($destino_favorito) ){

				$conditions2 = array('conditions' => array(
					'estado_origem' => $origem_favorito,
					'estado_destino' => $destino_favorito,
				) );


				$this->Paginator->settings = array('limit' => 10,$conditions2);

			    $list = $this->Paginator->paginate('Oferta');




				// $list = $this->Oferta->find('all',$conditions2);

			 if(empty($list)){

			 	$list = $this->Oferta->find('all');
				// $list = $this->Paginator->paginate('Oferta');
			 }

				
			}else{
			 	$list = $this->Oferta->find('all');
				// $list = $this->Paginator->paginate('Oferta');
				
			}
			// debug($list);
	echo json_encode($list);
	}

	 exit();





}

	public function index() {
		$this->Oferta->recursive = 0;
		$this->set('ofetas', $this->Paginator->paginate());
	}

	public function api_paginacao() {
		
		$ofertas = $this->Paginator->paginate();

		foreach ($ofertas as $key => $value) {
			# code...
		echo"<pre>";
		print_r($value['Oferta']['id']);
		}
		exit();	
	}	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Oferta->exists($id)) {
			throw new NotFoundException(__('Invalid Oferta'));
		}
		$options = array('conditions' => array('Oferta.' . $this->Oferta->primaryKey => $id));
		$this->set('Oferta', $this->Oferta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Oferta->create();
			if ($this->Oferta->save($this->request->data)) {
				$this->Flash->success(__('The Oferta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Oferta could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Oferta->id = $id;
		if (!$this->Oferta->exists()) {
			throw new NotFoundException(__('Invalid Oferta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Oferta->delete()) {
			$this->Flash->success(__('The Oferta has been deleted.'));
		} else {
			$this->Flash->error(__('The Oferta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {

		if (isset($this->data['Oferta'])) {

			$filtros = $this->data['Oferta'];

			$arrayFiltros = array();

			foreach ($filtros as $key => $value) {
				if ($value != '') {
					$arrayFiltros["Oferta.".$key] = $value;
				}
			}

			$this->Oferta->recursive = 0;
			$this->Paginator->settings = array(
	        	'conditions' => $arrayFiltros,
	    	);
	    }
		// debug($this->Paginator->paginate());
		//exit();
		$this->set('ofertas', $this->Paginator->paginate());
		// echo'<pre>';
		// print_r($this->Paginator->paginate());
		// exit();

		$tipo = array(
			'Leilão' => 'Leilão',
			'Oferta' => 'Oferta',
			 );

		$status = array(
				0 => 'Contratado',
				1 => 'No Patio',
				2 => 'Em Transito',
				3 => 'Entregue',
			 );

		$operacoes = $this->Operacao->find('list');

		$this->set(compact('status', 'operacoes', 'tipo'));


	}




	public function admin_finalizadas() {


		$ofertas = $this->Oferta->find('all', array(

			'conditions' => array(
				'status_lance' => 'Finalizado'
			)

		));

		// debug($ofertas);
		// exit();


		// $this->Oferta->recursive = 0;
		$this->set('ofertas', $ofertas);

	}



/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Oferta->exists($id)) {
			throw new NotFoundException(__('Invalid Oferta'));
		}
		$options = array('conditions' => array('Oferta.' . $this->Oferta->primaryKey => $id));
		$this->set('Oferta', $this->Oferta->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {

					$arrayOptions = array(
			'Sim' => 'Sim',
			'Não' => 'Não',
			 );

		$status_possiveis = array(
				0 => 'Contratado', 
				1 => 'Não Contratado', 
				2 => 'Liberado', 
				3 => 'Cancelado', 
				4 => 'Recusado', 
				5 => 'Repassado' 
			);

		$agendados = array(
			'Sim' => 'Sim',
			'Não' => 'Não',
			 );

		$TipoVeiculo = array(
			'Truck' => 'Truck',
			'Carreta' => 'Carreta',
			 );

		$TipoOferta = array(
			'Leilão' => 'Leilão',
			'Oferta' => 'Oferta',
			 );

		$und_medidas = array(
			'Tonelada' => 'Tonelada',
			'Kg' => 'Kg',
			 );

		$produtos = $this->Produto->find('list');
		$carrocerias = $this->TipoCarrocerium->find('list');
		$clientes = $this->Cliente->find('list');
		$motoristas = $this->Usuario->find('list');
		$municipios = $this->Municipio->find('all', array( 
												 'fields' =>  array('Municipio.Codigo',
																	'Municipio.Nome', 
																	'Municipio.Uf', 
																	'Municipio.id')
												)
										);
		$estados = $this->Estado->find('all', array( 
												 'fields' =>  array(
																	'Estado.nome', 
																	'Estado.UF', 
																	'Estado.id')
												)
										);

		// $this->set('TipoOferta',$TipoOferta);
		// $this->set('und_medidas',$und_medidas);
		// $this->set('carrocerias',$carrocerias);
		// $this->set('clientes',$clientes);
		// $this->set('produtos',$produtos);
		// $this->set('TipoVeiculo',$TipoVeiculo);
		// $this->set('agendados',$agendados);
		// $this->set('arrayOptions',$arrayOptions);
		// $this->set('status_possiveis', $status_possiveis);
		// $this->set('motoristas', $motoristas);
		// $this->set('municipios', $municipios);
		// $this->set('estados', $estados);


		$this->set(compact('TipoOferta', 'und_medidas', 'carrocerias', 'clientes', 'produtos', 'TipoVeiculo', 'agendados', 'arrayOptions', 'status_possiveis', 'motoristas', 'municipios', 'estados'));
		//$this->set('data_origem', $data_origem);
		//$this->set('data_destino', $data_destino);


		if ($this->request->is('post')) {


		// debug($this->request->data);
		$peso = $this->request->data['Oferta']['peso_carga'];

		$und = $this->request->data['Oferta']['und_medida'];

		$contrato = rand(1, 10);
		// debug($this->request->data['Oferta']['peso_carga']);
		// debug($this->request->data['Oferta']['und_medida']);

		$dados = array($peso,$und);
		$final = join(" ",$dados);
		// debug($peso);
		// debug($und);


		// debug($final);
		$data = (string) date("Y");
		// $data_new = date("Y", $data);

		// $this->request->data['Oferta']['data'] = $data;
		
		$codigo = (string) rand();

		$codigo_new = substr($codigo,-7);
		$contrato = "#".$codigo_new."/".$data;


		$this->request->data['Oferta']['cod_contrato'] = $contrato;

		// $this->request->data['Oferta']['contrato1'] = $data;
		// $this->request->data['Oferta']['contrato2'] = $codigo;


		$this->request->data['Oferta']['peso_carga'] = $final;
		// debug($this->request->data);
		// exit();
		// exit();

			$this->request->data['Oferta']['user_name'] = $this->Session->read("Usuarios.id");

			$cliente_origem1 = $this->request->data['Oferta']['cliente_origem'];
			$cliente_destino1 = $this->request->data['Oferta']['cliente_destino'];

			$conditions3 = array('conditions' => array('Cliente.id' => $cliente_origem1));

			$conditions4 = array('conditions' => array('Cliente.id' => $cliente_destino1));

			$cliente1 = $this->Cliente->find('all',$conditions3);


			$cliente2 = $this->Cliente->find('all',$conditions4);


			$this->request->data['Oferta']['cliente_origem'] = $cliente1[0]['Cliente']['nome'];
			$this->request->data['Oferta']['cliente_destino'] = $cliente2[0]['Cliente']['nome'];


			$this->Oferta->create();
			if ($this->Oferta->save($this->request->data)) {

				$this->Oferta->id = $this->Oferta->getLastInsertId();


				$this->Oferta->save(array('status_lance' => 'Ativo'));



				$this->Flash->success(__('Oferta Criada Com Sucesso'));

				return $this->redirect(array('action' => 'index'));

			} else {

			$errors = $this->Oferta->validationErrors;
			$this->set('ValidateAjay',$errors);


			$this->Flash->render($errors);

			}
		}



	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	
	public function admin_ofertas_finalizadas() {

	exit();

	}


	public function admin_edit($id = null) {

					$arrayOptions = array(
			'Sim' => 'Sim',
			'Não' => 'Não',
			 );

		$status_possiveis = array(
				0 => 'Contratado',
				1 => 'No Patio',
				2 => 'Em Transito',
				3 => 'Entregue',
			);

		$agendados = array(
			'Sim' => 'Sim',
			'Não' => 'Não',
			 );

		$TipoVeiculo = array(
			'Truck' => 'Truck',
			'Carreta' => 'Carreta',
			 );

		$TipoOferta = array(
			'Leilão' => 'Leilão',
			'Oferta' => 'Oferta',
			 );

		$und_medidas = array(
			'Tonelada' => 'Tonelada',
			'Kg' => 'Kg',
			 );

		$produtos = $this->Produto->find('list');
		$carrocerias = $this->TipoCarrocerium->find('list');
		$clientes = $this->Cliente->find('list');
		$motoristas = $this->Usuario->find('list');
		$municipios = $this->Municipio->find('list');
		$estados = $this->Estado->find('list');


		// $this->set('TipoOferta',$TipoOferta);
		// $this->set('und_medidas',$und_medidas);
		// $this->set('carrocerias',$carrocerias);
		// $this->set('clientes',$clientes);
		// $this->set('produtos',$produtos);
		// $this->set('TipoVeiculo',$TipoVeiculo);
		// $this->set('agendados',$agendados);
		// $this->set('arrayOptions',$arrayOptions);
		// $this->set('status_possiveis', $status_possiveis);
		// $this->set('motoristas', $motoristas);
		// $this->set('municipios', $municipios);
		// $this->set('estados', $estados);


		
		//$this->set('data_origem', $data_origem);
		//$this->set('data_destino', $data_destino);
			$this->set(compact('TipoOferta', 'und_medidas', 'carrocerias', 'clientes', 'produtos', 'TipoVeiculo', 'agendados', 'arrayOptions', 'status_possiveis', 'motoristas', 'estados','municipios'));

		if (!$this->Oferta->exists($id)) {
			throw new NotFoundException(__('Invalid Oferta'));
		}


		if ($this->request->is(array('post', 'put'))) {

			$this->request->data['Oferta']['id'] = $id;
			
			if(!empty($cliente_origem1) && !empty($cliente_destino1) ){
	
				$cliente_origem1 = $this->request->data['Oferta']['cliente_origem'];
				$cliente_destino1 = $this->request->data['Oferta']['cliente_destino'];

				$conditions3 = array('conditions' => array('Cliente.id' => $cliente_origem1));

				$conditions4 = array('conditions' => array('Cliente.id' => $cliente_destino1));

				$cliente1 = $this->Cliente->find('all',$conditions3);


				$cliente2 = $this->Cliente->find('all',$conditions4);
				

				$this->request->data['Oferta']['cliente_origem'] = $cliente1[0]['Cliente']['nome'];
				$this->request->data['Oferta']['cliente_destino'] = $cliente2[0]['Cliente']['nome'];
			
			}

			$this->request->data['Oferta']['status_show_app'] = $this->request->data['Oferta']['motorista_id'] != null ? 0 : 1;

			$valor1 = str_replace('.','',$this->request->data['Oferta']['valor_lance_inicial']);
			$valorfinal = str_replace(',','.',$valor1);
			$this->request->data['Oferta']['valor_lance_inicial'] = $valorfinal;

			$valor2 = str_replace('.','',$this->request->data['Oferta']['lance_minimo']);
			$valorfinal1 = str_replace(',','.',$valor2);
			$this->request->data['Oferta']['lance_minimo'] = $valorfinal1;


			// echo "<pre>";
			// print_r($this->request->data);
			// exit();


 			if ($this->Oferta->save($this->request->data)) {
				$this->Flash->success(__('The Oferta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {


			$errors = $this->Oferta->validationErrors;

			// debug($errors);
			$this->set('ValidateAjay',$errors);

			$this->Flash->render($errors);

			}
		} else {



			$options = array('conditions' => array('Oferta.' . $this->Oferta->primaryKey => $id));
			$this->request->data = $this->Oferta->find('first', $options);



			// echo"<pre>";
			// print_r($this->request->data);
			// exit();
	
		}


		

	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Oferta->id = $id;
		if (!$this->Oferta->exists()) {
			throw new NotFoundException(__('Invalid Oferta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Oferta->delete()) {
			$this->Flash->success(__('The Oferta has been deleted.'));
		} else {
			$this->Flash->error(__('The Oferta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_import()
	{


		$operacao = $this->Operacao->find('list');

		$this->set(compact('operacao'));

		if ($this->request->is('post')) {

			ini_set("memory_limit",-1);
			//debug($this->request->data);
			//exit();
			$file = $this->request->data['Oferta']['Planilha'];

		    $maxCols = 16;
			$row_numero = 0;

		    $log = array(
				'add_sucesso' => 0,
		    	'update_sucesso' => 0,
		    	'add_falha' => 0,
		    	'update_falha' => 0
		    );
			
		    $dados_erro = array();
			try{
				$planilha = $this->PhpExcel->loadWorksheet($file['tmp_name']);
			}catch(Exception $e){
				$this->Flash->import('Falha ao importar', array(
					'params' => array(
						'class' => 'danger',
					)
				));
				return $this->redirect(array('action' => 'import'));
			}
			

			$header = $this->PhpExcel->getTableData($maxCols);
			//debug($header);
			//exit();
			$this->veiculos = new foreingKeyControl('tipo_veiculo', 'nome', 'id');
			$this->clientes = new foreingKeyControl('clientes', 'nome', 'id');
			$this->estados = new foreingKeyControl('estados', 'uf', 'id');
			$this->municipios = new foreingKeyControl('municipios', 'nome', 'id');

			$operacao = $this->request->data['Oferta']['operacao'];

	    	while ($row = $this->PhpExcel->getTableData($maxCols)) {

	    		$oferta = array();
				$this->Oferta->create();
				if($row[0] == '') continue;

				$oferta['doc_transporte'] = $row[0];
				$oferta['data_origem'] = $this->toDate($row[1], $row[2]);
				$oferta['veiculo_tipo_id'] = $this->veiculos->getId($row[3]);
				$oferta['external_cod_cliente'] = $row[4];
				$oferta['cliente_origem'] = $this->clientes->getId($row[5]);
				$oferta['estado_origem'] = $this->estados->getId($row[7]);
				$oferta['cidade_origem'] = $this->municipios->getId($row[8]);
				$oferta['peso_carga'] = $this->pesoCarga($row[10]);
				$oferta['und_medida'] = $this->uni_medidaCarga($row[10]);
				$oferta['data_destino'] = $this->toDate($row[12], $row[13], $row[15]);
				$oferta['status_show_app'] = 0;	    		
				$oferta['cod_contrato'] = $contrato;	 		

	    		// $this->Usuario->save($usuario);
	    		if ($n = $this->Oferta->save($oferta)) {
	    			// if (!empty($usuario['id'])) {
	    				$log['add_sucesso']++;
	    			// }else{
	    				// $log['update_sucesso']++;
	    			// }

	    		}else{
					// debug($this->Usuario->validationErrors);
					 	// exit();
	    			// if (!empty($usuario['id'])) {
	    				$log['add_falha']++;
	    			// }else{
	    				// $log['update_falha']++;
	    			// }

	    			$dados_erro[] = $row;

				}

			}	
			
			
	    	/*if (count($dados_erro) != 0) {
	    		//return $this->exportErros($dados_erro, $log);
	    	}else{
				//return $this->Flash->import('Ofertas importadas com sucesso', array(
					'params' => array(
						'class' => count($dados_erro) != 0 ? 'warning' : 'success',
						'dados' => $log,
					)
				));
			}*/

		}
		
	}

	private function pesoCarga($peso){
		if($peso >= 1000)
		{
			$peso = $peso/1000;
			return intval($peso);

		}else{
			return  intval($peso);
		}
	}

	private function uni_medidaCarga($peso){
		if($peso >= 1000)
		{
			return 'Tg';

		}else{
			return  'kg';
		}
	}

	private function toDate($data, $hora, $dataSec = null){

	 	$vet_data = $data == 'Imediato' ? $dataSec : $data;
	 	$vet_hora =  $data == 'Imediato' ? '0' : $hora;

	 	$formated_data = gmdate("Y-m-d", date(PHPExcel_Shared_Date::ExcelToPHP($vet_data)));
	 	$formated_hora = PHPExcel_Style_NumberFormat::toFormattedString($vet_hora, 'hh:mm:ss');

	 	return $formated_data.' '.$formated_hora;
	 }

	private function exportErros($data = array(), $log = array())
	{

		ob_start();
		$this->PhpExcel->createWorksheet()
			->setDefaultFont('Calibri', 12);

		$table = array(
		    array('label' => __('DT')),
		    array('label' => __('DATA SOLICITAÇÃO')),
		    array('label' => __('HORA SOLICITAÇÃO')),
		    array('label' => __('TIPO DE VEICULO')),
		    array('label' => __('Cód Cli')),
		    array('label' => __('Cliente')),
		    array('label' => __('UF')),
		    array('label' => __('Cidade')),
		    array('label' => __('CHEP')),
		    array('label' => __('Peso Cubado')),
		    array('label' => __('Valor da Carga')),
		    array('label' => __('DATA ENTREGA')),
		    array('label' => __('HORA ENTREGA')),
		    array('label' => __('CONFIRMADO')),
		    array('label' => __('DATA EXPEDIÇÃO')),
		);

		$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

		foreach ($data as $d) {
		    $this->PhpExcel->addTableRow(array(
				$d[0],
				$d[1],
				$d[2],
				$d[3],
				$d[4],
				$d[5],
				$d[6],
				$d[7],
				$d[8],
				$d[9],
				$d[10],
				$d[11],
				$d[12],
				$d[13],
				$d[14],
		    ));
		}

		$url_arquivo = 'imports/registros_falha_import_'.date('d-m-Y_H:i:s').'.xlsx';
		$this->PhpExcel->save(str_replace(__FILE__,$url_arquivo,__FILE__));

		$this->Flash->import('Alguns itens não foram salvos', array(
			'params' => array(
				'class' => 'warning',
				'dados' => $log,
				'url_arquivo' => $url_arquivo
			)
		));
		
		return $this->redirect(array(
			'action' => 'import',
		));

	}

}

 
class foreingKeyControl extends  AppController
{
	private $conn;
	private $table;
	private $index = array();
	
	function __construct($table, $foreing, $primary)
	{

		$this->table = $table;
		$this->foreing = $foreing;
		$this->primary = $primary;

		$query = "SELECT $primary, $foreing FROM $table where 1";
		$results = $this->Oferta->query($query);

		foreach ( $results as $key ) 
		{
			$this->index[$key[$table][$foreing]] = $key[$table][$primary];
		}
	}

	public function getId($valor)
	{
		if(isset($this->index[$valor]))
		{
			return $this->index[$valor];

		}else{

			$query = "INSERT INTO $this->table ($this->foreing) VALUES ('$valor')";
			$this->Oferta->query($query);

			$query = "SELECT $this->primary, $this->foreing FROM $this->table where 1";
			$results = $this->Oferta->query($query);

			foreach ( $results as $key ) 
			{
				$this->index[$key[$this->table][$this->foreing]] = $key[$this->table][$this->primary];
			}

			return $this->index[$valor];
		}
	}
}

