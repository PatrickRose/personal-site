#!/bin/sh
echo "TRUNCATE TABLE personalblogs" | mysql -u root -proot vagrant

vendor/bin/behat -p phantomjs --append-snippets $1
