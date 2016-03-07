<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Application\UI;

class AdminPresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;
    private $kategorie;
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }

    public function renderList()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }

    public function renderSmall()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }


    public function renderVisible()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }   

    public function renderInvisible()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }        

    public function renderPin()
    {
                if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->kategorie = 'aktuality';
        $this->template->novinky   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Novinky');
        $this->template->aktuality = $this->database->table('events')->order('start DESC');
        $this->template->klub      = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Klub');
        $this->template->ostatni   = $this->database->table('posts')->order('created_at DESC')->where('category = ?', 'Ostatni');

    }    
    public function renderShow($postId)
    {
        $this->template->post = $this->database->table('posts')->get($postId);
    }
  
}