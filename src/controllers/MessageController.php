<?php

namespace App\Controllers;

use App\Entities\Message;
use App\Forms\MessageForm;
use App\Repositories\MessageRepository;
use PhpFromZero\Controller\BaseController;
use PhpFromZero\Http\Request;
use PhpFromZero\Http\Response;

/**
 * Message Controller
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class MessageController extends BaseController
{

    // Message repository
    protected $messageRepo;


    public function __construct()
    {
        parent::__construct();

        $this->messageRepo = new MessageRepository();
    }


    /**
     * List of message
     */
    public function index(Request $request): Response
    {
        return $this->render('message/message_list.ep.php', [
            "messages" => $this->messageRepo->findBy(
                orderBy: [
                    "id" => "DESC",
                ],
                limit: 10,
                offset: 0
            )
        ]);
    }

    /**
     * A single message page
     * 
     * @param Request $request
     * 
     * @param int $id
     * 
     * @return Response
     */
    public function show(Request $request, int $id): Response
    {
        if (!$request->getUser()) {
            return $this->redirect($request, "/login");
        }


        $message = $this->messageRepo->findOneBy(["id" => $id]);

        if (!$message) {
            return $this->createErrorPage(404, [
                "error" => "Le message avec l'id $id n'existe pas"
            ]);
        }

        return $this->render('message/message_show.ep.php', [
            "message" => $message,
        ]);
    }


    /**
     * View my profile page
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function mine(Request $request)
    {
        if (!$request->getUser()) {
            return $this->redirect($request, "/login");
        }

        $user = $request->getUser();
        $messages = $this->messageRepo->findBy(["authorid" => $user->getId()]);

        return $this->render('message/message_mine.ep.php', [
            "messages" => $messages,
        ]);
    }

    /**
     * Post new message
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        if (!$request->getUser()) {
            return $this->redirect($request, "/login");
        }

        // Hold any error message
        $errorMsg = null;

        // Create the form
        $form = new MessageForm($request->getUrl());

        // Handle the form and prepare field form
        $form->handle($request);

        if ($form->isSubmitted()) {

            // Check passs correspondance
            $user = $request->getUser();

            $message = new Message();
            $message->setTitle($form->get("title"));
            $message->setContent($form->get("content"));
            $message->setAuthorid($user->getId());


            if (!$this->messageRepo->create($message)) {
                $errorMsg = "Une erreur e message d'être posté en db";
                goto sendResponse;
            }

            return $this->redirect($request, "/message/mine");
        }


        // Goto section
        sendResponse:
        return $this->render('auth/register.ep.php', [
            "form" => $form->render(),
            'error' => $errorMsg
        ]);
    }



    /**
     * Delete a message
     * 
     * @param Request $request
     * 
     * @param int $id 
     * 
     * @return Response
     *  
     */
    public function delete(Request $request, int $id)
    {
        $user = $request->getUser();

        if (!$user) {
            return $this->redirect($request, "/login");
        }

        if (!$user->isAdmin()) {
            return $this->createErrorPage(403, [
                "error" => "Seul l'admin peut supprimer"
            ]);
        }

        $this->messageRepo->delete($id);
        return $this->redirect($request, "/message");
    }
}
