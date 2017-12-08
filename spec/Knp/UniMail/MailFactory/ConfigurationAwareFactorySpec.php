<?php

namespace spec\Knp\UniMail\MailFactory;

use Knp\UniMail\Mail;
use Knp\UniMail\MailFactory;
use PhpSpec\ObjectBehavior;

class ConfigurationAwareFactorySpec extends ObjectBehavior
{
    function let(MailFactory $factory)
    {
        $configuration = [
            'the_mail' => [
                'from' => 'mail@mail.com',
                'to'   => 'to@mail.com',
            ],
        ];

        $this->beConstructedWith($configuration, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\UniMail\MailFactory\ConfigurationAwareFactory');
    }

    function it_instantiate_a_new_mail_with_configuration($factory, Mail $mail)
    {
        $factory
            ->createMail('the_mail', ['from' => 'from@mail.com', 'to' => 'to@mail.com'])
            ->willReturn($mail);

        $this
            ->createMail('the_mail', ['from' => 'from@mail.com'])
            ->shouldReturn($mail);
    }

    function it_instantiate_a_new_mail_without_configuration(
        $factory,
        Mail $mail
    ) {
        $factory
            ->createMail('the_other_mail', ['from' => 'from@mail.com'])
            ->willReturn($mail);

        $this
            ->createMail('the_other_mail', ['from' => 'from@mail.com'])
            ->shouldReturn($mail);
    }
}
