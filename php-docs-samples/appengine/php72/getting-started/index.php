<?php
/*
 * Copyright 2018 Google LLC All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * This front controller is called by the App Engine web server to handle all
 * incoming requests. To change this, you will need to modify the "entrypoint"
 * directive in `app.yaml`.
 * @see https://cloud.google.com/appengine/docs/standard/php/config/appref
 */
require_once __DIR__ . '/vendor/autoload.php';

/** @var Slim\App $app */
$app = require __DIR__ . '/src/app.php';
require __DIR__ . '/src/controllers.php';

$app->run();
