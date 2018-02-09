<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketCreateForm;
use nikitakls\support\forms\ticket\TicketEditForm;
use nikitakls\support\models\Content;
use nikitakls\support\models\Ticket;
use nikitakls\support\repo\TicketRepo;

class SupportService
{

    protected $repo;

    public function __construct(TicketRepo $repo)
    {
        $this->repo = $repo;
    }

    public function createUser(TicketCreateForm $form, $userId)
    {
        return $this->create($form, Content::createUser($form->content, $userId));
    }

    protected function create(TicketCreateForm $form, $content)
    {
        $model = Ticket::create($form);
        $model->addContent($content);
        $this->repo->save($model);
        return $model;
    }

    public function createSupport(TicketCreateForm $form, $userId)
    {
        return $this->create($form, Content::createSupport($form->content, $userId));
    }

    public function createGuest(TicketCreateForm $form)
    {
        return $this->create($form, Content::createUser($form->content, null));
    }

    public function edit($id, TicketEditForm $form)
    {
        $model = $this->repo->get($id);
        $model->edit($form);
        $this->repo->save($model);
        return $model;
    }

    public function addSupportContent($ticketId, ContentCreateForm $form, $userId)
    {
        $ticket = $this->repo->get($ticketId);
        $ticket->setAnswered();
        $content = Content::createSupport($form, $userId);
        return $this->addContent($ticket, $content);
    }

    protected function addContent(Ticket $ticket, $content)
    {
        $ticket->addContent($content);
        $this->repo->save($ticket);
        return $ticket;
    }

    public function addUserContent($ticketId, ContentCreateForm $form, $userId)
    {
        $ticket = $this->repo->get($ticketId);
        $ticket->setWait();
        $content = Content::createUser($form, $userId);
        return $this->addContent($ticket, $content);
    }

    public function remove($id)
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }

}