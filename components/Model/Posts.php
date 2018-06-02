<?php
namespace Components\Model;

use Components\Model\Traits\Timestampable;
use Components\Model\Traits\SoftDeletable;

use Components\Model\TermRelationships;

class Posts extends Model
{
    use Timestampable;
    use SoftDeletable;

    public function getSource()
    {
        return 'posts';
    }

    public function initialize()
    {
        $this->hasManyToMany(
            'id',
            TermRelationships::class,
            'post_id',
            'term_id',
            Terms::class,
            'id',
            ['alias' => 'terms']
        );
    }

}