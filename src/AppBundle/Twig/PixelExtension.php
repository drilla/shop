<?php

namespace AppBundle\Twig;


use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class PixelExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals() {

        //содержит картинку величиной 1px
        $pixel = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';

        return [
            'pixel' => $pixel
        ];
    }
}