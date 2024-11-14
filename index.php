<?php

/**
 * Project: To-Do List Application
 * 
 * A simple application to manage tasks with features to add, update, delete, 
 * and sort tasks based on priority and status.
 * 
 * Created By: William Harry A. Dancel
*/


session_start();
require_once 'core/UriHandler.php';
require_once 'core/TaskController.php';

// Instantiate the UriHandler class to parse the request URI.
$uri = new UriHandler;
$uri->getUri();

// Instantiate the TaskController with the parsed URI path to handle the request.
$processor = new TaskController($uri->path);
