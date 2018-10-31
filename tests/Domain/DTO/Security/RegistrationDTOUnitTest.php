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

namespace App\Tests\Domain\DTO\Security;

use App\Domain\DTO\Security\Interfaces\RegistrationDTOInterface;
use App\Domain\DTO\Security\RegistrationDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class RegistrationDTOUnitTest.
 *
 * @package App\Tests\Domain\DTO\Security
 */
final class RegistrationDTOUnitTest extends TestCase
{
    public function testItExist()
    {
        $dto = new RegistrationDTO();

        static::assertInstanceOf(RegistrationDTOInterface::class, $dto);
    }

    /**
     * @dataProvider provideData
     *
     * @param string        $username
     * @param string        $email
     * @param string        $password
     * @param \SplFileInfo  $file
     */
    public function testItAcceptData(
        string $username,
        string $email,
        string $password,
        \SplFileInfo $file
    ) {
        $dto = new RegistrationDTO($username, $email, $password, $file);

        static::assertSame($username, $dto->username);
        static::assertSame($email, $dto->email);
        static::assertSame($password, $dto->password);
        static::assertSame($file, $dto->profileImage);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        yield array('Test', 'test@gmail.com', 'Ie1FDLTE', $this->createMock(\SplFileInfo::class));
        yield array('Titi', 'titi@gmail.com', 'Ie1FDLTI', $this->createMock(\SplFileInfo::class));
        yield array('Tutu', 'tutu@gmail.com', 'Ie1FDLTU', $this->createMock(\SplFileInfo::class));
        yield array('Toto', 'toto@gmail.com', 'Ie1FDLTO', $this->createMock(\SplFileInfo::class));
    }
}
