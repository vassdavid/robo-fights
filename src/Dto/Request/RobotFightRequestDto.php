<?php

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class RobotFightRequestDto
{
    public function __construct(

        #[Assert\NotNull]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        #[Assert\NotEqualTo(propertyPath: 'robot2Id', message: 'The two robots must not be the same.')]
        public ?int $robot1Id = null,

        #[Assert\NotNull]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public ?int $robot2Id = null,

    ) 
    {
        
    }
}
