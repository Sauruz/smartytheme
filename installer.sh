#!/bin/bash

echo "Name package (no spaces, no capitals): "
read websitename
echo "Description package: "
read websitedescription
echo "Author: "
read author
echo "Author email: "
read authoremail
echo "Website of author: "
read authorwebsite

# CREATE MISSING DIRECTORIES
echo "------------------------------------------------------------"
echo "Create missing directories"
echo "------------------------------------------------------------"
mkdir templates_c
mkdir src/img
mkdir php

echo "------------------------------------------------------------"
echo "Remove git files from theme"
echo "------------------------------------------------------------"
rm -rf .git
rm -rf .gitignore


# COMPOSER
echo "------------------------------------------------------------"
echo "Install composer packages"
echo "------------------------------------------------------------"
echo '{
    "require": {
        "smarty/smarty": "~3.1"
    }
}'  > composer.json
composer install

#NPM PACKAGES
echo "------------------------------------------------------------"
echo "Install NPM packages"
echo "------------------------------------------------------------"

echo '{
  "name": "'$websitename'",
  "version": "1.0.0",
  "description": "'$websitedescription'",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "author": "'$author' <'$authoremail'>",
  "license": "ISC",
  "dependencies": {
  }
}' > package.json

npm install
npm install del --save-dev
npm install gulp --save-dev
npm install gulp-concat --save-dev
npm install gulp-flatten --save-dev
npm install gulp-clean-css --save-dev
npm install gulp-notify --save-dev
npm install gulp-plumber --save-dev
npm install gulp-rename --save-dev
npm install gulp-sass --save-dev
npm install gulp-uglify --save-dev
npm install merge-stream --save-dev
npm install run-sequence --save-dev
npm install gulp-real-favicon --save-dev
npm install path --save-dev
npm install gulp-image --save-dev
npm install gulp-changed --save-dev
npm install gulp-replace --save-dev

npm install bootstrap@latest --save
npm install font-awesome --save
# npm install bourbon --save
# npm install hint.css --save
# npm install hover.css --save
# npm install sweetalert2 --save


# RUN GULP
echo "------------------------------------------------------------"
echo "Run main Gulp task"
echo "------------------------------------------------------------"
gulp

# DELETE OLD WORDPRESS DIR
echo "------------------------------------------------------------"
echo "Delete old Worpress dir"
echo "------------------------------------------------------------"
cd ..
cd ..
cd ..
rm -rf WordPress