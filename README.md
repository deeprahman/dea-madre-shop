### Dea Madre E-Shop

## Install JavaScript dependencies by running the following command

```
npm install
```

## Build

Various build commands are available that execute the webpack 5 builds:

- `npm run build` - development webpack build (`webpack --mode development`).
- `npm run dist` - production webpack build, with code minification enabled (`webpack --mode production`).
- `npm run watch` - development watch command.

## Deploying the Theme

This theme can be downloaded and deployed into a WordPress instance's themes directory (i.e. `/wp-content/themes`). Once the theme is deployed, run the build commands (`npm install` and `npm run dist`) to install and build the JavaScript and CSS.

## Theme setup

1. Install and active the WooCommerce
2. Delete all the pages created by WooCommerce also remove them from the WordPress trash
3. Active the Dea Madre Shop theme
4. Set static home page to `Home`
4. Create two product categories `Wine`  and  `Beverage`
5. Add some product and assign any of the two categories
6. The products will be shown in the 'Our Shop' page under the Shop nav link

### Note: The theme uses pretty permalink and automatically change to it ofter theme setup

### Note: The theme requires WordPress v. 5.5 or above

### Note: To bypass ssl check, add this in your wp-config.php  ```define('WP_ENVIRONMENT_TYPE', 'development');```
