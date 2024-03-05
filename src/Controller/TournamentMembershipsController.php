<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TournamentMemberships Controller
 *
 * @property \App\Model\Table\TournamentMembershipsTable $TournamentMemberships
 */
class TournamentMembershipsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->TournamentMemberships->find()
            ->contain(['Tournaments', 'Users']);
        $tournamentMemberships = $this->paginate($query);

        $this->set(compact('tournamentMemberships'));
    }

    /**
     * View method
     *
     * @param string|null $id Tournament Membership id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tournamentMembership = $this->TournamentMemberships->get($id, contain: ['Tournaments', 'Users']);
        $this->set(compact('tournamentMembership'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tournamentMembership = $this->TournamentMemberships->newEmptyEntity();
        if ($this->request->is('post')) {
            $tournamentMembership = $this->TournamentMemberships->patchEntity($tournamentMembership, $this->request->getData());
            if ($this->TournamentMemberships->save($tournamentMembership)) {
                $this->Flash->success(__('The tournament membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament membership could not be saved. Please, try again.'));
        }
        $tournaments = $this->TournamentMemberships->Tournaments->find('list', limit: 200)->all();
        $users = $this->TournamentMemberships->Users->find('list', limit: 200)->all();
        $this->set(compact('tournamentMembership', 'tournaments', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tournament Membership id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tournamentMembership = $this->TournamentMemberships->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tournamentMembership = $this->TournamentMemberships->patchEntity($tournamentMembership, $this->request->getData());
            if ($this->TournamentMemberships->save($tournamentMembership)) {
                $this->Flash->success(__('The tournament membership has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tournament membership could not be saved. Please, try again.'));
        }
        $tournaments = $this->TournamentMemberships->Tournaments->find('list', limit: 200)->all();
        $users = $this->TournamentMemberships->Users->find('list', limit: 200)->all();
        $this->set(compact('tournamentMembership', 'tournaments', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tournament Membership id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tournamentMembership = $this->TournamentMemberships->get($id);
        if ($this->TournamentMemberships->delete($tournamentMembership)) {
            $this->Flash->success(__('The tournament membership has been deleted.'));
        } else {
            $this->Flash->error(__('The tournament membership could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
