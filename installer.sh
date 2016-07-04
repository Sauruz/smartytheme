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
npm install del --save
npm install gulp --save
npm install gulp-concat --save
npm install gulp-flatten --save
npm install gulp-clean-css --save
npm install gulp-notify --save
npm install gulp-plumber --save
npm install gulp-rename --save
npm install gulp-sass --save
npm install gulp-uglify --save
npm install merge-stream --save
npm install run-sequence --save
npm install gulp-real-favicon --save


# BOWER PAKACKAGES
echo "------------------------------------------------------------"
echo "Install bower packages"
echo "------------------------------------------------------------"
echo '{
  "name": "'$websitename'",
  "authors": [
    "'$author' <'$authoremail'>"
  ],
  "description": "'$websitedescription'",
  "main": "",
  "license": "MIT",
  "homepage": "'$authorwebsite'",
  "private": true,
  "ignore": [
    "**/.*",
    "node_modules",
    "bower_components",
    "test",
    "tests"
  ],
  "dependencies": {
  	"jquery": "2.2.4"
  }
}' > bower.json

bower install
bower install font-awesome --save
bower install bootstrap-sass --save
bower install angular --save
bower install Hover --save
# bower install datatables.net --save
# bower install datatables.net-bs --save
# bower install ckeditor --save
# bower install sweetalert2 --save
# bower install flatpickr-calendar --save
# bower install hint.css --save
# bower install magic --save
# bower install fullpage.js --save

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