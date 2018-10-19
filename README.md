# 💋 💋 Bocas Bot - Auto WP Comments Scheduler

![Bocas Bot - Auto WP Comments Scheduler](https://i.imgur.com/wr8XZ0I.png)

A wordpress plugin to auto schedule your own fake comments and improve your post's engagement and SEO on page.

You can schedule comments to the current date or to a future date.

The Wordpress CRON system will be responsible for publishing it.

## How to install it

Just download from the source or clone the repo with the following command:

``` bash
$ git clone git@gitlab.com:gorkamu/bocas-bot.git
``` 

Then you have to upload it via FTP to your hosting and place it under *wp-content/plugins* folder from your Wordpress installation.

## How to use it

This plugin have different modes of execution.

### Auto schedule a single comment

If you click on the *Add Comment* menu option you will be able to auto schedule a single comment.

![Bocas Bot - Add Comment](https://i.imgur.com/riWwdXL.png)

- **Profile**: you can define your own comment profiles in the settings and use it here.
- **User Agent**: You can select from multiple differents user agents or add new in the settings.
- **Post**: with this field you can select the post from your blog where the comment will be published.
- **Name**: Author name. This fields accepts spintax format and 3d spintax format.
- **Email**: Author email. This fields accepts spintax format and 3d spintax format.
- **Web**: Author web. This fields accepts spintax format and 3d spintax format.
- **IP**: IP address from which the comment is made. With the right button you can generate a random address.
- **Date**: Date when the comment will be published.
- **Status**: Choose if you want an auto published comment or you prefeer review it before.
- **Comment**: Comment to be published. This fields accepts spintax format and 3d spintax format.

### Bulk and auto schedule multiple comments

![Bocas Bot - Bulk Comments](https://i.imgur.com/ojKFhMQ.png)

With this mode you can auto schedule multiple comments.
It has two different modes.
First of all you can put you comments in CSV format and paste it on the text area field or otherwise you can upload a CSV file and the plugin will be able to process it and delete it after that.

This CSV mode has a specific format and it is the following:

``` bash
post-id,author-name,author-email,author-web,ip-address,date,comment,comment-status,user-agent
```

Each field should be splitted by a single comma and each comment have to be in a different line.

Whether you paste the csv text in the field or upload the file, always it has to be with the specified format.

### Add new User Agents

![Bocas Bot - User Agents](https://i.imgur.com/JpMv2gq.png)

This plugin come with ten different user agents to use them but if you want to add a new one you can do it through *Settings* panel.  