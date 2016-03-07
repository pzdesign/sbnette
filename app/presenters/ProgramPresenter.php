<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Application\UI;

class ProgramPresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
        $id = '4';
        $this->template->program = $this->database->table('posts')->order('created_at DESC')->where('id = ?', $id);

        $title = $this->database->table('posts')->get($id);
        $this->template->titulek = $title['title'];


    }

}
