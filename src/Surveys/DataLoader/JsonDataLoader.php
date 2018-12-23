<?php

namespace Surveys\DataLoader;

class JsonDataLoader extends DataLoader
{
    public function __construct($json_file_path)
    {
        if (is_file($json_file_path)) {
            $data = json_decode(file_get_contents($json_file_path), 1);
            if (!empty($data['title'])) {
                $this->setTitle(trim($data['title']));
            }
            if (!empty($data['questions']) && is_array($data['questions'])) {
                $this->setQuestions($data['questions']);
            }
        }
    }
}