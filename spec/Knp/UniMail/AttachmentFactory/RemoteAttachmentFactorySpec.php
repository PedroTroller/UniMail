<?php

namespace spec\Knp\UniMail\AttachmentFactory;

use PhpSpec\ObjectBehavior;

class RemoteAttachmentFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\UniMail\AttachmentFactory\RemoteAttachmentFactory');
    }

    function it_supports_existing_urls()
    {
        $this->supports('http://symfony.com/pdf/Symfony_book_2.7.pdf?v=4')->shouldReturn(true);
        $this->supports('fake')->shouldReturn(false);
    }

    function it_creates_attachment_from_file()
    {
        $this
            ->createAttachment('foo', 'http://symfony.com/pdf/Symfony_book_2.7.pdf?v=4')
            ->shouldHaveType('Swift_Mime_MimeEntity');
    }
}
