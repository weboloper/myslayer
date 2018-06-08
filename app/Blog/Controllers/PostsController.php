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

      $post = Posts::findFirst(1);

      $post->setTitle( rand(5, 15) );

      $post->save();

      // list($itemBuilder, $totalBuilder) =
                // Model::prepareQueriesPosts( false , false, 5);

      // $totalPosts = $totalBuilder->getQuery()->setUniqueRow(true)->execute();

      // $posts = $itemBuilder->getQuery()->execute();

      $posts = [];

      return view('posts.index')
              ->with('posts', $posts);;

       // $post = Posts::findFirst(1);

       // $tags = $post->getTerms();


       // foreach($tags as  $tag){
       //      $meta = $tag->getTaxonomy()->toArray();
        
       // }
    }

    public function create()
    { 

      $post = new Posts;
      $title = rand(100000,99999999);
      $post->setTitle( $title );
      $post->setSlug( $title );
      $post->setType( "post" );
      $post->setBody( "post" );
      $post->setExcerpt( "post" );
      $post->setUserId(1);
      $post->setStatus("publish");

      if ($post->save() === false) {

          echo "Umh, We can't store robots right now: \n";

          $messages = $post->getMessages();

          foreach ($messages as $message) {
              echo $message, "\n";
          }
      } else {
          echo "Great, a new robot was created successfully!";
      }

      $posts = [];

      return view('posts.index')
              ->with('posts', $posts);;

 
    }

     
}
