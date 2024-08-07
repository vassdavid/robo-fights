<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Enum\Entity\RobotTypes;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RobotRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RobotRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: false)]
class Robot
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull()]
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\Length(min: 2, max: 255)]
    private ?string $name = null;

    #[Assert\NotNull()]
    #[ORM\Column(enumType: RobotTypes::class)]
    private ?RobotTypes $type = null;

    #[Assert\NotNull()]
    #[Assert\Range(min: 0, max: 100)]
    #[Assert\Type('integer')]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $power = null;

    #[Assert\NotNull()]
    #[Assert\Length(min: 5, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $imageUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?RobotTypes
    {
        return $this->type;
    }

    public function setType(RobotTypes $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
