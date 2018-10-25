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

namespace App\UI\Action\Core;

use App\UI\Action\Core\Interfaces\HomeActionInterface;
use App\UI\Responder\Core\HomeResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction.
 *
 * @package App\UI\Action
 *
 * @Route(name="home", path="/", methods={"GET"})
 */
final class HomeAction implements HomeActionInterface
{
    public function __invoke(Request $request, HomeResponder $responder)
    {
        return $responder($request);
    }
}
