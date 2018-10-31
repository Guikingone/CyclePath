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

namespace App\UI\Form\Handler\Security;

use App\UI\Form\Handler\Security\Interfaces\RegistrationTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class RegistrationTypeHandler.
 *
 * @package App\UI\Form\Handler\Security
 */
final class RegistrationTypeHandler implements RegistrationTypeHandlerInterface
{
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            return true;
        }

        return false;
    }
}
