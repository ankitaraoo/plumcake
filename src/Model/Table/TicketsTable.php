<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Cake\ORM\Query;

//use Cake\ORM\TableRegistry;

class TicketsTable extends Table
{
    public function initialize(array $config)
    {
        //$this->getTable('tickets'); //getalltables??
        $this->addBehavior('Timestamp');
        $this->belongsToMany('Tags', [
            //'foreignKey' => 'tag_id',
            //'targetForeignKey' => 'ticket_id',
            'joinTable' => 'tickets_tags'
        ]);
        $this->hasMany('Status');
        $this->belongsTo('Projects')
           //->setJoinType('INNER');
        ;
        //$this->belongsTo('Projects');
        //$this->belongsTo('Status');
    }
    public function validationDefault(Validator $validator) //Make status and tag mandatory
    {
        $validator
            ->notEmpty('title')
            ->minLength('title', 10)
            ->maxLength('title', 255)

            ->notEmpty('body')
            ->minLength('body', 10);

        return $validator;
    }
    public function beforeSave($event, $entity, $options) //Prepares slug from title
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
        if ($entity->project_string) {
            $entity->projects = $this->_buildProjects($entity->project_string);
        }
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 255);
        }
    }
    protected function _buildTags($tagString)
    {
        // Trim tags
        $newTags = array_map('trim', explode(',', $tagString));
        // Remove all empty tags
        $newTags = array_filter($newTags);
        // Reduce duplicated tags
        $newTags = array_unique($newTags);

        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
        }
    protected function _buildProjects($projectString)
    {
        // Trim tags
        $newProjects = array_map('trim', explode(',', $projectString));
        // Remove all empty tags
        $newProjects = array_filter($newProjects);
        // Reduce duplicated tags
        $newProjects = array_unique($newProjects);

        $out = [];
        $query = $this->Projects->find()
            ->where(['Projects.title IN' => $newProjects]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newProjects);
            if ($index !== false) {
                unset($newProjects[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $project) {
            $out[] = $project;
        }
        // Add new tags.
        foreach ($newProjects as $project) {
            $out[] = $this->Projects->newEntity(['title' => $project]);
        }
        return $out;
        }
    public function findTagged(Query $query, array $options)
    {
    $columns = [
        'Tickets.id', 'Tickets.user_id', 'Tickets.title',
        'Tickets.body', 'Tickets.created',
        'Tickets.slug',
    ];

    $query = $query
        ->select($columns)
        ->distinct($columns);

    if (empty($options['tags'])) {
        // If there are no tags provided, find articles that have no tags.
        $query->leftJoinWith('Tags')
            ->where(['Tags.title IS' => null]);
    } else {
        // Find articles that have one or more of the provided tags.
        $query->innerJoinWith('Tags')
            ->where(['Tags.title IN' => $options['tags']]);
    }

    return $query->group(['Tickets.id']);
    }    
    
    //Authentication function called in Controller
    
    public function isOwnedBy($ticketId, $userId) 
    {
        return $this->exists(['id' => $ticketId, 'user_id' => $userId]);
    }
}