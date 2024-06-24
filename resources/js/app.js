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

function displaydata(products,paginationLinks){
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
                            <a href="/shopDetail/${products[i].id}">
                                <p>${products[i].name}</p>
                            </a>
                            <h6>${products[i].price}</h6>
                        </div>
                    </div>
                </div>
            `;
            productContainer.innerHTML += productHtml;
        }
        var paginationContainer = document.getElementById('paginationLinks');
        paginationContainer.innerHTML = paginationLinks;
       
        var paginationLinks = paginationContainer.querySelectorAll('a.page-link');
        Array.from(paginationLinks).forEach(function (link)
        {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    fetchProducts(link.href);
                });
            });
}

function fetchProducts(url) {
    axios.get(url)
        .then(function (response) {
            
            console.log('Response data:', response.data.data.data);
           var products = response.data.data.data;
             var paginationHtml = response.data.paginationLinks;
            console.log(response.data.paginationLinks);
             displaydata(products, paginationHtml);
        })
        .catch(function (error) {
            console.error('Error fetching data:', error);
        });
}

function sub(value,stock) {
    var effect = document.getElementById('qty');
    var qty = parseInt(effect.value);
    
   
    if (!isNaN(qty)) {
        qty -= Math.abs(value);
        if (qty >= 1 && qty <= stock) {
            effect.value = qty;
            if(effect.value < stock ){
                document.getElementById('AvailabeleStock').innerHTML='';
            }
        }
    }
}


function add(value,stock) {
    var effect = document.getElementById('qty');
    var qty = parseInt(effect.value);
    if (!isNaN(qty)) {
        qty += value;
        if (qty >= 1 && qty <= stock) {
            effect.value = qty;
            if(effect.value == stock ){
                alert('Only Available Stock ' + stock);
            }
        }
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
                    //console.log(products);
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

    if(elementExistsByClass('FetchProductWithValue'))
        {
            var elements = document.getElementsByClassName('FetchProductWithValue');
            Array.from(elements).forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                   
                    var value = element.getAttribute('value');
              
                    axios.get(`/FetchProductWithId/${value}`)
                        .then(function (response) {
                            // console.log(response);
                            var products = response.data.data.data;
                            var paginationLinks = response.data.paginationLinks;
                            console.log(products);
                            displaydata(products,paginationLinks);
                        })
                        .catch(function (error) {
                            console.log('Error fetching data:', error);
                        });
                });
            });
        }
        if(elementExistsByClass('sub')) {
            var elements = document.getElementsByClassName('sub');
            Array.from(elements).forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var value = parseInt(element.getAttribute('value'));
                    var stock = parseInt(document.getElementById('stock').getAttribute('value')); // Stock 
                    var id = parseInt(document.getElementById('id').getAttribute('value')); // id 
                    sub(value,stock,id);
                   
                });
            });
        }

        if(elementExistsByClass('add')) {
            var elements = document.getElementsByClassName('add');
            Array.from(elements).forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    var value = parseInt(element.getAttribute('value'));
                    var stock = parseInt(document.getElementById('stock').getAttribute('value')); // Stock 
                    var id = parseInt(document.getElementById('id').getAttribute('value')); // id 
                    add(value,stock,id);
                });
            });
        }
       
        if(elementExistsById('AddTocart')) {
         this.getElementById('AddTocart').addEventListener('submit',function(event){
            event.preventDefault();
               
                const qty = document.getElementById('qty').value;
                const id = document.getElementById('id').value;
                axios.post('/addtocart', {
                    qty: qty,
                    id: id
                })
                .then(function (response) {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
         })
           
        }
       
           
       
});


