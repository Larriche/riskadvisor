#!/bin/bash

echo "Install NPM Packages"
cd /var/www/html && npm install

echo "Build Frontend for Development"
cd /var/www/html && npm run dev
