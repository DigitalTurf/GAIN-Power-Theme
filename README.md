# Contributing
## Agreement

By submitting any work to this project, you agree to the following principal guidelines:

1. Any work contributed is original work, or you otherwise have the right to submit the work;
1. You grant this project and its members a non-exclusive, irrevocable license to use your submitted work in any way; and,
1. You are capable of granting these rights for the contribution.


### Development
#### Reset Development Instance
In the event that you need to reset the development instance to be an exact clone of the production site, take these steps:

1. **SSH Connection:** Establish an SSH connection with the hosting server. Check the [DevOPs documentation](https://docs.google.com/document/d/1KFToLYK7Ii_Wdjo7dVBNsxy1kn69Avqb7H8ACqQPvC4) for the SSH info.

1. **Run Reset Script:** On the host server, run the following script to backup the existing development environment and load an exact clone of the production server in you instance:
```bash
$ sh ~/scripts/reset-user-dev.sh
```
Please be patient. This script can take a few minutes to complete.


#### Contributing to the GAIN Power theme

All the changes to the site should be done in your development instance. All edits will be pushed to your branch in this repo. Internal and client reviews will happen on the dev site and once approved, they will be deployed to production.

1. **Open theme directory in FTP:** Check the [DevOPs documentation](https://docs.google.com/document/d/1KFToLYK7Ii_Wdjo7dVBNsxy1kn69Avqb7H8ACqQPvC4) for the FTP info. Once a connection has been established, browse to the `~/userdev/YOURNAME/wp-content/themes/listingpro-child` directory.

1. **Edit files:** Make any edits to the theme files as needed. If you need to make changes to the SCSS files, you'll need to start the SASS program to compile the general.css file. To start the SASS compiler, run the following script on the SSH connection:
```bash
## Start SASS Watcher. Stop with CTRL + C.
$ sh ~/scripts/sass-dev.sh
```

1. **Commit Changes:** Once all your changes have been made, commit them by running the commit script and providing info when prompted:

```bash
## Select your instance and enter your commit message when prompted.
$ sh ~/scripts/commit-dev.sh
```

#### Deploying User Dev to production
Once your changes have approved, Phillip will deploy them to the development instance for client review and eventually deploying to production instance with the following script:

```bash
## Deploy theme to production.
$ sh ~/scripts/deploy-dev-prod.sh
```

>*Note:* The script will update the production instance's `listingpro-child` theme to match the current version in the repo. Unstaged or uncommitted changes will not be updated. All database, plugin and uploaded files have to managed/updated in the production instance.

#### Roll back last deployment
In the event that the last deployment is causing issues, run this this command to roll back the changes:
```bash
## Roll back theme on production one commit.
$ sh ~/scripts/rollback-dev-prod.sh
```
>*Note:* If you do end up rolling back a commit, you'll need to make any changes to resolve the issue in the development instance and deploy again. This will then deploy both the bugged commit and your fixed commit.

#### Purging Cloudflare and CDN Caches
The production instance is cached by both Cloudflare and Stack Path CDN. To see any changes to the site files, the caches will need to be cleared. Run this script to purge these caches:
```bash
## deploy.
$ sh ~/scripts/purge-caches.sh
```

>*Note:* Deploying or rolling back the production theme will automatically purge these caches.
