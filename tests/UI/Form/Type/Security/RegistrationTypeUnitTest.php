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

namespace App\Tests\UI\Form\Type\Security;

use App\Domain\DTO\Security\Interfaces\RegistrationDTOInterface;
use App\UI\Form\Type\Security\RegistrationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class RegistrationTypeUnitTest.
 *
 * @package App\Tests\UI\Form\Type\Security
 */
final class RegistrationTypeUnitTest extends TypeTestCase
{
    public function testItExist()
    {
        $type = new RegistrationType();

        static::assertInstanceOf(AbstractType::class, $type);
    }

    /**
     * @dataProvider provideData
     *
     * @param array $data
     *
     * @return void
     */
    public function testItAcceptData(array $data): void
    {
        $type = $this->factory->create(RegistrationType::class);

        $type->submit($data);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
        static::assertInstanceOf(RegistrationDTOInterface::class, $type->getData());
        static::assertSame($data['username'], $type->getData()->username);
        static::assertSame($data['email'], $type->getData()->email);
        static::assertSame($data['password'], $type->getData()->password);
    }

    /**
     * @return \Generator
     */
    public function provideData(): \Generator
    {
        yield array(['username' => 'Test', 'email' => 'test@gmail.com', 'password' => 'Ie1FDLTE']);
        yield array(['username' => 'Toto', 'email' => 'toto@gmail.com', 'password' => 'Ie1FDLTO']);
        yield array(['username' => 'Titi', 'email' => 'titi@gmail.com', 'password' => 'Ie1FDLTI']);
    }
}
