# #!/bin/bash
# 
# #------------------------------------------------------------
# # WORDPRESS
# echo "Install Wordpress"
# # git clone https://github.com/WordPress/WordPress.git
# # mv WordPress/* .
# # rm -rf WordPress
# 
# #------------------------------------------------------------
# # DELETE DEFAULT THEMES
# echo "Delete default themes"
# cd wp-content/themes
# rm -rf twentyeleven
# rm -rf twentyfifteen
# rm -rf twentyfourteen
# rm -rf twentyten
# rm -rf twentythirteen
# rm -rf twentytwelve
# 
# #------------------------------------------------------------
# # INSTALL SMARTY THEME
# echo "Install Smarty theme"
# git clone https://github.com/Sauruz/smartytheme.git
# 
# cd smartytheme
# 
# #------------------------------------------------------------
# # CREATE MISSING DIRECTORIES
# echo "Create missing directories"
# mkdir templates_c
# mkdir src/img
# 
# #------------------------------------------------------------
# # COMPOSER
# echo "Install composer packages"
# echo '{
#     "require": {
#         "smarty/smarty": "~3.1"
#     }
# }'  > composer.json
# composer install
# 
# #------------------------------------------------------------
# #NPM PACKAGES
# echo "Install NPM packages"
# 
# echo '{
#   "name": "themepackage",
#   "version": "1.0.0",
#   "description": "Standard package with gulp, bower and NPM",
#   "main": "index.js",
#   "scripts": {
#     "test": "echo \"Error: no test specified\" && exit 1"
#   },
#   "author": "",
#   "license": "ISC",
#   "dependencies": {
#   }
# }' > package.json
# 
# npm install
# npm install del --save
# npm install gulp --save
# npm install gulp-concat --save
# npm install gulp-flatten --save
# npm install gulp-clean-css --save
# npm install gulp-notify --save
# npm install gulp-plumber --save
# npm install gulp-rename --save
# npm install gulp-sass --save
# npm install gulp-uglify --save
# npm install merge-stream --save
# npm install run-sequence --save
# 
# #------------------------------------------------------------
# # BOWER PAKACKAGES
# echo "Install bower packages"
# echo '{
#   "name": "themepackageBower",
#   "authors": [
#     "Guido <G.rus@de-rus.nl>"
#   ],
#   "description": "",
#   "main": "",
#   "license": "MIT",
#   "homepage": "http://www.de-rus.nl",
#   "private": true,
#   "ignore": [
#     "**/.*",
#     "node_modules",
#     "bower_components",
#     "test",
#     "tests"
#   ],
#   "dependencies": {
#    "jquery": "2.2.4"
#   }
# }' > bower.json
# 
# bower install
# bower install jquery --save
# bower install font-awesome --save
# bower install bootstrap-sass --save
# bower install angular --save
# bower install Hover --save
# # bower install datatables.net --save
# # bower install datatables.net-bs --save
# # bower install ckeditor --save
# # bower install sweetalert --save
# # bower install flatpickr-calendar --save
# # bower install hint.css --save
# # bower install magic --save
# # bower install fullpage.js --save
# 
# #------------------------------------------------------------
# # RUN GULP
# echo "Run main Gulp task"
# gulp