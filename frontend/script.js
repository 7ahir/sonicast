var app = angular.module('myApp', ['ngTouch']);
app.controller('myCtrl', function($scope,$http) {

  $scope.selected = null;
  var audios = [
    {},
    new Audio('sounds/rain_1.wav'),
    new Audio('sounds/rain_2.wav'),
    new Audio('sounds/rain_3.wav'),
    new Audio('sounds/rain_4.wav'),
  ]

  $scope.weather = [];

  $scope.formInput = {
    city: "",
    datevalue: new Date()
  };


  var init = function () {
    $http({
      method: 'GET',
      // url: "http://ip172-18-0-47-c04o3qb6hnp000bgojl0-80.direct.labs.play-with-docker.com/weatherforecast/cities",
      // url: "http://82.165.100.140:8001/weatherforecast/cities",
      url: "backend.php?action=getCityList"
    
    }).then(function successCallback(response) {
     $scope.cities = response.data;
    }, function errorCallback(response) {
    });
 };
 // and fire it after definition
 init();


 $scope.sendData =  function(){
   
  if($scope.formInput.datevalue == "" || $scope.formInput.city == ""){
    return;
  }

  
  var year =  $scope.formInput.datevalue.getFullYear();
  var month =  $scope.formInput.datevalue.getMonth()+1; // beware: January = 0; February = 1, etc.
  var day =  $scope.formInput.datevalue.getDate();
  var hour =  $scope.formInput.datevalue.getHours();

  var chosenDate = year+'-'+month+'-'+day+"T"+hour+":00:00Z";

  $http({
    method: 'GET',
    url: "backend.php?action=getWeather&city="+$scope.formInput.city+"&date="+chosenDate,    
    
  }).then(function successCallback(response) {
      $scope.weather =  response.data;

  }, function errorCallback(response) {
  });
 
}



$(document).on('touchstart',".card" ,function(){

  var index = $(this).attr('preip-value');
  var id = $(this).attr('card-index');
  $scope.selected = id;

  // if(navigator.userAgent.indexOf('Safari')){
    audios[index].loop = true;
    audios[index].play();
  // }else{
  //   var path = "sounds/rain_"+index+".wav" ;
  //   loopify(path,function (err,loop) {
  //     if (err) {
  //         console.warn(err);
  //     }
  //     loop.play();
  // });
  // }

  $scope.$apply();
});

$(document).on('touchend',".card" ,function(){
  var index = $(this).attr('preip-value');
  audios[index].loop = false;
  $scope.selected = null; 

  
  // if(navigator.userAgent.indexOf('Safari')){
    audios[index].pause();
    audios[index].currentTime = 0;
  // }else{
  //   var path = "sounds/rain_"+index+".wav" ;
  //   loopify(path,function (err,loop) {
  //     if (err) {
  //         console.warn(err);
  //     }
  //     loop.stop();
  //   });
  // }
  $scope.$apply();

});


$(document).on('click',".card" ,function(){
  var index = $(this).attr('preip-value');
  audios[index].loop = false;
  $scope.selected = null; 
  audios[index].pause();
  audios[index].currentTime = 0;
  $scope.$apply();
});





});

