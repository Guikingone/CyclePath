<?php

declare(strict_types=1);

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@guikprod.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO\Security;

use App\Domain\DTO\Security\Interfaces\RegistrationDTOInterface;

/**
 * Class RegistrationDTO.
 *
 * @package App\Domain\DTO\Security
 */
final class RegistrationDTO implements RegistrationDTOInterface
{
    /**
     * @var string|null
     */
    public $username;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var string|null
     */
    public $password;

    /**
     * @var \SplFileInfo|null
     */
    public $profileImage;

    /**
     * @inheritdoc
     */
    public function __construct(
        string $username = null,
        string $email = null,
        string $password = null,
        \SplFileInfo $profileImage = null
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->profileImage = $profileImage;
    }
}
