<?php

namespace App\Blog\Controllers;

use Components\Model\Posts;

class PostsController extends Controller
{
    /**
     * View the starting index of this resource
     *
     * @return mixed
     */
    public function index()
    {
       $post = Posts::findFirst(1);

       $tags = $post->getTerms();


       foreach($tags as  $tag){
            $meta = $tag->getTaxonomy()->toArray();
            die(var_dump($meta));
       }
    }

     
}
