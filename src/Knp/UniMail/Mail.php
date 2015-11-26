<?php

namespace Knp\UniMail;

interface Mail
{
    public static function createFromMail(Mail $mail);

    public function getName();

    public function getFrom();

    public function setFrom($from);

    public function getTo();

    public function setTo($to);

    public function getCc();

    public function setCc($cc);

    public function getBcc();

    public function setBcc($bcc);

    public function getReplyTo();

    public function setReplyTo($replyTo);

    public function getAttachments();

    public function setAttachments(array $attachments);
}
