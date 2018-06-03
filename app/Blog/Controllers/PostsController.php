<?php

namespace App\Blog\Controllers;

use Components\Model\Posts;
use Components\Model\Model;

class PostsController extends Controller
{
    /**
     * View the starting index of this resource
     *
     * @return mixed
     */
    public function index()
    { 
      list($itemBuilder, $totalBuilder) =
                Model::prepareQueriesPosts( false , false, 5);

      $totalPosts = $totalBuilder->getQuery()->setUniqueRow(true)->execute();

      $posts = $itemBuilder->getQuery()->execute();

      return view('posts.index')
              ->with('posts', $posts);;

       // $post = Posts::findFirst(1);

       // $tags = $post->getTerms();


       // foreach($tags as  $tag){
       //      $meta = $tag->getTaxonomy()->toArray();
        
       // }
    }

     
}
