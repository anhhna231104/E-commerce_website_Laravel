/*
 Copyright (c) 2007-2024, CKSource Holding sp. z o.o. All rights reserved.
 For licensing, see LICENSE.html or https://ckeditor.com/sales/license/ckfinder
 */

 var config = {};

 // Set your configuration options below.
 
 // Examples:
 config.language = 'en';
 config.skin = 'moono-lisa';
 
 // Define authentication callback function
 config.authentication = function () {
     return true; // Adjust this to your authentication logic
 };
 
 // Define backends
 config.backends = [
     {
         'name': 'default',
         'adapter': 'local',
         'baseUrl': '/project-app/public/upload/blog/',
         'chmodFiles': parseInt('0777', 8),
         'chmodFolders':  parseInt('0755', 8),
         'filesystemEncoding': 'UTF-8'
     }
 ];
 
 // Apply the CKFinder configuration
 CKFinder.define(config);
 