<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketCreateForm;
use nikitakls\support\forms\ticket\TicketEditForm;
use nikitakls\support\models\Content;
use nikitakls\support\models\Ticket;
use nikitakls\support\repo\TicketRepo;

/**
 * Class SupportService
 * @package nikitakls\support\services
 * @author nikitakls
 */
class SupportService
{
    /**
     * @var TicketRepo
     */
    protected $repo;

    /**
     * SupportService constructor.
     * @param TicketRepo $repo
     */
    public function __construct(TicketRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param TicketCreateForm $form
     * @param int $userId
     * @return Ticket
     */
    public function createUser(TicketCreateForm $form, $userId)
    {
        return $this->create($form, Content::createUser($form->content, $userId));
    }

    /**
     * @param TicketCreateForm $form
     * @param $content
     * @return Ticket
     */
    protected function create(TicketCreateForm $form, $content)
    {
        $model = Ticket::create($form);
        $model->addContent($content);
        $this->repo->save($model);
        return $model;
    }

    /**
     * @param TicketCreateForm $form
     * @param int $userId
     * @return Ticket
     */
    public function createSupport(TicketCreateForm $form, $userId)
    {
        return $this->create($form, Content::createSupport($form->content, $userId));
    }

    /**
     * @param TicketCreateForm $form
     * @return Ticket
     */
    public function createGuest(TicketCreateForm $form)
    {
        return $this->create($form, Content::createUser($form->content, null));
    }

    /**
     * @param int $id
     * @param TicketEditForm $form
     * @return Ticket
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit($id, TicketEditForm $form)
    {
        $model = $this->repo->get($id);
        $model->edit($form);
        $this->repo->save($model);
        return $model;
    }

    /**
     * @param int $ticketId
     * @param ContentCreateForm $form
     * @param $userId
     * @return Ticket
     * @throws \yii\web\NotFoundHttpException
     */
    public function addSupportContent($ticketId, ContentCreateForm $form, $userId)
    {
        $ticket = $this->repo->get($ticketId);
        $ticket->setAnswered();
        $content = Content::createSupport($form, $userId);
        return $this->addContent($ticket, $content);
    }

    /**
     * @param Ticket $ticket
     * @param $content
     * @return Ticket
     */
    protected function addContent(Ticket $ticket, $content)
    {
        $ticket->addContent($content);
        $this->repo->save($ticket);
        return $ticket;
    }

    /**
     * @param int $ticketId
     * @param ContentCreateForm $form
     * @param $userId
     * @return Ticket
     * @throws \yii\web\NotFoundHttpException
     */
    public function addUserContent($ticketId, ContentCreateForm $form, $userId)
    {
        $ticket = $this->repo->get($ticketId);
        $ticket->setWait();
        $content = Content::createUser($form, $userId);
        return $this->addContent($ticket, $content);
    }

    /**
     * @param int $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function remove($id)
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }

}