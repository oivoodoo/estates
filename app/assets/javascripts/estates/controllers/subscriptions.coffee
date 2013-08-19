estates.controller 'SubscriptionsController', [
  '$scope', '$http', '$timeout'
  ($scope, $http, $timeout) ->
    $scope.submit = (event) ->
      $http.post('/subscriptions', email: $scope.email).success (data) ->
        $timeout ->
          $scope.$apply ->
            $scope.email = ''
            $.gritter.add
              image:'/assets/success.png'
              title:'Notification'
              text:data.message
        , 10
]

