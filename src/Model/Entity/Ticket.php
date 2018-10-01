<?php

namespace App\Model\Entity;

use Cake\Collection\Collection;
use Cake\ORM\Entity;

class Ticket extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
    
protected function _getTagString()
{
    if (isset($this->_properties['tag_string'])) {
        return $this->_properties['tag_string'];
    }
    if (empty($this->tags)) {
        return '';
    }
    $tags = new Collection($this->tags);
    $str = $tags->reduce(function ($string, $tag) {
        return $string . $tag->title . ', ';
    }, '');
    return trim($str, ', ');
}    
/*
protected function _getProjectString()
{
    if (isset($this->_properties['project_string'])) {
        return $this->_properties['project_string'];
    }
    if (empty($this->projects)) {
        return '';
    }
    $projects = new Collection($this->projects);
    $str = $projects->reduce(function ($string, $project) {
        return $string . $project->title . ', ';
    }, '');
    return trim($str, ', ');
}*/

}