<?php

namespace App\Presenters;

use Nette,
    Nette\Application\Application,
    Nette\Utils\Arrays,
    Nette\Utils\Finder,
    Nette\Http\Request,
    Nette\Utils\Image,
    Nette\Utils\Strings,
    Nette\Application\UI\Form,
    Nette\Forms\Controls,
    Nette\Caching\Cache;
    Nette\Application\UI\Form::extensionMethod('addMultiUpload', function(\Nette\Application\UI\Form $form, $name, $label = NULL) {
    $form[$name] = new \Nette\Forms\Controls\MultiUploadControl($label);
    return $form[$name];
});





class FotogaleriePresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Database\Context */
    private $database;
    public $images;
    public $fileUrl;
    public $imgStranka;
    public $totalPosts;

    const GAL_PATH = 'gallery/';
    const PO = 6; //pocet oobrazku na stranku
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }




    public function checkDir($fileUrl){
        if(file_exists($fileUrl))
        {
            $this->flashMessage('Toto Album již existuje.', 'alert-danger');
            return false;
        }
        else{
            $this->flashMessage('Album bylo úspěšně vytvořeno.', 'alert-success');           
              return true;
               
        }            
    }


    public function checkImg($fileUrl){
        if(file_exists($fileUrl))
        {
            $this->flashMessage('Album již obsahuje tento obrázek.', 'alert-danger');
            return false;
        }
        else{
            return true;
        }

    }



    public function beforeRender() {
        $albumsPaths = null;
        $path = 'gallery/';
        $a = 0;
        $albumsNames = null;
     if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    DIRECTORY_SEPARATOR == '/';
}
else
{
     DIRECTORY_SEPARATOR == '\\';   
}
            foreach (Finder::findDirectories('*')->exclude('[0-9][0-9][0-9]', '_big')->in($path) as $key => $file) {
                $albumsNames[] = str_replace("gallery".DIRECTORY_SEPARATOR,"",$key);

                $albumsPaths[] = $key;

                $i = 0;
                $nImg = 0;

                if(($files = @scandir($key)) && count($files) <= 2)
                {
                    $albumImgs[$a] = null;
                    $this->template->thumbs  = null; 
                }
                else
                {
                    foreach (Finder::findFiles('*.jpg','*.png','*.jpeg','*.JPG','*.PNG','*.JPEG')->in($key) as $key2 => $file) {
                    $albumImgs[$a] = $file->getFilename();
                    $i++;
                }
                $this->template->thumbs  =  $albumImgs;            
                }
           $a++;  

    }
    $this->template->albumsNames = $albumsNames;

}
    public function renderShow($galId)
    {
        $imagePaths = null;
        $dir = 'gallery/' . $galId;
        $i = 0;

        foreach (Finder::findFiles('*.jpg','*.png','*.jpeg','*.JPG','*.PNG','*.JPEG')->in($dir) as $key => $file) {
            //echo $key; // $key je řetězec s názvem souboru včetně cesty
            //echo $file; // $file je objektem SplFileInfo

            $imagePaths[] = $key;
            $imgNames[] = $file->getFilename();
            $imgNamesWithoutExt[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getFilename());

            $files[] = $file->getFilename();
            foreach($files as $key => $file){
                $file = basename($file, '.jpg');
                $file = Strings::webalize($file);
                $files[$key] = $file;
            }

        }



        if(count($imagePaths)>0) {
            $this->template->images = $imagePaths;
            $this->template->imgNames = $imgNames;
            $this->template->imgNamesWithoutExt = $imgNamesWithoutExt;
            $this->template->images2 = $files;
        }
        else{
            $this->template->images = $imagePaths;

        }

    }



    public function renderEdit($galId)
    {

        $dir = 'gallery/' . $galId;
        foreach (Finder::findFiles('*.jpg','*.png','')->in($dir) as $key => $file) {
            //echo $key; // $key je řetězec s názvem souboru včetně cesty
            //echo $file; // $file je objektem SplFileInfo
            $imagePaths[] = $key;

        }

        $this->template->galid = $this->getParameter('galId');

    }


    public function actionCreate()
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

    public function actionDeleteAlbum($galId)
    {
        $galId = 'gallery/'.$galId;
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        if (! is_dir($galId)) {
            $this->flashMessage('Album ' .$galId.' nebylo odstraněno.', 'alert-danger');
        }
        if (substr($galId, strlen($galId) - 1, 1) != '/') {
            $galId .= '/';
        }
        $files = glob($galId . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::actionDeleteAlbum($file);
            } else {
                unlink($file);
            }
        }
        rmdir($galId);

        //$post = $this->database->table('posts')->where('id', $postId)->delete();
        $this->flashMessage('Album ' .$galId.' bylo odstraněno.', 'alert-success');
        $this->redirect('Fotogalerie:alba');
    }
        /*
        $valueRef = & Arrays::getRef($array, 'foo');
        foreach (Finder::findFiles('*.jpg','*.png','')->in($dir) as $key => $file) {
            //echo $key; // $key je řetězec s názvem souboru včetně cesty
            //echo $file; // $file je objektem SplFileInfo
            $imagePaths[] = $key;

        }
        if($this->images > 0)
        {

        $this->template->images = $imagePaths;
        }
        else{
            $this->template->images = null;
        }
*/
/*
        $value = $cache->load("folders-{$path}");
        if ($value === NULL) {
            $i=0;
            foreach (Finder::findDirectories('*')->exclude('[0-9][0-9][0-9]', '_big')->in($path)->orderByName('DESC') as $key => $file) {
                $this->template->dirs[$i]['name'] = $this->I->getNameFromPath(substr($key, strlen(ALBUM_PATH)).'/');
                // vytahneme si small_home
                foreach (Finder::findFiles('_small_home.png')->in($key) as $key_home => $file_home) {
                    $this->template->dirs[$i]['small_home'] = ALBUM_DIR . substr($file_home->getPath(), strlen(ALBUM_PATH)) . '/_small_home.png';
                }
                $this->template->dirs[$i++]['pos'] = substr($key, strlen(ALBUM_PATH)+5);
            }
            $cache->save("folders-{$path}", $this->template->dirs);
        } else {
            $this->template->dirs = $value;
        }
*/




    protected function createComponentCreateAlbum() {

        $form = new Form();

        $form->addText('popis', 'Popis: ', 5)
            ->addRule(Form::FILLED, 'Je nutné zadat informace o akci.')
            ->addRule(Form::MAX_LENGTH, 'Maximum znaků je 10',10);


        $form->addSubmit('create', 'Nahrát');
        $form->addSubmit('cancel', 'Zrušit')
            ->setValidationScope(FALSE);
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
        $form->onSuccess[] = array($this, 'crateAlbumSuccess');

        return $form;
    }



    public function crateAlbumSuccess(Form $form, $values ) {
        if ($form['create']->isSubmittedBy()) {
             $albumName = 'gallery/' . '/'. $form->values->popis;
             $file = $albumName;

                if($this->checkDir($file)){
                    mkdir($file);
                      $this->redirect('Fotogalerie:alba');  
                }
            else
            {
                return false;
            }


        }
    }

    public function actionUpload()
    {

        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
    }

    public function actionDeleteImg($galId,$imgId)
    {
        $galId = 'gallery/'.$galId;
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        if (! is_dir($galId)) {
            $this->flashMessage('Foto ' .$imgId.' nebylo odstraněno.', 'alert-danger');
        }
        if (substr($galId, strlen($galId) - 1, 1) != '/') {
            $galId .= '/';
        }
        $file = $galId.$imgId;

        unlink($file);
        //$post = $this->database->table('posts')->where('id', $postId)->delete();
        $this->flashMessage('Foto ' .$imgId.' bylo odstraněno.', 'alert-success');
        $this->redirect('Fotogalerie:alba');
    }  

    protected function createComponentUploadImg() {

        $form = new Form();
        $form->addMultiUpload("imgs", "Obrázek")->addRule(Form::IMAGE, "Lze vložit pouze obrázky");
        // ->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 5 MB.', '50000');

        $form->addHidden('folder', $this->getParameter('galId'));

        $form->addSubmit('create', 'Nahrát');
        $form->addSubmit('cancel', 'Zrušit')
            ->setValidationScope(FALSE);
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
        $form->onSuccess[] = array($this, 'uploadImgSuccess');

        return $form;
    }

    public function uploadImgSuccess(Form $form, $values ) {


        if ($form['create']->isSubmittedBy()) {
            $files = array();
            $files = $form['imgs']->getValue();
            $count = count($files);

            foreach ($files as $key => $img) {
 
            $folder = $form['folder']->getValue();
            $imgDir = 'gallery/'. $folder;
            $imgUrl =  $imgDir. '/' .$img->name ;

            if($this->checkImg($imgUrl)){

            $img->move($imgUrl);

            $size    = new \Imagine\Image\Box(1024, 768);
            $mode    = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                $image = new \Imagine\Gd\Imagine();
                $image->open($imgUrl)
                ->thumbnail($size,$mode)
                ->save($imgUrl);
                //->resize(1280, 720, Image::FILL)
                $this->flashMessage('Foto '. $img.'bylo nahráno.', 'alert-success'); 
            }
            else{
                return false;
            } 
                         
            }


        }

    }

}
