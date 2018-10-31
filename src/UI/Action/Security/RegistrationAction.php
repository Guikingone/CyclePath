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

namespace App\UI\Action\Security;

use App\UI\Action\Security\Interfaces\RegistrationActionInterface;
use App\UI\Form\Handler\Security\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Form\Type\Security\RegistrationType;
use App\UI\Responder\Security\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationAction.
 * 
 * @package App\UI\Action\Security
 *
 * @Route({
 *     "fr": "/enregistrement",
 *     "en": "/register"
 * }, name="security_registration", methods={"GET", "POST"})
 */
final class RegistrationAction implements RegistrationActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RegistrationTypeHandlerInterface
     */
    private $registrationTypeHandler;

    /**
     * @inheritdoc
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegistrationTypeHandlerInterface $registrationTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->registrationTypeHandler = $registrationTypeHandler;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, RegistrationResponderInterface $responder): Response
    {
        $form = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        if ($this->registrationTypeHandler->handle($form)) {
            return $responder($request, true);
        }

        return $responder($request, false, $form);
    }
}
