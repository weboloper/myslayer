<?php

namespace App\Blog\Controllers;

class NewsfeedController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        // $this->middleware('auth');
        $this->middleware('acl');
    }

    /**
     * GET | This shows the final landing page, in which it is the newsfeed.
     *
     * @return mixed
     */
    public function index()
    {
        return view('newsfeed.showLandingPage');
    }
}
