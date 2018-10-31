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

namespace App\Tests\UI\Action\Security;

use App\UI\Action\Security\Interfaces\RegistrationActionInterface;
use App\UI\Action\Security\RegistrationAction;
use App\UI\Form\Handler\Security\Interfaces\RegistrationTypeHandlerInterface;
use App\UI\Responder\Security\Interfaces\RegistrationResponderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegistrationActionUnitTest.
 *
 * @package App\Tests\UI\Action\Security
 */
final class RegistrationActionUnitTest extends TestCase
{
    /**
     * @var FormFactoryInterface|null
     */
    private $formFactory = null;

    /**
     * @var RegistrationResponderInterface|null
     */
    private $registrationResponder = null;

    /**
     * @var RegistrationTypeHandlerInterface|null
     */
    private $registrationTypeHandler = null;

    /**
     * @var Request|null
     */
    private $request = null;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->registrationResponder = $this->createMock(RegistrationResponderInterface::class);
        $this->registrationTypeHandler = $this->createMock(RegistrationTypeHandlerInterface::class);

        $formInterfaceMock = $this->createMock(FormInterface::class);

        $this->formFactory->method('create')->willReturn($formInterfaceMock);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();

        $request = Request::create('/fr/enregistrement', 'GET');
        $this->request = $request->duplicate();
    }

    public function testItExist()
    {
        $action = new RegistrationAction($this->formFactory, $this->registrationTypeHandler);

        static::assertInstanceOf(RegistrationActionInterface::class, $action);
    }

    public function testItReturnARedirection()
    {
        $this->registrationTypeHandler->method('handle')->willReturn(false);

        $action = new RegistrationAction($this->formFactory, $this->registrationTypeHandler);

        static::assertInstanceOf(RedirectResponse::class, $action($this->request, $this->registrationResponder));
    }
}
