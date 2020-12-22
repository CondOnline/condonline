<?php


namespace App\Services\Circular;


use App\Traits\FileTrait;

class UploadBase64TextService
{
    use FileTrait;

    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function replace()
    {
        preg_match_all('/(data:image\/[^;]+;base64[^"]+)/', $this->text, $imagens);

        $paths = array();
        foreach ($imagens[0] as $imagen) {
            $path['archive'] = $this->base64File($imagen,'circular');
            $path['display'] = 0;
            $paths[] = $path;
        }

        return str_replace($imagens[0], array_column($paths, 'archive'), $this->text);
    }

}
