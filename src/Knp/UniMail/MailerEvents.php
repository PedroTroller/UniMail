<?php

namespace Knp\UniMail;

final class MailerEvents
{
    const PRE_SEND  = 'knp_unimail.mail.pre_send';
    const POST_SEND = 'knp_unimail.mail.post_send';

    public static function preSend(Mail $mail)
    {
        return sprintf(
            'knp_unimail.mail.%s.pre_send',
            $mail->getName()
        );
    }

    public static function postSend(Mail $mail)
    {
        return sprintf(
            'knp_unimail.mail.%s.post_send',
            $mail->getName()
        );
    }
}
