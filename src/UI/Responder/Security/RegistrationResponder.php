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

namespace App\UI\Responder\Security;

use App\UI\Responder\Security\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class RegistrationResponder.
 * 
 * @package App\UI\Responder\Security
 */
final class RegistrationResponder implements RegistrationResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @inheritdoc
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(
        Request $request,
        $redirect = false,
        FormInterface $form = null
    ): Response {

        $redirect
            ? $response = new RedirectResponse($this->urlGenerator->generate('home'))
            : $response = new Response($this->twig->render('security/registration.html.twig', [
                'form' => $form->createView()
        ]));

        return $response;
    }
}
