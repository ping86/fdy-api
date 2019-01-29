<?php

namespace App\Controller;

use App\Entity\Question;

class VoteController
{
    private $myService;

    public function __construct()
    {
//        $this->myService = $myService;
    }

    public function __invoke(Question $data): Question
    {
        $answers = $data->getAnswers();
        foreach ($answers as $answer) {
            $answerId = $answers->getId();

        }
        die('aaa');
//        $this->myService->doSomething($data);

        return $data;
    }
}

