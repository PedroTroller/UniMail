<?php

namespace spec\Knp\Rad\Mailer\Mailer;

use Knp\Rad\Mailer\Mail;
use Knp\Rad\Mailer\Mail\SwiftMail;
use Knp\Rad\Mailer\Mailer;
use Knp\Rad\Mailer\MailerEvents;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventDispatcherMailerSpec extends ObjectBehavior
{
    function let(Mailer $wrapped, EventDispatcherInterface $dispatcher)
    {
        $this->beConstructedWith($wrapped, $dispatcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Mailer\Mailer\EventDispatcherMailer');
    }

    function it_ask_to_wrapped_mailer_to_create_a_mail($wrapped, Mail $mail)
    {
        $wrapped
            ->createMail('name', ['template' => 'the template'])
            ->shouldBeCalled()
            ->willReturn($mail)
        ;

        $this
            ->createMail('name', ['template' => 'the template'])
            ->shouldReturn($mail)
        ;
    }

    function it_dispatchs_events_when_a_mail_is_sent($wrapped, $dispatcher)
    {
        $mail = new SwiftMail('mail');

        $dispatcher
            ->dispatch(
                MailerEvents::PRE_SEND,
                Argument::that(function ($e) use ($mail) {
                    return $mail === $e->getMail();
                })
            )
            ->shouldBeCalled()
        ;

        $dispatcher
            ->dispatch(
                MailerEvents::preSend($mail),
                Argument::that(function ($e) use ($mail) {
                    return $mail === $e->getMail();
                })
            )
            ->shouldBeCalled()
        ;

        $dispatcher
            ->dispatch(
                MailerEvents::POST_SEND,
                Argument::that(function ($e) use ($mail) {
                    return $mail === $e->getMail();
                })
            )
            ->shouldBeCalled()
        ;

        $dispatcher
            ->dispatch(
                MailerEvents::postSend($mail),
                Argument::that(function ($e) use ($mail) {
                    return $mail === $e->getMail();
                })
            )
            ->shouldBeCalled()
        ;

        $wrapped->sendMail($mail)->shouldBeCalled();

        $this->sendMail($mail);
    }
}
