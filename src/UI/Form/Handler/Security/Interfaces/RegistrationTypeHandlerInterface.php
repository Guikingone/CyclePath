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

namespace App\UI\Form\Handler\Security\Interfaces;

use Symfony\Component\Form\FormInterface;

/**
 * Interface RegistrationTypeHandlerInterface.
 * 
 * @package App\UI\Form\Handler\Security\Interfaces
 */
interface RegistrationTypeHandlerInterface
{
    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
