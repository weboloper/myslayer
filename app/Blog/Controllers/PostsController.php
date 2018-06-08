<?php

namespace App\Blog\Controllers;

use Components\Model\Posts;
use Components\Model\Model;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
class PostsController extends Controller
{   
    public function saveAction()
    {   
      
      $post = Posts::findFirst(1);

      $post->setTitle(rand(11111, 999999));

     
      // The model failed to save, so rollback the transaction
      if ($post->save() === false) {
           // db()->rollback();
          return;
      }
     
    }

    /**
     * View the starting index of this resource
     *
     * @return mixed
     */
    public function index()
    { 

      die(var_dump($_SESSION));
      
      $this->saveAction();

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
