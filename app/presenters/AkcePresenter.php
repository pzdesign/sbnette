<?php

namespace App\Presenters;

use Nette,
    Nette\Forms\Controls;

use Nette\Application\UI;
use Nette\Utils\DateTime;
use Nette\Utils\Strings;


class AkcePresenter extends UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;
    private $slug;
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }



    public function renderDefault()
    {
        $this->template->events = $this->database->table('events')->order('start DESC')->where('pin = ?', 1);
    }

    public function renderShow($id)
    {

        $event = $this->database->table('events')->where('slug = ?', $id)->fetch($id);
       if (!$event) {
        $this->error('Stránka nebyla nalezena');
    }
        $this->template->event = $event;

        $this->template->idPrispevku = $this->getParameter("id");
    }

    protected function createComponentAkceForm()
    {

        $eventId = $this->getParameter('eventId');
        
        \App\Components\DateTimePicker::register();

        $form = new UI\Form;

        $form->addText('title', 'Titulek:')
            ->setRequired();    

        $form->addText('trailer', 'Náhled:');  

        $form->addDateTimePicker('start', 'start:', NULL, 16)
        ->setRequired();

        $form->addDateTimePicker('end', 'konec:', NULL, 16)
        ->setRequired();

        $form->addText('img', 'Img:')
             ->setDefaultValue('empty.png');  

        $form->addCheckbox('pin', 'Připnout'); 
        $form->addCheckbox('publish', 'Publikovat');            
          
        $form->addTextArea('content', 'Obsah:',55, 8)
            ->setRequired()->setAttribute('class', 'mceEditor');

        $form->addHidden('slug');


        $form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
        if($this->action == 'edit') {
             $form->addSubmit('send', 'Upravit článek');       
        }
        else {
                $form->addSubmit('send', 'Vložit článek');    
        }


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

        $form->onSuccess[] = array($this, 'akceFormSucceeded');

        return $form;
    }

    public function akceFormSucceeded($form, $values)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $id = $this->getParameter('id');

        $values->slug = Strings::webalize($values->title);
        if ($id) {
            $event = $this->database->table('events')->where('slug = ?', $id)->fetch($id);
            $c = $this->database->table('events')->where('slug = ?', $values->slug)->count();

            if ($values->slug == $event->slug || $c == 0) {
                $event->update($values);
                $this->flashMessage('Příspěvek byl úspěšně upraven.', 'alert-success');
                $this->redirect('Akce:show', $event->slug);                    
           
            } elseif( $c > 0 ) {
                $this->flashMessage('Již existuje s takovým titulkem ' . $values->slug, 'alert-danger'); 
                $this->redirect('Akce:edit', $event->slug);                   
            }            
        } else {

            $cc = $this->database->table('events')->where('slug = ?', $values->slug)->count();
            if ( $cc > 0 ) {
                $this->flashMessage('Již existuje s takovým titulkem ' . $values->slug, 'alert-danger');            
            } else {
                            
            $event = $this->database->table('events')->insert($values); 
            $this->flashMessage('Akce byla úspěšně vytvořena.', 'alert-success'); 
            $this->redirect('Akce:show', $event->slug);   
                      
            }
        }
        
    }

    public function actionCreate()
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

    public function actionEdit($id)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $event = $this->database->table('events')->where('slug = ?', $id)->fetch($id);
        if (!$event) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this->template->event = $event;
        $this->template->idPrispevku = $this->getParameter("id");
        $this['akceForm']->setDefaults($event->toArray());
    }



    public function actionDelete($id)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $event =  $this->database->table('events')->where('slug', $id)->delete();

        if($event) {
        $this->flashMessage('Příspěvek byl odstraněn.', 'alert-warning');
        $this->redirect('Akce:default');

        } else {
        $this->flashMessage('CHYBA.', 'alert-danger');
        $this->redirect('Akce:default');            
        }
    
    }    


}