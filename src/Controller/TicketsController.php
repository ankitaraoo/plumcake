<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class TicketsController extends AppController 
{
    public function initialize()
    {
        parent::initialize();
        
        
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        //To make tags action available unauthenticated
        $this->Auth->allow(['tags']);
        //$this->Auth->allow(['projects']);
        //$tickets = 
         
    }
    public function index()
    {
        $this->loadComponent('Paginator');
        
        $tickets = $this->Paginator->paginate($this->Tickets->find());
        $this->set(compact('tickets'));

    }
    public function view($slug)
    {
        $ticket = $this->Tickets->findBySlug($slug)->firstOrFail();
        $this->set(compact('ticket'));
    }
    public function add()           //Add a ticket into the system
    {
        $ticket = $this->Tickets->newEntity();
        
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

             // Changed: Set the user_id from the session.
            $ticket->user_id = $this->Auth->user('id');
            
            //}
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Your ticket has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            }
            $this->Flash->error(__('Unable to add your ticket.'));
        
         //Get a list of tags.
        $tags = $this->Tickets->Tags->find('list');
        
        // Set tags to the view context
        $this->set('tags', $tags);
        
        // Get a list of projects.
        //$projects = $this->Tickets->Projects->find('list');

        // Set tags to the view context
        //$this->set('projects', $projects);
        
        //$status = $this->Tickets->Status->find('list');
        
        //$this->set('status', $status);
        
        $this->set('ticket', $ticket);
    
    }
    public function edit($slug)          //Edit ticket, project, status, tags
    {
        $ticket = $this->Tickets->findBySlug($slug)->contain('Tags')->firstOrFail();
        if ($this->request->is(['post', 'put'])) 
        {
            $this->Tickets->patchEntity($ticket, $this->request->getData(),['accessibleFields' => ['user_id' => false]]);
            if ($this->Tickets->save($ticket)) 
            {
                $this->Flash->success(__('Your ticket has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your ticket.'));
        }

        $this->set('ticket', $ticket);   
    }
    
    /*public function comment()       //Add comments
    {
        
    }*/
    
    public function delete($slug)        //Delete ticket - user
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->findBySlug($slug)->firstOrFail();
        if ($this->Tickets->delete($ticket)) 
        {
            $this->Flash->success(__('The {0} ticket has been deleted.', $ticket->title));
            return $this->redirect(['action' => 'index']);
        }
    }
    public function tags(...$tags)
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $tickets = $this->Tickets->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'tickets' => $tickets,
            'tags' => $tags
        ]);
        
    }
    
    /*public function projects(...$projects)   //something is wrong in this code
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        //$projects = $this->request->getParam('pass');
        $this->modelFactory(
            'Ticket',
            ['Tickets', '[app/src/Model/Ticket.php', 'get']
        );
        // Use the ArticlesTable to find tagged articles.
        $this->loadModel('Projects','Ticket');
        $projects = $this->Tickets->find('of', [
                //'limit' => 5,
                'projects' => $projects,
                'order' => 'Articles.created DESC'
        ]);
        //$projects = $this->Projects->find('of', [
        //    'projects' => $projects
        //]);

        // Pass variables into the view template context.
        $this->set([
            'tickets' => $tickets,
            'projects' => $projects
        ]);
    } */
    
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the article belongs to the current user.
        $ticket = $this->Tickets->findBySlug($slug)->first();

        return $ticket->user_id === $user['id'];
    }
    
    
    /*public function getTags($slug)
    {
       $query = $this->Tickets->find();
        $query = $query
           ->select('Tags.title')
            ->leftJoinWith('Tags')
            ->leftJoinWith('Tickets_Tags')
            ->where(['Articles.slug IS' => $slug]);
        return $query;
 
    }*/
    
}