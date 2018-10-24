# 💋 💋 Bocas Bot - Auto WP Comments Scheduler

![Bocas Bot - Auto WP Comments Scheduler](https://i.imgur.com/r4pZ8D0.png)

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

### Add new comment profiles

![Bocas Bot - User Agents](https://i.imgur.com/TPlPK2k.png)

If you want to save time and define the same author name, author email, author web (backlink) and comment to use them multiple times on your own auto scheduled comments you can do it through the *Profiles* tab in *Settings* panel.

As in the other plugin's options you can add the spintax format in these fields. 

## How to develop and contrib

If you want to develop new features or if you want to contribute fixing bugs you don't need install nothing except docker compose.

This plugin comes with a docker-compose file with all the needed configuration to download a copy of Wordpress and be used it as black-boxed.

The docker-compose file will download an image from PHP (where wordpress and the plugin will be) and another image for the database with MySQL installed.

To use it just launch the following command on the root folder.

``` bash
$ docker-compose up -d --build
```

That command will download the images, the Wordpress CMS and it will lift the containers.

Then you just go to *http://localhost:8080* and *voilá*

To add a new feature or a fixed bug you should use git and generate a branch from master branch.

When the code is done send me a +Pull Request+ so i can review it and merge your branch.
