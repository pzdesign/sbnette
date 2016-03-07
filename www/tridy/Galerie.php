<?php
/*
 *         __          __                __            
 *    ____/ /__ _   __/ /_  ____  ____  / /__ _________
 *   / __  / _ \ | / / __ \/ __ \/ __ \/ //_// ___/_  /
 *  / /_/ /  __/ |/ / /_/ / /_/ / /_/ / ,< _/ /__  / /_
 *  \__,_/\___/|___/_.___/\____/\____/_/|_(_)___/ /___/
 *                                                   
 *                                                           
 *      TUTORIÁLY  <>  DISKUZE  <>  KOMUNITA  <>  SOFTWARE
 * 
 *  Tento zdrojový kód je součástí tutoriálů na programátorské 
 *  sociální síti WWW.DEVBOOK.CZ    
 *  
 *  Kód můžete upravovat jak chcete, jen zmiňte odkaz 
 *  na www.devbook.cz :-) 
 */
 
class Galerie
{





    private $slozka;
    private $sloupcu;
    private $soubory = array();
    private $url = "http://autoskola-ricany.cz/";
 
    



    public function __construct($slozka)
    {
        $this->slozka = $slozka;

    }
    




   
    public function nacti()
    {
        $slozka = dir($this->slozka);

        while ($polozka = $slozka->read()) 
        {
            if (is_file($this->slozka . '/' . $polozka))
            {
                $this->soubory[] = $polozka;
            }
        }
        $slozka->close();
    }
    

    public function vypis()
    {
       
        $dir = $this->url;
        foreach ($this->soubory as $soubor)
        {
            $nahled = $this->slozka . '/thumb/' . $soubor;
            $obrazek = $this->slozka . '/' . str_replace('_nahled.', '.', $soubor) ;
            $soubornew = str_replace('.jpg', '', $soubor);
            echo(' <div class="col-xs-12 col-sm-6 col-md-4 ">
                <a class="thumbnail" href="' . htmlspecialchars($dir.$obrazek) . '" data-lightbox="roadtrip">
                <img class="img-responsive" src="' . htmlspecialchars($dir.$nahled) . '" alt="">
                </a> 
            </div>');

        }
    }
    
    
}
