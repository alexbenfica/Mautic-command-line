# What is it for?

This script allows you to create a new segment email on your Mautic installation from command line.
You can use this to automate marketing messages.
It uses Mautic "Basic authentication", so you should NOT use this without SSL (https).

## Requirements
* All Mautic PHP API requirements

## Command line example
```
php mautic.php --baseUrl <yout Mautic base url> --userName <mautic username> --password <mautic password> --emailName "Email Name" --emailSubject "Email subject" --emailHtml "<b>This is your email!</b>" --emailSegments 7,3,1
```
   
### Parameters
- baseUrl: your Mautic url installation.
- userName: username used to login at Mautic
- password: password for the user above
- emailName: the name of email on Mautic
- emailSubject: the email subject
- emailHtml: the content of email itself
- emailSegments: comma separated list of Mautic segments ids


## Return

- returns 0 on a successfull execution.
- returns != 0 otherwise

Also returns the JSON enconded response from [Mautic API email/new endpoint](https://developer.mautic.org/#create-email).