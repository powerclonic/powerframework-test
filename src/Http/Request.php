<?php

namespace Power\Http;

class Request
{
    public function __construct(
        private array $request
    ) {
        // print_r($this->request);
    }
}
