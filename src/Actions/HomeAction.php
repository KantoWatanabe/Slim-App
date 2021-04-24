<?php
namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use App\Actions\Action;

class HomeAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->render('index.html.twig', ['name' => 'World']);
    }
}
