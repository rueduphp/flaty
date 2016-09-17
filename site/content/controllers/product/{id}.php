<?php
    namespace Octo;

    class PageController extends Micro
    {
        public function boot()
        {
            if (!reallyInt($this->id)) {
                // Page::route('/', ['id' => 15]);
                Page::route('product.{id}', ['id' => 15]);
            } else {
                dd('ici');
            }
        }
    }
