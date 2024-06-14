import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;


Alpine.start();

// resources/js/app.js

// Define the function globally
function elementExistsById(id)
 {
    return document.getElementById(id)
 !== null;
}
function elementExistsByClass(className) {
    return document.querySelectorAll(`.${className}`).length > 0;
}

function displaydata(products){
    var productContainer = document.getElementById('allproduct');
        productContainer.innerHTML = '';

        for (let i = 0; i < products.length; i++) {
            var productImgPath = `storage/img/product/${products[i].img}`;
            var productHtml = `
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-product-area mb-50">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="shop-details.html"><img src="${productImgPath}" alt="${products[i].name}"></a>
                            <!-- Product Tag -->
                            <div class="product-tag">
                                <a href="#">Hot</a>
                            </div>
                            <div class="product-meta d-flex">
                                <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                <a href="#" class="add-to-cart-btn">Add to cart</a>
                                <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                            </div>
                        </div>
                        <!-- Product Info -->
                        <div class="product-info mt-15 text-center">
                            <a href="shop-details.html">
                                <p>${products[i].name}</p>
                            </a>
                            <h6>${products[i].price}</h6>
                        </div>
                    </div>
                </div>
            `;
            productContainer.innerHTML += productHtml;
        }
}


document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('alldatafetch')) {
        document.getElementById('alldatafetch').addEventListener('click', function(event) {
            event.preventDefault();
            axios.get('/FetchAllProduct')
                .then(function (response) {
                    // Handle successful response
                    var products = response.data.data;
                    displaydata(products);
                })
                .catch(function (error) {
                    // Handle error
                    console.error('Error fetching data:', error);
                });
        });
    } else {
        console.log('Element with ID "alldatafetch" does not exist.');
    }

    if(elementExistsByClass('FetchProductWithId'))
        {
            var elements = document.getElementsByClassName('FetchProductWithId');
            Array.from(elements).forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var value = element.getAttribute('id');
                    var value = element.getAttribute('value');
                    
                    axios.get(`/FetchProductWithId/${value}`)
                        .then(function (response) {
                            // console.log(response);
                            var products = response.data.data;
                            displaydata(products);
                        })
                        .catch(function (error) {
                            console.log('Error fetching data:', error);
                        });
                });
            });
        }
       
});

