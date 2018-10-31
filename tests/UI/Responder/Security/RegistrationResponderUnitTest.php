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

namespace App\Tests\UI\Responder\Security;

use App\UI\Responder\Security\Interfaces\RegistrationResponderInterface;
use App\UI\Responder\Security\RegistrationResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class RegistrationResponderUnitTest.
 * 
 * @package App\Tests\UI\Responder\Security
 */
final class RegistrationResponderUnitTest extends TestCase
{
    /**
     * @var Environment|null
     */
    private $twig = null;

    /**
     * @var UrlGeneratorInterface|null
     */
    private $urlGenerator = null;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    }

    public function testItExist()
    {
        $responder = new RegistrationResponder($this->twig, $this->urlGenerator);

        static::assertInstanceOf(RegistrationResponderInterface::class, $responder);
    }
}
