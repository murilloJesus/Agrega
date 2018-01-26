<?php
App::uses('AppController', 'Controller');
/**
 * TipoVeiculos Controller
 *
 * @property TipoVeiculo $TipoVeiculo
 * @property PaginatorComponent $Paginator
 */
class TipoVeiculosController extends AppController {
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
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */




	public function api_caminhao()
	{
		
			// http://localhost/agrega_backoffice/api/TipoVeiculos/caminhao
		
		// exit('1');
		
	$caminhao = $this->TipoVeiculo->find("all");

	echo json_encode($caminhao);

	exit();

	}


	public function index() {
		$this->TipoVeiculo->recursive = 0;
		$this->set('TipoVeiculos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TipoVeiculo->exists($id)) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		$options = array('conditions' => array('TipoVeiculo.' . $this->TipoVeiculo->primaryKey => $id));
		$this->set('TipoVeiculo', $this->TipoVeiculo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoVeiculo->create();
			if ($this->TipoVeiculo->save($this->request->data)) {
				$this->Flash->success(__('The tipo caminhao has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tipo caminhao could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TipoVeiculo->exists($id)) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TipoVeiculo->save($this->request->data)) {
				$this->Flash->success(__('The tipo caminhao has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tipo caminhao could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TipoVeiculo.' . $this->TipoVeiculo->primaryKey => $id));
			$this->request->data = $this->TipoVeiculo->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TipoVeiculo->id = $id;
		if (!$this->TipoVeiculo->exists()) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TipoVeiculo->delete()) {
			$this->Flash->success(__('The tipo caminhao has been deleted.'));
		} else {
			$this->Flash->error(__('The tipo caminhao could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->TipoVeiculo->recursive = 0;
		$this->set('TipoVeiculos', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->TipoVeiculo->exists($id)) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		$options = array('conditions' => array('TipoVeiculo.' . $this->TipoVeiculo->primaryKey => $id));
		$this->set('TipoVeiculo', $this->TipoVeiculo->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TipoVeiculo->create();
			if ($this->TipoVeiculo->save($this->request->data)) {
				$this->Flash->success(__('The tipo caminhao has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tipo caminhao could not be saved. Please, try again.'));
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
	public function admin_edit($id = null) {
		if (!$this->TipoVeiculo->exists($id)) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TipoVeiculo->save($this->request->data)) {
				$this->Flash->success(__('The tipo caminhao has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The tipo caminhao could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TipoVeiculo.' . $this->TipoVeiculo->primaryKey => $id));
			$this->request->data = $this->TipoVeiculo->find('first', $options);
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
		$this->TipoVeiculo->id = $id;
		if (!$this->TipoVeiculo->exists()) {
			throw new NotFoundException(__('Invalid tipo caminhao'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TipoVeiculo->delete()) {
			$this->Flash->success(__('The tipo caminhao has been deleted.'));
		} else {
			$this->Flash->error(__('The tipo caminhao could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
