<?php
namespace Components\Model;

use Components\Model\Traits\Timestampable;
use Components\Model\Traits\SoftDeletable;

use Components\Model\TermRelationships;
use Components\Model\Terms;
use Components\Model\PostMeta;

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
            'term_id',
            ['alias' => 'terms']
        );

        $this->hasMany('id', PostMeta::class, 'meta_id', ['alias' => 'meta', 'reusable' => true]);
    }

}