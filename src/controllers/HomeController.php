<?php

namespace App\Controllers;

use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use PhpFromZero\Controller\BaseController;
use PhpFromZero\Http\Request;
use PhpFromZero\Http\Response;

/**
 * Home Controller
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class HomeController extends BaseController
{

    // User repository
    protected $userRepo;

    // Message repository
    protected $messageRepo;


    public function __construct()
    {
        parent::__construct();
        
        $this->userRepo = new UserRepository();
        $this->messageRepo = new MessageRepository();
    }


    /**
     * Display last 10 message
     * 
     * @param Request $request The HTTP request object
     * 
     * @return Response The HTTP response
     */
    public function index(Request $request): Response
    {
        return $this->render('home/index.ep.php', [
            'messages' => $this->messageRepo->findBy(
                orderBy: [
                    "id" => "DESC"
                ],
                limit: 10
            )
        ]);
    }



    /**
     * Render our about page
     */
    public function about(Request $request)
    {
        return $this->render('home/about.ep.php', []);
    }
}
