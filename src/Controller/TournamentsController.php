<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tournaments Controller
 *
 * @property \App\Model\Table\TournamentsTable $Tournaments
 */
class TournamentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tournaments = $this->Tournaments->find('index', ['userId' => $this->Auth->user('id')]);
        $this->set(compact('tournaments'));
    }

    /**
     * View method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tournament = $this->Tournaments->get($id, contain: ['Games', 'TournamentMemberships']);
        $this->set(compact('tournament'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tournament = $this->Tournaments->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournament = $this->Tournaments->patchEntity($tournament, $this->request->getData());
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('The tournament has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament could not be saved. Please, try again.'));
        }
        $this->set(compact('tournament'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tournament = $this->Tournaments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournament = $this->Tournaments->patchEntity($tournament, $this->request->getData());
            if ($this->Tournaments->save($tournament)) {
                $this->Flash->success(__('The tournament has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament could not be saved. Please, try again.'));
        }
        $this->set(compact('tournament'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tournament = $this->Tournaments->get($id);
        if ($this->Tournaments->delete($tournament)) {
            $this->Flash->success(__('The tournament has been deleted.'));
        } else {
            $this->Flash->error(__('The tournament could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function join($tournamentId)
    {
        $this->request->allowMethod(['post', 'put']);
        if (!$this->request->is('ajax')) {
            throw new MethodNotAllowedException();
        }
        $tournament = $this->Tournaments->get($tournamentId);
        $tournament = $this->Tournaments->patchEntity($tournament, $this->request->getData());
        $tournament['tournament_memberships'][0]['user_id'] = $this->Auth->user('id');
        $this->Tournaments->save($tournament);
        $this->set(compact('tournament'));
        $this->render('/Element/Tournaments/join');
    }

    public function stats($slug)
    {
        $stats = $this->Tournaments->find('stats', compact('slug'))->firstOrFail();
        $this->set(compact('stats'));
    }
}
