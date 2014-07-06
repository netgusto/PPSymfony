(function() {
    var app = angular.module('store', []);

    app.controller('StoreController', function() {
        this.products = gems;
    });

    app.controller('PanelController', function() {
        this.selectTab = function(tab) {
            this.tab = tab;
        };

        this.isSelected = function(tab) {
            return this.tab === tab;
        };

        this.selectTab(1);
    });

    app.controller('ReviewController', function() {
        this.review = {};

        this.addReview = function(product) {
            product.reviews.push(this.review);
            this.review = {};
        };
    });

    var gems = [
        {
            name: 'Dodecahèdre',
            price: 2.95,
            description: 'lorem ipsum',
            canPurchase: false,
            soldOut: false,
            reviews: []
        },
        {
            name: 'Pentagone',
            price: 12.95,
            description: 'Un joli pentagone',
            canPurchase: true,
            soldOut: false,
            reviews: [
                {
                    stars: 5,
                    body: 'Awesome !',
                    author: 'mail@jeromeschneider.fr'
                },
                {
                    stars: 3,
                    body: 'Super',
                    author: 'contact@netgusto.com'
                }
            ]
        }
    ];
})();