<?php

define('API_BASE_URL' ,getenv('API_BASE_URL') ?: 'http://localhost:8080/backend-java/');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'dbsvis');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');