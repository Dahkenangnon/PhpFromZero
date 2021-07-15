<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use PhpFromZero\Controller\BaseController;
use PhpFromZero\Http\Request;
use PhpFromZero\Http\Response;

/**
 * User Controller
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class UserController extends BaseController
{
    // User repository
    protected $userRepo;


    public function __construct()
    {
        parent::__construct();

        $this->userRepo = new UserRepository();
    }

    /**
     * List of user
     * 
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/user_list.ep.php', [
            "users" => $this->userRepo->findAll()
        ]);
    }

    /**
     * A single user page
     * 
     * @param Request $request
     * 
     * @param int $id
     * 
     * @return Response
     */
    public function show(Request $request, int $id): Response
    {
        $user = $this->userRepo->findOneBy(["id" => $id]);

        if (!$user) {
            return $this->createErrorPage(404, [
                "error" => "L'utilisation avec l'id $id n'existe pas"
            ]);
        }

        return $this->render('user/user_show.ep.php', [
            "user" => $user
        ]);
    }


    /**
     * View my dashboard
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function me(Request $request): Response
    {
        return $this->render('user/user_me.ep.php', [
            "user" => $request->getUser()
        ]);
    }


    /**
     * Delete a user 
     * 
     * @param int $id 
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function delete(Request $request, int $id)
    {
        $this->userRepo->delete($id);
        return $this->redirect($request, "/user");
    }
}
