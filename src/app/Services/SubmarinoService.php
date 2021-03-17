<?php

namespace App\Services;

use App\Entity\Paginator;
use App\Formatter\ResponseFormatter;

class SubmarinoService extends MyService
{
    const BASE_URL = 'https://www.submarino.com.br/busca/tv';

    public function __construct()
    {
        parent::__construct(self::BASE_URL);
    }

    /**
     * Realizar uma requisição através de uma api formatada
     *
     * @param Paginator $paginator
     *
     * @return bool|\Illuminate\Support\Collection|string
     */
    public function getProducts(Paginator $paginator)
    {
        $this->setPagination($paginator);

        return $this->doRequest(new ResponseFormatter());
    }

    /**
     * @inheritDoc
     *
     * @param Paginator $paginator
     */
    public function setPagination(Paginator $paginator): void
    {
        if ($paginator->getPage() > 1) {
            $this->url .= "?limite={$paginator->getSize()}&offset={$paginator->getOffset()}";
        }
    }
}