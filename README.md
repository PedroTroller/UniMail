#UniMail - It's realy simple to send emails with Symfony

#Email definition

You have to define your email via the configuration.

```yaml
knp_unimail:
    mails:
        user.activation:    #This the mail name
            from: '%mailer_from%'    #This is the mail sender
