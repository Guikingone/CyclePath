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

namespace App\UI\Responder\Core\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface HomeResponderInterface.
 *
 * @package App\UI\Responder\Core\Interfaces
 */
interface HomeResponderInterface
{
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function __invoke(Request $request): Response;
}
