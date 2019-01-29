<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity
 * @ApiFilter(SearchFilter::class, properties={"question": "exact"})
 */
class Vote
{

//https://api-platform.com/docs/core/filters
//Intentar que al devolver el voto, también venga el nombre de la pregunta o de la respuesta

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public $nameVoter;

    /**
     * One Vote has One Answer
     * @ORM\OneToOne(targetEntity="Answer")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    public $answer;

    /**
     * One Vote has One Question
     * @ORM\OneToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    public $question;
}