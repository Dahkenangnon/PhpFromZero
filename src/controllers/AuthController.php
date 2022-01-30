<?php

namespace App\Controllers;

use App\Entities\User;
use App\Forms\LoginForm;
use PhpFromZero\Http\Request;
use PhpFromZero\Http\Response;
use PhpFromZero\Security\SecurityController;
use App\Forms\RegisterForm;
use App\Repositories\UserRepository;
use PhpFromZero\Utils\Utils;


/**
 * Handle all thing about user's auth(entication|orization)
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class AuthController extends SecurityController
{

    // User repository
    protected $userRepo;


    public function __construct()
    {
        parent::__construct();

        $this->userRepo = new UserRepository();
    }


    /**
     * Login page
     * 
     * @param 
     */
    public function login(Request $request): Response
    {

        if ($request->getUser()) {
            return $this->redirect($request, "/user/me");
        }

        $form = new LoginForm($request->getUrl());
        $errorMsg = null;


        // Handle the form and prepare field form
        $form->handle($request);

        if ($form->isSubmitted()) {

            // Get data from the form
            $password = $form->get("password");
            $email = $form->get("email");

            // fetch the user
            $user = $this->userRepo->findOneBy(["email" => $email]);
            if (!$user) {
                $errorMsg =  "Utilisateur inconnu";
                goto sendResponse;
            }

            // Trying to authenticate
            if ($this->verifyPassWord($user->getPassword(), $password)) {

                // Set user in the sesstion

                $request->saveUser($user);
                
                return $this->redirect($request, "/user/me");
            }

            $errorMsg =  "Identifiants incorrect";
        }


        // Goto section
        sendResponse:
        return $this->render('auth/login.ep.php', [
            "form" => $form->render(),
            'error' => $errorMsg
        ]);
    }

    /**
     * Logout action
     */
    public function logout(Request $request)
    {
        $request->deleteUser();
        return $this->redirect($request, "/");
    }

    /**
     * Register page
     */
    public function register(Request $request): Response
    {

        if ($request->getUser()) {
            return $this->redirect($request, "/user/me");
        }

        // Hold any error message
        $errorMsg = null;

        // Create the form
        $form = new RegisterForm($request->getUrl());

        // Handle the form and prepare field form
        $form->handle($request);

        if ($form->isSubmitted()) {

            // Check passs correspondance
            $password = $form->get("password");
            $passwordConfirmation = $form->get("password_confirmation");
            if (0 !== strcmp($password, $passwordConfirmation)) {
                $errorMsg = "Les mot de passe ne correspondent pas";
                goto sendResponse;
            }

            // Has password before saving it into database
            $hasedPassword = $this->hashPassword($password);

            // Getting data from the form
            $user = new User();
            $user->setEmail($form->get("email"));
            $user->setName($form->get("name"));
            $user->setAge($form->get("age"));
            $user->setPassword($hasedPassword);

            // If any file, upload upload it and set the corresponded field
            $photo = $form->get("photo");
            if ($photo) {
                $uploadDir = $this->config->getPublicDir() . "/img";

                if ($filename = Utils::uploadFile($uploadDir, $photo)) {
                    $user->setPhoto($filename);
                } else {
                    $errorMsg = "Impossible d'envoyer la photo sur le serveur";
                    goto sendResponse;
                }
            }

            if (!$this->userRepo->create($user)) {
                $errorMsg = "Une erreur empêche votre inscription";
                goto sendResponse;
            }

            return $this->redirect($request, "/login");
        }


        // Goto section
        sendResponse:
        return $this->render('auth/register.ep.php', [
            "form" => $form->render(),
            'error' => $errorMsg
        ]);
    }
}
