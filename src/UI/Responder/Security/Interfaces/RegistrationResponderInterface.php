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

namespace App\UI\Responder\Security\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Interface RegistrationResponderInterface.
 * 
 * @package App\UI\Responder\Security\Interfaces
 */
interface RegistrationResponderInterface
{
    /**
     * RegistrationResponderInterface constructor.
     *
     * @param Environment           $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param Request            $request
     * @param bool               $redirect
     * @param FormInterface|null $form
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        $redirect = false,
        FormInterface $form = null
    ): Response;
}
