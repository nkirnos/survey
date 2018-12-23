<?php

namespace Surveys\DataLoader;

use Surveys\Question;

class DataLoader
{
    protected $questions = [];
    protected $title;

    /**
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param array $questions
     */
    public function setQuestions(array $questions)
    {
        foreach($questions as $question_info) {
            if(is_a($question_info, Question::class)) {
                $this->addQuestion($question_info);
            } elseif(is_array($question_info) && !empty($question_info['text']) && !empty($question_info['variants'])) {
                $question = new Question();
                $question->setText($question_info['text']);
                $question->setVariants($question_info['variants']);
                $this->addQuestion($question);
            }
        }
    }

    protected function addQuestion(Question $question)
    {
        $id = count($this->questions);
        $question->setId($id);
        $this->questions[] = $question;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function __contruct()
    {
        $this->setTitle('');
        $this->setQuestions([]);
    }

}