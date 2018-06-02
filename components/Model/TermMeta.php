<?php
namespace Components\Model;

use Components\Model\Traits\Timestampable;
use Components\Model\Traits\SoftDeletable;

use Components\Model\Terms;

class TermMeta extends Model
{
    use Timestampable;
    use SoftDeletable;

    public function getSource()
    {
        return 'termmeta';
    }

    public function initialize()
    {
        $this->belongsTo('term_id', Terms::class, 'id', ['alias' => 'term', 'reusable' => true]);
     }

}