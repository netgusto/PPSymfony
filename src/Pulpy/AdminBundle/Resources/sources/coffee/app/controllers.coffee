'use strict';

app = angular.module 'app.controllers', []

app.controller 'PostsListController', ['$scope', '$http', 
    class PostsListController
        constructor: ($scope, $http) ->
            @posts = []
            $http.get('/api/posts').success (data) => (@posts = data)
]