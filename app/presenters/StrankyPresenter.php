<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Application\UI;

class StrankyPresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {


        $this->template->posts = $this->database->table('stranky')
            ->order('pozice')
            ->limit(6);
    }

    public function renderShow($postId)
    {
        $this->template->post = $this->database->table('posts')->get($postId);
    }

    protected function createComponentPostForm()
    {
        $form = new Form;
        $form->addText('title', 'Titulek:')
            ->setRequired();
        $form->addTextArea('content', 'Obsah:',55, 8)
            ->setRequired()->setAttribute('class', 'mceEditor');

        $form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
        $form->addSubmit('send', 'Vložit článek');

        foreach ($form->getComponents(TRUE, 'SubmitButton') as $button) {
            if (!$button->getValidationScope())
                continue;
            $button->getControlPrototype()->onclick('tinyMCE.triggerSave()');
        }
// setup form rendering
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = 'div class="form-group text-center"';
        $renderer->wrappers['pair']['.error'] = 'has-error';
        $renderer->wrappers['control']['container'] = 'div class="col-sm-10"';
        $renderer->wrappers['label']['container'] = 'div class="control-label text-center col-sm-1"';
        $renderer->wrappers['control']['description'] = 'span class=help-block';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';
// make form and controls compatible with Twitter Bootstrap
        $form->getElementPrototype()->class('form-horizontal');
        foreach ($form->getControls() as $control) {
            if ($control instanceof Controls\Button) {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
                $usedPrimary = TRUE;
            } elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
                $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
            }
        }

        $form->onSuccess[] = array($this, 'postFormSucceeded');

        return $form;
    }

    public function postFormSucceeded($form, $values)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $postId = $this->getParameter('postId');

        if ($postId) {
            $post = $this->database->table('posts')->get($postId);
            $post->update($values);
        } else {
            $post = $this->database->table('posts')->insert($values);
        }

        $this->flashMessage('Příspěvek byl úspěšně publikován.', 'alert-success');
        $this->redirect('show', $post->id);

    }


    public function actionCreate()
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

    public function actionEdit($postId)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $post = $this->database->table('posts')->get($postId);
        if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this['postForm']->setDefaults($post->toArray());
    }



    public function actionDelete($postId)
    {

        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->database->table('comments')->where('post_id', $postId)->delete();
        $this->database->table('posts')->where('id', $postId)->delete();

        //$post = $this->database->table('posts')->where('id', $postId)->delete();
        $this->flashMessage('Příspěvek byl odstraněn.', 'alert-warning');
        $this->redirect('Novinky:');
    }


}
