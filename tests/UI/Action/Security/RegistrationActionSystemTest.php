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

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\Panther\Client as Panther;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Class RegistrationActionSystemTest.
 *
 * @package App\Tests\UI\Action\Security
 */
final class RegistrationActionSystemTest extends PantherTestCase
{
    /**
     * @var Client|Panther|null
     */
    private $client = null;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->client = static::createPantherClient();
    }

    /**
     * @dataProvider provideUrls
     *
     * @param string $url
     * @param string $title
     *
     * @return void
     */
    public function testResponseSuccess(string $url, string $title): void
    {
        $crawler = $this->client->request('GET', $url);

        static::assertContains($title, $crawler->filter('title')->html());
    }

    /**
     * @dataProvider provideWrongFormData
     *
     * @param string $url
     * @param string $title
     * @param string $button
     * @param array $data
     * @param string $errorMessage
     *
     * @return void
     *
     * @throws \Facebook\WebDriver\Exception\NoSuchElementException
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public function testRegistrationFormFailure(string $url, string $title, string $button, array $data, string $errorMessage): void
    {
        $this->client->followRedirects();

        $crawler = $this->client->request('GET', $url);

        $form = $crawler->selectButton($button)->form($data);

        $this->client->submit($form);

        $this->client->waitFor('');

        static::assertGreaterThan(0, $crawler->filter(sprintf('html:contains("%s")', $title))->count());
        static::assertGreaterThan(0, $crawler->filter(sprintf('html:contains("%s")', $errorMessage))->count());
    }

    /**
     * @return \Generator
     */
    public function provideUrls(): \Generator
    {
        yield array('/fr/enregistrement', 'Créer un compte');
        yield array('/en/register', 'Registration');
    }

    /**
     * @return \Generator
     */
    public function provideWrongFormData(): \Generator
    {
        yield array(
            '/fr/enregistrement',
            'Créer un compte',
            'Créer un compte',
            ['registration[username]' => 'Ti', 'registration[email]' => 'test@gmail.com', 'registration[password]' => 'Ie1FDLTE'],
            'Cette valeur est trop courte !'
        );
        yield array(
            '/en/register',
            'Registration',
            'Create an account',
            ['registration[username]' => 'Ti', 'registration[email]' => 'test@gmail.com', 'registration[password]' => 'Ie1FDLTE'],
            'This value is too short !'
        );
    }
}
