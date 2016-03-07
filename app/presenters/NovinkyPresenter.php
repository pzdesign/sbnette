<?php

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Utils\Finder,
    Nette\Application\UI;
use Nette\Utils\Strings;



class NovinkyPresenter extends Nette\Application\UI\Presenter
{

    /** @var Nette\Database\Context */
    private $database;
    private $ids = array(1,2,3,4,5,6,7,8,9);
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
        /*    statické stránky = $ids */
        /*      1 = Kontakt           */
        /*      2 = O nás             */
        /*      3 = O nás             */
        /*      4 = Program školky    */
        /*      5 = Jídelní lístek    */
        /*      6 = Nabídka dne       */
        /*      7 = Vítejte           */
        /*      Klub = Služby         */
        $welcome = $this->database->table('posts')->get(7);
        $this->template->welcome = $welcome;
        $this->template->events = $this->database->table('events')->order('start ASC')->limit(2)->where('pin', 1)->where('publish = ?', 1);
        $this->template->sluzby = $this->database->table('posts')
        ->order('id ASC')->limit(3)->where('pin', 1)
        ->where('publish = ?', 1)->where('category = ?', 'Klub');


    }


    public function beforeRender()
    {
        $albumsPaths = null;
        $path = 'gallery/';
        $a = 0;
        $albumsNames = null;

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            DIRECTORY_SEPARATOR == '/';
            }
            else {
            DIRECTORY_SEPARATOR == '\\';   
            }

            foreach (Finder::findDirectories('*')->exclude('[0-9][0-9][0-9]', '_big')->in($path) as $key => $file) {
                 //omezení vyberu jen jedno albumí
                if($a > 0){break;}
                $albumsNames[$a] = str_replace("gallery".DIRECTORY_SEPARATOR,"",$key);
                $albumName = $path.$albumsNames[$a];

                $albumsPaths[$a] = $key;

                $i = 0;
                $nImg = 0;

                if(($files = @scandir($key)) && count($files) <= 2)
                {
                    $albumImgs[] = null;
                    $this->template->images  = null; 
                }
                else
                {
                    foreach (Finder::findFiles('*.jpg','*.png','*.jpeg','*.JPG','*.PNG','*.JPEG')->in($key) as $key2 => $file) {
                    //omezení obrázků na vykreslení
                      if($i == 3){break;}
                    $albumImgs[] = $file->getFilename();
                    $i++;
                
                }
                $this->template->albumName = $albumName;
                $this->template->images  =  $albumImgs;            
                }
           $a++;  

    }

    }


    public function renderShow($id)
    {

        $post = $this->database->table('posts')->where('slug = ?', $id)->fetch($id);
       if (!$post) {
        $this->error('Stránka nebyla nalezena');
    }
        $this->template->post = $post;
        $this->template->bans = $this->ids;
        $this->template->idPrispevku = $post->id;
    }

    public function renderNovinky()
    {
        $kategorie = 'novinky';
        $this->template->posts = $this->database->table('posts')->order('created_at DESC')->where('category = ?', $kategorie)->where('publish = ?', true);
    }

    public function renderAktuality()
    {
        $kategorie = 'Aktuality';
        $this->template->posts = $this->database->table('posts')->order('created_at DESC')->where('category = ?', $kategorie)->where('publish = ?', true);
    }
    protected function createComponentPostForm()
    {
        /*
        $countries = array(
    'Novinky' => 'Novinky',
    'Aktuality' => 'Aktuality',
    'Klub' => 'Klub'
);
*/
$cat = array('Novinky' => 'Novinky','Klub' => 'Služby','Ostatni' => 'Ostatní');

        $postId = $this->getParameter('postId');

        $form = new Form;



        $form->addText('title', 'Titulek:')
             ->setRequired()
             ->addRule(Form::MAX_LENGTH, 'Maximum znaků je 20', 20);  

        $form->addText('trailer', 'Náhled:')->addRule(Form::MAX_LENGTH, 'Maximum znaků je 150', 150);
                           
            if( !in_array($postId, $this->ids)) { 
                              
        $form->addSelect('category', 'Kategorie:', $cat)
        ->setRequired()->setDefaultValue('Novinky');

        $form->addText('img', 'Img:')
             ->setDefaultValue('empty.png'); 
             
        $form->addCheckbox('pin', 'Připnout'); 
        $form->addCheckbox('publish', 'Publikovat');            
            }
        $form->addTextArea('content', 'Obsah:',55, 8)
            ->setRequired()->setAttribute('class', 'mceEditor');

        $form->addHidden('slug');

        $form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
        if($this->action == 'edit') {
             $form->addSubmit('send', 'Uložit článek'); 

        $form->addSubmit('cancel', 'Cancel')
            ->setValidationScope([])
            ->onClick[] = [$this, 'formCancelled'];

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
        $form->addProtection();
        $form->onSuccess[] = array($this, 'postFormSucceeded');

        return $form;
    }


    public function postFormSucceeded($form, $values)
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }

        $id = $this->getParameter('id');
        $values->slug = Strings::webalize($values->title);
        if ($id) {
            $post = $this->database->table('posts')->where('slug = ?', $id)->fetch($id);
            $post->update($values);
        } else {
            $post = $this->database->table('posts')->insert($values);
        }

        $this->flashMessage('Příspěvek byl úspěšně publikován.', 'alert-success');
        $this->redirect('Novinky:show', $post->slug); 
        
    }

    public function formCancelled()
    {
        $this->flashMessage('ZRUŠENO.', 'alert-danger');
        $this->redirect('Novinky:default');
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

        $post = $this->database->table('posts')->where('slug = ?', $id)->fetch($id);
        if (!$post) {
            $this->error('Příspěvek nebyl nalezen');
        }
        $this->template->post = $post;
        $this->template->bans = $this->ids;
        $this->template->idPrispevku = $post->id;

        $this['postForm']->setDefaults($post->toArray());
    }



    public function actionDelete($id)
    {
        /*    statické stránky = $ids */
        /*      1 = Kontakt           */
        /*      2 = O nás             */

        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        //$this->database->table('comments')->where('post_id', $postId)->delete(); 
               
        //$post = $this->database->table('posts')->where('id', $postId)->delete();
        $post =  $this->database->table('posts')->where('slug', $postId)->where('NOT id', $this->ids)->delete();
        if (!$post) {
                 $this->flashMessage('Nelze odstranit systémové příspěvky', 'alert-danger');
                 $this->redirect('Novinky:default');   
             }  
             else {
                 $this->flashMessage('Příspěvek byl odstraněn.', 'alert-warning');
                 $this->redirect('Novinky:default');
             }  
    
        }

}    



