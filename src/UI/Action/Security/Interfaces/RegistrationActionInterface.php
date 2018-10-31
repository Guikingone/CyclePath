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

namespace App\UI\Action\Security\Interfaces;

use App\UI\Form\Handler\Security\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface RegistrationActionInterface.
 * 
 * @package App\UI\Action\Security\Interfaces
 */
interface RegistrationActionInterface
{
    /**
     * RegistrationActionInterface constructor.
     *
     * @param FormFactoryInterface             $factory
     * @param RegistrationTypeHandlerInterface $registrationTypeHandler
     */
    public function __construct(
        FormFactoryInterface $factory,
        RegistrationTypeHandlerInterface $registrationTypeHandler
    );

    /**
     * @param Request                        $request
     * @param RegistrationResponderInterface $responder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        RegistrationResponderInterface $responder
    ): Response;
}
