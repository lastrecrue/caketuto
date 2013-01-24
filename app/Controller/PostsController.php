<?php

class PostsController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Votre post a été sauvegardé.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Impossible d\'ajouter votre post.');
            }
        }
    }

    public function edit($id = null) {
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Votre post a été mis à jour.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Impossible de mettre à jour votre post.');
            }
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('Le Post avec l\'id ' . $id . ' a été supprimé.');
            $this->redirect(array('action' => 'index'));
        }
    }

}