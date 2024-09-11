<?php

namespace App\ViewModels\File;

use Akbarali\ViewModel\BaseViewModel;

class FileViewModel extends BaseViewModel
{
    public int $id;
    public string $path;
    public string $lang;
    protected function populate()
    {
        $this->path = asset('documents/'.$this->path);
    }
}
