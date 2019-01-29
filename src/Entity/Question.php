<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

use App\Controller\VoteController;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"question"}},
 *     denormalizationContext={"groups"={"question"}},
 *     itemOperations={
 *     "get",
 *     "votes"={
 *         "method"="GET",
 *         "path"="/questions/{id}/votes",
 *         "controller"=VoteController::class
 *     }
 * }
 * )
 * @ORM\Entity
 */
class Question
{
    /**
     * @var int The entity Id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    public $id;

    /**
     * @var string
     * @Groups({"question"})
     * @ORM\Column
     * @Assert\NotBlank
     */
    public $name = '';

    /**
     * @Groups({"question"})
     * One Question has Many Answers.
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", cascade={"persist"})
     * @ApiSubresource 
     */
    private $answers;

    public function __construct() {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     * @return Question
     */
    public function setAnswers($answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * @param Answer $answer
     * @return Question
     */
    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    /**
     * @param Answer $answer
     * @return Question
     */
    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Question
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
