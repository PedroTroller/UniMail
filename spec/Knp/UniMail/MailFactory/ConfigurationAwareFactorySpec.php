<?php

namespace spec\Knp\Rad\Mailer\MailFactory;

use Knp\Rad\Mailer\Mail;
use Knp\Rad\Mailer\MailFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationAwareFactorySpec extends ObjectBehavior
{
    function let(MailFactory $factory)
    {
        $configuration = [
            'the_mail' => [
                'from' => 'mail@mail.com',
                'to'   => 'to@mail.com',
            ]
        ];

        $this->beConstructedWith($configuration, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Mailer\MailFactory\ConfigurationAwareFactory');
    }

    function it_instantiate_a_new_mail_with_configuration($factory, Mail $mail)
    {
        $factory
            ->createMail('the_mail', ['from' => 'from@mail.com', 'to' => 'to@mail.com'])
            ->willReturn($mail)
        ;

        $this
            ->createMail('the_mail', ['from' => 'from@mail.com'])
            ->shouldReturn($mail)
        ;
    }

    function it_instantiate_a_new_mail_without_configuration($factory, Mail $mail)
    {
        $factory
            ->createMail('the_other_mail', ['from' => 'from@mail.com'])
            ->willReturn($mail)
        ;

        $this
            ->createMail('the_other_mail', ['from' => 'from@mail.com'])
            ->shouldReturn($mail)
        ;
    }
}
