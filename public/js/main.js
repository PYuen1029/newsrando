(function () {

	'use strict';

	// requires
	require('angular');
	require('angular-route');
	require('angular-animate');
	require('angular-sanitize');
	require('angular-aria');
	require('angular-ui-bootstrap');

	var homepageCtrl = require('./controllers/HomepageCtrl');
	var newsSourceCtrl = require('./controllers/NewsSourceCtrl');
	var NewsSourceSvc = require('./services/NewsSourceSvc');
	var FrontpageSvc = require('./services/FrontpageSvc');

	// angular begins
	angular.module(
		'FrontpagesApp', 
		['ngRoute', 'ngAnimate', 'ngSanitize', 'ui.bootstrap']
	)

	// configs
	.config([
		'$locationProvider',
		'$routeProvider',
		function($locationProvider, $routeProvider) {
			$locationProvider.hashPrefix('!');
			// routes
			$routeProvider
				.when("/", {
					templateUrl: "./partials/homepage.html",
					controller: "HomepageController"
				})
				.when('/NewsSourceManager', {
					templateUrl: "./partials/newsSource.html",
					controller: "NewsSourceController"
				})
				.otherwise({
					 redirectTo: '/'
				});
		}
	])

	// services	
	.service('NewsSourceSvc', ['$http', NewsSourceSvc])
	// FrontpageSvc replaced by frontpage:update artisan command
	.service('FrontpageSvc', ['$http', FrontpageSvc])

	//controllers
	.controller('HomepageController', ['$scope', homepageCtrl])
	.controller('NewsSourceController', ['$scope', '$http', '$location', 'NewsSourceSvc', newsSourceCtrl]);
}());