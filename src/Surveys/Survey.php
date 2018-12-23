<?php

namespace Surveys;

use Surveys\DataLoader\DataLoader;

class Survey
{
    /**
     * @var DataLoader
     */
    protected $data_loader;

    /**
     * @return DataLoader
     */
    public function getDataLoader()
    {
        return $this->data_loader;
    }

    /**
     * @param DataLoader $data_loader
     */
    public function setDataLoader($data_loader)
    {
        $this->data_loader = $data_loader;
    }

    public function __construct($data_loader = null)
    {
        if(!empty($data_loader)) {
            $this->setDataLoader($data_loader);
        }
    }
}