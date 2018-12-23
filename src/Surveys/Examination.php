<?php
namespace Surveys;


class Examination
{
    /**
     * @var Survey
     */
    protected $survey;
    /**
     * @var \View
     */
    protected $view;
    /**
     * @return mixed
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @param mixed $survey
     */
    public function setSurvey(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function perform()
    {
        if($this->canPerform()) {
            return $this->handle();
        }
        return false;
    }

    protected  function handle()
    {
        $survey = $this->getSurvey()->getDataLoader();
        $data = [
            'complete' => false,
            'survey' => $survey,
        ];
        if(!empty($_POST)) {
            $data['complete'] = true;
            $answers = [];
            foreach($survey->getQuestions() as $question) {
                $variants = $question->getVariants();
                if(array_key_exists('q_' . $question->getId(), $_POST)) {
                    $answers[$question->getId()] = [
                        'question_tags' => $question->getTags(),
                        'answer_tags' => $variants[$_POST['q_' . $question->getId()]]->getTags()
                    ];
                }
            }
            $result = [];
            foreach($answers as $answer) {
                foreach($answer['question_tags'] as $tag){
                    if(empty($result[$tag])){
                        $result[$tag] = [ 'question' => 1, 'answer' => 0];
                    } else {
                        $result[$tag]['question']++;
                    }
                }
                foreach($answer['answer_tags'] as $tag){
                    $result[$tag]['answer']++;
                }
            }
            $data['result'] = $result;
        }
        $this->getView()->render('examination', $data);
    }

    /**
     * @return \View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param \View $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    protected function canPerform()
    {
        return true;
    }
}