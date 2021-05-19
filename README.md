[![Build Status](https://travis-ci.org/CSIS-iLab/defense360_wp.svg?branch=development)](https://travis-ci.org/CSIS-iLab/defense360_wp)

# defense360_wp
WordPress theme for [Defense360](https://defense360.csis.org). Developed from the [_s starter theme](http://underscores.me).

## Contributing
1. New features & updates should be created on individual branches. Branch from `master`
2. When ready, submit pull request into `development`
3. TravisCI will automatically deploy changes on `development` to the staging site
4. After reviewing your work on the staging site, use WPEngine to move from staging to live
5. Submit a pull request from `development` into `master`.

## Development

### Composer
This project uses [Composer](https://getcomposer.org/) to manage WordPress plugin and theme dependencies.
To update dependencies, run `composer update`.

#### Required Plugins
- Co Authors Plus
- Disable Comments
- Disable Emojis
- Google Authenticator
- Jetpack
- Page Links To
- Search & Filter
- Search by Aloglia
- TinyMCE Advanced
- Yoast SEO

## Gulp
This project uses [Gulp](https://gulpjs.com/) to compile the SASS files. To run the compiler:
1. Navigate to `wp-content/themes/defense360` folder
2. Run `npm run start`