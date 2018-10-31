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

namespace App\Domain\DTO\Security\Interfaces;

/**
 * Interface RegistrationDTOInterface.
 * 
 * @package App\Domain\DTO\Security\Interfaces
 */
interface RegistrationDTOInterface
{
    /**
     * RegistrationDTOInterface constructor.
     *
     * @param string|null       $username
     * @param string|null       $email
     * @param string|null       $password
     * @param \SplFileInfo|null $profileImage
     */
    public function __construct(
        string $username = null,
        string $email = null,
        string $password = null,
        \SplFileInfo $profileImage = null
    );
}
