<?php

namespace App\Users\Controllers;

use Exception;
use Components\Model\Users;
use Components\Validation\LoginValidator;
use Components\Validation\RegistrationValidator;
use Components\Validation\ForgetpassValidator;
use Phalcon\Mvc\Model\Transaction\Failed as TransactionFailed;
use Components\Library\Facebook\Auth as FacebookAuth;

class UsersController extends Controller
{   
    protected $userService;
    /**
     * {@inheritdoc}
     */
    public function initialize( )
    {
        $this->middleware('csrf', [
            'only' => [
                'attemptToLogin',
            ],
        ]);

         $this->userService = new \Components\Model\Services\Service\User;
    }

    
    public function inject(Components\Model\Services\Service\User $userService)
    {
        $this->userService = $userService;
    }

    /**
     * GET | This shows the form to register.
     *
     * @return mixed
     */
    public function showRegistrationForm()
    {   
        if(auth()->check())
        {   
            // auth()->destroy();
            return redirect()->to(url()->to('/'));
        }
        # find session if it has an 'input'
        if (session()->has('input')) {

            # get the session 'input' then remove it
            $input = session()->get('input');
            session()->remove('input');

            # set the tag 'email' to rollback the value inputted
            tag()->setDefault('email', $input['email']);
        }

        return view('auth.showRegistrationForm');
    }

    /**
     * POST | This handles the registration with validation.
     *
     * @return mixed
     */
    public function storeRegistrationForm()
    {   
        if(auth()->check())
        {   
            auth()->destroy();
            return redirect()->to(url()->to('/'));
        }

        $inputs = request()->get();

        $validator = new RegistrationValidator;
        $validation = $validator->validate($inputs);

        if (count($validation)) {
            session()->set('input', $inputs);

            return redirect()->to(url()->previous())
                ->withError(RegistrationValidator::toHtml($validation));
        }

        $token = bin2hex(random_bytes(100));

        $connection = db()->connection();

        try {
            $connection->begin();

            $user = new Users;

            $success = $user->create([
                'email' => $inputs['email'],
                'password' => security()->hash($inputs['password']),
                'token' => $token,
            ]);

            if ($success === false) {
                throw new Exception(
                    'It seems we can\'t create an account, '.
                    'please check your access credentials!'
                );
            }

            queue(
                // 'Components\Queue\Email@registeredSender',
                \Components\Queue\Email::class,
                [
                    'function' => 'registeredSender',
                    'template' => 'emails.registered-inlined',
                    'to' => $inputs['email'],
                    'url' => route('activateUser', ['token' => $token]),
                    'subject' => 'You are now registered, activation is required.',
                ]
            );

            $connection->commit();

        } catch (TransactionFailed $e) {
            $connection->rollback();
            throw $e;
        } catch (Exception $e) {
            $connection->rollback();
            throw $e;
        }

        return redirect()->to(route('showLoginForm'))
            ->withSuccess(lang()->get('responses/register.creation_success'));
    }

    /**
     * GET | This shows the login form.
     *
     * @return mixed
     */
    public function showLoginForm()
    {
        if(auth()->check())
        {   
            // auth()->destroy();
            return redirect()->to(url()->to('/'));
        }
        return view('auth.showLoginForm');
    }

    /**
     * POST | This handles the loging.
     *
     * @return mixed
     */
    public function attemptToLogin()
    {   
        if(auth()->check())
        {   
            auth()->destroy();
            return redirect()->to(url()->to('/'));
        }

        $inputs = request()->get();

        $validator = new LoginValidator;
        $validation = $validator->validate($inputs);

        if (count($validation)) {
            session()->set('input', $inputs);

            return redirect()->to(url()->previous())
                ->withError(LoginValidator::toHtml($validation));
        }

        $credentials = [
            'email' => $inputs['email'],
            'password' => $inputs['password'],
            'activated' => true,
        ];

        if (auth()->attempt($credentials)) {
            if ($redirect = auth()->redirectIntended()) {
                return $redirect;
            }

            return redirect()->to(url()->to('newsfeed'));
        }

        return redirect()->to(url()->previous())
            ->withError(lang()->get('responses/login.no_user'));
    }

    /**
     * GET, POST | This logouts the current session logged-in.
     *
     * @return mixed
     */
    public function logout()
    {
        auth()->destroy();

        return redirect()->to(route('showLoginForm'));
    }

    /**
     * GET | This activates a user record to be able to login.
     *
     * @return mixed
     */
    public function activateUser($token)
    {
        $user = Users::find([
            'token = :token: AND activated = :activated:',
            'bind' => [
                'token' => $token,
                'activated' => false,
            ],
        ])->getFirst();

        if (! $user) {
            flash()->session()->warning(
                'We cant find your request, please '.
                'try again, or contact us.'
            );

            return view('errors.404');
        }

        $user->setActivated(true);

        if ($user->save() === false) {
            foreach ($user->getMessages() as $message) {
                flash()->session()->error($message);
            }
        } else {
            flash()->session()->success(
                'You have successfully activated your account, '.
                'you are now allowed to login.'
            );
        }

        return redirect()->to(route('showLoginForm'));
    }


 


    /**
     * GET | This shows the form to register.
     *
     * @return mixed
     */
    public function showForgetPasswordForm()
    {   
        // if(auth()->check())
        // {   
        //     // auth()->destroy();
        //     return redirect()->to(url()->to('/'));
        // }

        if(request()->isPost()) {
            $inputs = request()->get();

            $inputs = request()->get();

            $validator = new ForgetpassValidator;
            $validation = $validator->validate($inputs);

            if (count($validation)) {
                session()->set('input', $inputs);

                return redirect()->to(url()->previous())
                    ->withError(ForgetpassValidator::toHtml($validation));
            }

            $user = $this->userService->getFirstByEmail( $inputs['email']);
            $params = $this->userService->resetPassword($user);

        }
        
        # find session if it has an 'input'
        if (session()->has('input')) {

            # get the session 'input' then remove it
            $input = session()->get('input');
            session()->remove('input');

            # set the tag 'email' to rollback the value inputted
            tag()->setDefault('email', $input['email']);
        }

        return view('auth.showForgetPasswordForm');
    }


    /**
     * GET | This shows the form to register.
     *
     * @return mixed
     */
    public function showResetPasswordForm()
    {   
        if(auth()->check())
        {   
            // auth()->destroy();
            return redirect()->to(url()->to('/'));
        }
        # find session if it has an 'input'
        if (session()->has('input')) {

            # get the session 'input' then remove it
            $input = session()->get('input');
            session()->remove('input');

            # set the tag 'email' to rollback the value inputted
            tag()->setDefault('email', $input['email']);
        }

        return view('auth.showResetPasswordForm');
    }

    
    /**
     * @return array|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function loginFacebook()
    {   

        // $this->middleware('auth');
        $this->view->disable();
        if (! $this->auth->check() ) {
            $auth = new FacebookAuth($this->config->app->facebook);
            return $auth->authorize();
        }
        $this->flashSession->success(t('Welcome back '. $this->auth->getName()));
        return $this->indexRedirect();
    }

     /**
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function tokenFacebook()
    {   

        $this->view->disable();
        $auth = new FacebookAuth($this->config->app->facebook);
        list($uid, $token, $user) = $auth->authorize();
        if (isset($token) && is_object($token)) {
            //Edit/Create the user
            $object = Users::findFirstByUuidFacebook($uid);
            $this->commonOauthSave($uid, $user, $token, $object, 'Facebook');
        } else {
            $this->flashSession->error('Invalid Google response. Please try again');
            return $this->response->redirect();
        }
    }

}
