<?php
namespace Components\Model;

use Components\Model\Traits\Timestampable;
use Components\Model\Traits\SoftDeletable;

use Components\Model\Posts;
use Components\Model\Terms;

class TermRelationships extends Model
{
    use Timestampable;
    use SoftDeletable;

    public function getSource()
    {
        return 'termrelationships';
    }
}

public function initialize()
{
    $this->belongsTo('post_id', Posts::class, 'id', ['alias' => 'post', 'reusable' => true]);
    $this->belongsTo('term_id', Terms::class, 'id', ['alias' => 'term', 'reusable' => true]);""
    
}

 