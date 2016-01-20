// Hey group! To help you better understand MVC follow the docs~!
/* MVC is the name of the game here, it is the architecture many webapps are built around.
Model is the structure we define to access data on the server. 
View is the html template that is served to the client
Controller is the business and function logic that interacts with the model and views
http://embed.plnkr.co/dd8Nk9PDFotCQu4yrnDg/script.js*/
/*This line defines the overall app. Since in OO variable == objects app contains the
angular module 'inventoryApp' we reference app in js and 'inventoryApp' in html*/
var app = angular.module('inventoryApp', ['ngRoute']);
/*Here we are also using 'ngRoute'. It allows us to define a view to appear when a condition is met
like clicking on a link. Unlike regular html where the whole page is loaded only a section is
'injected' into the html page. This way we don't have to reload the whole page and the server only
has to send the webpages instead of rendering them (like in php).*/

// create the module and name it scotchApp
var app = angular.module('inventoryApp', ['ngRoute']);

// configure our routes
app.config(function($routeProvider) {
  $routeProvider

  // route for the home page
    .when('/', {
    templateUrl: 'pages/inventory.html',
    controller: 'mainController',
    activetab: 'inventory'
  })

  // route for the about page
  .when('/equipment', {
    templateUrl: 'pages/equipment.html',
    controller: 'equipmentController',
    activetab: 'equipment'
  })

  // route for the contact page
  .when('/import', {
    templateUrl: 'pages/import.html',
    controller: 'importController',
    activetab: 'import'
  })

  .when('/report', {
    templateUrl: 'pages/reports.html',
    controller: 'reportController',
    activetab: 'report'
  })

  .when('/admin', {
    templateUrl: 'pages/admin.html',
    controller: 'adminController',
    activetab: 'admin'
  });
});

function TabsCtrl($scope, $location) {
  $scope.tabs = [
      { link : '#', label : 'Inventory' },
      { link : '#/equipment', label : 'Equipment' },
      { link : '#/import', label : 'Import Tool' },
      { link : '#/report', label : 'Reports' }/*,
      { link : '#/admin', label : 'admin' }*/
    ]; 
    
  $scope.selectedTab = $scope.tabs[0];    
  $scope.setSelectedTab = function(tab) {
    $scope.selectedTab = tab;
  }
  
  $scope.tabClass = function(tab) {
    if ($scope.selectedTab == tab) {
      return "active";
    } else {
      return "";
    }
  }
}

// create the controller and inject Angular's $scope
app.controller('mainController', function($scope) {

});

app.controller('equipmentController', function($scope) {
  $scope.message = 'Look! I am an about page.';
});

app.controller('importController', function($scope) {
  $scope.message = 'Contact us! JK. This is just a demo.';
});

app.controller('reportController', function($scope) {
  $scope.message = 'Contact us! JK. This is just a demo.';
});

app.controller('adminController', function($scope) {
  $scope.message = 'Contact us! JK. This is just a demo.';
});