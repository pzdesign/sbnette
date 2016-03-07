<?php
/*
* File MultiUpload.php
*/

namespace App\Components;

use Nette,
    Nette\Http;

class MultiUploadControl extends UploadControl {

    public function getHtmlName() {
        return parent::getHtmlName() . '[]';
    }

    public function getControl() {
        return parent::getControl()->multiple(TRUE);
    }

    public function setValue($value) {
        foreach($value as $single) {
            if (is_array($single)) {
                $this->value[] = new Http\FileUpload($single);
            } elseif ($single instanceof Http\FileUpload) {
                $this->value[] = $single;
            } else {
                $this->value[] = new Http\FileUpload(NULL);
            }
        }
        return $this;
    }

    public function isFilled() {
        return $this->value[0] instanceof Http\FileUpload && $this->value[0]->isOK();
    }

    public static function validateFileSize(UploadControl $control, $limit)
    {
        $files = $control->getValue();
        foreach($files as $file) {
            if($file instanceof Http\FileUpload && $file->getSize() <= $limit)
                {}
            else
                return false;
        }

        return true;
    }

    public static function validateMimeType(UploadControl $control, $mimeType)
    {
        $files = $control->getValue();
        foreach($files as $file) {
            if ($file instanceof Http\FileUpload) {
                $type = strtolower($file->getContentType());
                $mimeTypes = is_array($mimeType) ? $mimeType : explode(',', $mimeType);
                if (!in_array($type, $mimeTypes, TRUE)) {
                    return FALSE;
                }
                if (!in_array(preg_replace('#/.*#', '/*', $type), $mimeTypes, TRUE)) {
                    return FALSE;
                }
            }
            return FALSE;
        }
        return TRUE;
    }

    public static function validateImage(UploadControl $control) {
        $files = $control->getValue();
        foreach($files as $file) {
            if($file instanceof Http\FileUpload && $file->isImage())
                {}
            else
                return false;
        }

        return true;
    }
}
?>