'use strict';

app = angular.module 'app.controllers', []

app.controller 'PostsListController', ['$rootScope', '$http', ($rootScope, $http) ->
    new class PostsListController
        constructor: () ->
            @posts = []
            $http.get('/api/posts').success (data) => (@posts = data)
        ,
        postClicked: (post) ->
            $rootScope.$broadcast('postSelected', post)
]


app.controller 'PostsPreviewController', ['$rootScope', '$scope', '$http', ($rootScope, $scope, $http) ->
    new class PostsPreviewController
        constructor: () ->
            @post = {}

            unbind = $rootScope.$on 'postSelected', (scope, post) =>
                @post = post

            $rootScope.$on('$destroy', unbind)
]