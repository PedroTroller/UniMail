<?php

namespace spec\Knp\Rad\Mailer\AttachmentFactory;

use PhpSpec\ObjectBehavior;

class LocalAttachmentFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\Mailer\AttachmentFactory\LocalAttachmentFactory');
    }

    function it_supports_existing_files()
    {
        $this->supports(__FILE__)->shouldReturn(true);
        $this->supports('foo')->shouldReturn(false);
    }

    function it_creates_attachment_from_file()
    {
        $this
            ->createAttachment('foo', __FILE__)
            ->shouldHaveType('Swift_Mime_MimeEntity')
        ;
    }
}
