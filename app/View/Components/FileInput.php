<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileInput extends Component
{
    public $name;
    public $folder;
    public $scripts;
    public $route;
    public $ext;
    public $fileCount;
    public $value;
    public $files;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $folder = 'img', $scripts=1, $route='', $ext='jpg,jpeg,png,gif', $filecount=1, $value=null, $files=null)
    {
        $this->name = $name;
        $this->folder = $folder;
        $this->scripts = $scripts;
        $this->route = $route;
        $this->ext = $ext;
        $this->fileCount = $filecount;
        $this->value = $value;
        $this->files = $files;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-input');
    }
}
