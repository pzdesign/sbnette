<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Application\UI;

class KlubPresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
        $category = 'Klub';
        $this->template->klub = $this->database->table('posts')->order('created_at DESC')->where('category = ?', $category)->where('publish = ?', 1);
    }

}
