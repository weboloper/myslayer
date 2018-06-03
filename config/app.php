<?php

return [

    /*
    +----------------------------------------------------------------+
    |\ Application Debugging                                        /|
    +----------------------------------------------------------------+
    |
    | To easily track your bugs, by defining it to true, you
    | can get a full error response
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    +----------------------------------------------------------------+
    |\ Language Settings                                            /|
    +----------------------------------------------------------------+
    |
    | The place where you should supposed to assign which
    | language folder will be used
    |
    */

    'lang' => 'en',

    /*
    +----------------------------------------------------------------+
    |\ Default Timezone                                             /|
    +----------------------------------------------------------------+
    |
    | The system time to be, useful for CRUD records that will be
    | based on the timezone for created, updated, and deleted
    | timestamps
    |
    */

    'timezone' => 'UTC',

    /*
    +----------------------------------------------------------------+
    |\ SSL Support                                                  /|
    +----------------------------------------------------------------+
    |
    | Mark true if your domain supports ssl, and to enforce
    | re-write for every module's url into https
    |
    */

    'ssl' => [
        'main' => false,
    ],

    /*
    +----------------------------------------------------------------+
    |\ Base URI                                                     /|
    +----------------------------------------------------------------+
    |
    | It is not an accurate way to use server catched base uri,
    | this options helps our command line interface (cli) to use
    | the defined module's base uri.
    |
    | This is also helpful when using the request()->module(...), it
    | builds the guzzle/guzzle package
    |
    */

    'base_uri' => [
        'main' => 'slayer.app',
    ],

    /*
    +----------------------------------------------------------------+
    |\ Session Name                                                 /|
    +----------------------------------------------------------------+
    |
    | It will be the name of your session located in the browser's
    | console, rename it to change your session name
    |
    | Note: Provide an alphanumeric character without any special
    | character
    |
    */

    'session' => 'slayer',

    /*
    +----------------------------------------------------------------+
    |\ Database Adapter                                             /|
    +----------------------------------------------------------------+
    |
    | Define your database adapter, base it on database.php config
    | file
    |
    */

    'db_adapter' => env('DB_ADAPTER'),

    /*
    +----------------------------------------------------------------+
    |\ NoSQL Adapter                                                /|
    +----------------------------------------------------------------+
    |
    | Define your nosql adapter, base it on database.php config
    | file, the default adapter is "mongo1"
    |
    */

    'nosql_adapter' => 'mongo1',

    /*
    +----------------------------------------------------------------+
    |\ Cache Adapter                                                /|
    +----------------------------------------------------------------+
    |
    | Define your cache adapter, base it on cache.php config file,
    | the default adapter is "file"
    |
    */

    'cache_adapter' => env('CACHE_ADAPTER', 'file'),

    /*
    +----------------------------------------------------------------+
    |\ Queue Adapter                                                /|
    +----------------------------------------------------------------+
    |
    | Define your queue adapter, base it on queue.php config file,
    | the default adapter is "beanstalk"
    |
    */

    'queue_adapter' => env('QUEUE_ADAPTER', 'beanstalk'),

    /*
    +----------------------------------------------------------------+
    |\ Session Adapter                                              /|
    +----------------------------------------------------------------+
    |
    | Define your session adapter, base it on session.php config file,
    | the default adapter is "file"
    |
    */

    'session_adapter' => env('SESSION_ADAPTER', 'file'),

    /*
    +----------------------------------------------------------------+
    | Flysystem                                                     /|
    +----------------------------------------------------------------+
    |
    | A file system handler that manages your files to an organizable
    | or manageable storage area such as (AWS S3)
    |
    */

    'flysystem' => 'local',

    /*
    +----------------------------------------------------------------+
    |\ Error Handler                                                /|
    +----------------------------------------------------------------+
    |
    | An error handler that dispatches all errors for specific
    | instance
    |
    */

    'error_handler' => Components\Exceptions\Handler::class,

    /*
    +----------------------------------------------------------------+
    |\ Mailer Settings                                              /|
    +----------------------------------------------------------------+
    |
    | To be able to send an email, provide your email
    | settings, such as adapters and the like
    |
    */

    'mail_adapter' => env('MAIL_ADAPTER', 'swift'),

    /*
    +----------------------------------------------------------------+
    |\ Logging Time                                                 /|
    +----------------------------------------------------------------+
    |
    | Try to choose "monthly", "daily", "hourly" to log separate files
    | else provide a boolean false to disable
    |
    */

    'logging_time' => false,

    /*
    +----------------------------------------------------------------+
    |\ Authentication Settings                                      /|
    +----------------------------------------------------------------+
    |
    | This auth settings will help you to easily authenticate your
    | users from your form inputs
    |
    */

    'auth' => [
        'model'          => Components\Model\Users::class,
        'password_field' => 'password',
        'redirect_key'   => 'ref',
    ],

    /*
    +----------------------------------------------------------------+
    |\ Application Encryption                                       /|
    +----------------------------------------------------------------+
    |
    | This handles the Phalcon\Crypt, in which you could encrypt
    | or decrypt data.
    |
    */

    'encryption' => [
        'key'    => env('APP_KEY'),
        'cipher' => 'aes-256-cbc',

        # you don't need to change this when you're
        # under 3.0.x Phalcon which uses openssl
        # this only applies under 2.0.x Phalcon
        // 'cipher' => 'rijndael-256',
        'mode'   => 'cbc',
    ],

    /*
    +----------------------------------------------------------------+
    |\ Service Providers                                            /|
    +----------------------------------------------------------------+
    |
    | A service will be stored and available to call using the
    | di()->get(<alias>) function
    |
    */

    'services' => [
        # This must be on top to log things to
        # all supporting providers
        Clarity\Providers\Log::class,

        Clarity\Providers\Aliaser::class,
        Components\Providers\Application::class,
        Components\Providers\Auth::class,
        Components\Providers\Acl::class,
        Clarity\Providers\Cache::class,
        Clarity\Providers\CollectionManager::class,
        Clarity\Providers\Console::class,
        Clarity\Providers\Crypt::class,
        Clarity\Providers\DB::class,
        Components\Providers\Dispatcher::class,
        Clarity\Providers\ErrorHandler::class,
        Clarity\Providers\Filter::class,
        Clarity\Providers\Flash::class,
        Clarity\Providers\Flysystem::class,
        Clarity\Lang\LangServiceProvider::class,
        Clarity\Mail\MailServiceProvider::class,
        Clarity\Providers\MetadataAdapter::class,
        Clarity\Providers\Module::class,
        Clarity\Providers\Mongo::class,
        Clarity\Providers\Queue::class,
        Clarity\Providers\Redirect::class,
        Clarity\Providers\Request::class,
        Clarity\Providers\Response::class,
        Clarity\Providers\Router::class,
        Clarity\Providers\RouterAnnotations::class,
        Clarity\Providers\Session::class,
        Clarity\Providers\URL::class,
        Clarity\View\ViewServiceProvider::class,

        Components\Providers\ModelsManager::class,
        Components\Providers\View::class,

        # register your providers below.
        // App\Main\Providers\RouterServiceProvider::class,
        App\Blog\Providers\RouterServiceProvider::class,
        App\Users\Providers\RouterServiceProvider::class

        # register your sandbox providers below.
        // Acme\Acme\AcmeServiceProvider::class,
    ],

    /*
    +----------------------------------------------------------------+
    |\ Class Aliases                                                /|
    +----------------------------------------------------------------+
    |
    | Instead of using a full class namespace, you could defined
    | below an alias of your class
    |
    */

    'aliases'  => [
        'Auth'        => Clarity\Facades\Auth::class,
        'Acl'         => Components\Library\Acl\Manager::class,
        'Cache'       => Clarity\Facades\Cache::class,
        'CLI'         => Clarity\Console\CLI::class,
        'Config'      => Clarity\Facades\Config::class,
        'DB'          => Clarity\Facades\DB::class,
        'File'        => Clarity\Facades\Flysystem::class,
        'FileManager' => Clarity\Facades\FlysystemManager::class,
        'Filter'      => Clarity\Facades\Filter::class,
        'Flash'       => Clarity\Facades\Flash::class,
        'Lang'        => Clarity\Lang\LangFacade::class,
        'Log'         => Clarity\Facades\Log::class,
        'Mail'        => Clarity\Mail\MailFacade::class,
        'Queue'       => Clarity\Facades\Queue::class,
        'Redirect'    => Clarity\Facades\Redirect::class,
        'Request'     => Clarity\Facades\Request::class,
        'Response'    => Clarity\Facades\Response::class,
        'Route'       => Clarity\Facades\Route::class,
        'Security'    => Clarity\Facades\Security::class,
        'Session'     => Clarity\Facades\Session::class,
        'Tag'         => Clarity\Facades\Tag::class,
        'URL'         => Clarity\Facades\URL::class,
        'View'        => Clarity\Facades\View::class,
    ],

    /*
    +----------------------------------------------------------------+
    |\ Middlewares                                                  /|
    +----------------------------------------------------------------+
    |
    | Callable key classes on before route is called, this helps
    | to filter every request on a nicer way
    |
    */

    'middlewares' => [
        'auth'          => Components\Middleware\Auth::class,
        'csrf'          => Components\Middleware\CSRF::class,
        'permission'    => Components\Middleware\Permission::class,
    ],

]; # end of return
