#!/bin/bash

mysqldump -uroot -pmalunki malunki >> /var/sql-dumps/malunki-$(shell date -d "today" +"%Y%m%d%H%M").sql
