

let uncheckAllCheckbox = function (checkboxes) {
    let cboxes = checkboxes;
    if(
        Object.getPrototypeOf(cboxes).toString() === "[object HTMLCollection]" ||
        Object.getPrototypeOf(cboxes).toString() === "[object NodeList]"
    ) {

    } else {
        cboxes = document.querySelectorAll(checkboxes);
    }

    for (let i = 0; i < cboxes.length; i++) {
        cboxes[i].checked = false;
    }
};
function showAjaxProgress(msg) {
    let el = document.createElement('div');
    el.classList.add('ajax-is-progressing');
    el.innerHTML = msg;
    document.body.classList.add('ajax-on-going');
    document.body.appendChild(el);
}
function closeAjaxProgress() {
    setTimeout(function(){
        document.body.classList.remove('ajax-on-going');
        document.querySelector('.ajax-is-progressing').remove();
    }, 1000);

}

class Purchase extends Product {
    constructor() {
        super();
        this.purchaseProductList = [];
        this.purchasePaymentList = [];
        this.warehouseId = null;
        this.vendorId = null;
        this.totalPrice = 0;
        this.checkedProducts = [];

        // dom element
        this.purchaseItems = document.querySelector('.purchase-items');
        this.totalPriceDom = document.querySelector('.purchase-total-price tr td.p-total-price');
        this.totalDueDom = document.querySelector('.purchase-due tr td.p-total-due');
        this.vendorDom = document.querySelector('.vendor');
        this.warehouseDom = document.querySelector('.warehouse');
        this.paymentButtonDom = document.querySelector('.payment-button');
        this.purchasePaymentsDom = document.querySelector('.purchase-payments');
        this.productsDom = document.querySelectorAll('input[name="products"]');
        this.addMultipleProductsToDom = document.querySelector('.add-multiple-products');
        this.endPurchaseDom = document.querySelector('.end-purchase');

        let purchaseThis = this;




        // add single item to purchase list
        (function(){
            let purchaseDataTable = document.querySelector('#purchase-dataTable');
            purchaseDataTable.onclick = function(e) {
                    if(e.target.classList.contains('add-to-purchase-icon')) {
                        let productDetails = e.target.getAttribute('product-details');
                        productDetails = JSON.parse(productDetails);
                        let isProductAddedToPurchaseList = purchaseThis.addToPurchaseProductList(productDetails);
                        if(isProductAddedToPurchaseList) {
                            purchaseThis.updateTheProductPurchaseListGui(productDetails);
                            purchaseThis.canLeaveThePage();
                            purchaseThis.togglePurchaseItemEmptyMessage();
                            Codebase.helpers('notify', {
                                align: 'right',             // 'right', 'left', 'center'
                                from: 'bottom',                // 'top', 'bottom'
                                type: 'success',               // 'info', 'success', 'warning', 'danger'
                                icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                                message: `product "${productDetails.name}" successfully added`
                            });
                        } else {
                            Codebase.helpers('notify', {
                                align: 'right',             // 'right', 'left', 'center'
                                from: 'bottom',                // 'top', 'bottom'
                                type: 'danger',               // 'info', 'success', 'warning', 'danger'
                                icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                                message: `product "${productDetails.name}" already added`
                            });
                        }
                    }

                    if(e.target.classList.contains('product-checkbox')) {
                        purchaseThis.getCheckedProducts();
                    }
                };
        })();

        // add multiple item to purchase list
        (function(){
            purchaseThis.addMultipleProductsToDom.onclick = function() {
                if(purchaseThis.checkedProducts.length > 0) {
                    for (let i = 0; i < purchaseThis.checkedProducts.length; i++) {
                        let productDetails = purchaseThis.checkedProducts[i];

                        productDetails = JSON.parse(productDetails);

                        let isProductAddedToPurchaseList = purchaseThis.addToPurchaseProductList(productDetails);

                        if(isProductAddedToPurchaseList) {
                            purchaseThis.updateTheProductPurchaseListGui(productDetails);
                            purchaseThis.canLeaveThePage();
                            purchaseThis.togglePurchaseItemEmptyMessage();
                            Codebase.helpers('notify', {
                                align: 'right',             // 'right', 'left', 'center'
                                from: 'bottom',                // 'top', 'bottom'
                                type: 'success',               // 'info', 'success', 'warning', 'danger'
                                icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                                message: `product "${productDetails.name}" successfully added`
                            });
                        } else {
                            Codebase.helpers('notify', {
                                align: 'right',             // 'right', 'left', 'center'
                                from: 'bottom',                // 'top', 'bottom'
                                type: 'danger',               // 'info', 'success', 'warning', 'danger'
                                icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                                message: `product "${productDetails.name}" already added`
                            });
                        }
                    }
                    uncheckAllCheckbox(document.querySelectorAll('input[name="products"]'));
                    purchaseThis.checkedProducts = [];
                    purchaseThis.addMultipleProductsToDom.style.display = 'none';
                }
            };
        })();

        // remove single item to purchase list
        (function(){
            purchaseThis.purchaseItems.onclick = function(e) {
                e.preventDefault();
                if(e.target.classList.contains('remove-from-purchase-item')) {
                    let productId = e.target.getAttribute('product-id');
                    let removeElement = e.target.parentElement.parentElement.parentElement;
                    removeElement.classList.add('animated', 'slideOutRight');
                    setTimeout(function(){removeElement.remove();}, 1150);
                    purchaseThis.removePurchaseProductFromList(productId);
                   ""
                    purchaseThis.updateTotalDueInGui();
                }
            }
        })();

        // add purchase and quantity
        (function(){
            purchaseThis.purchaseItems.onkeyup = function(e) {
                // add purchase price to the purchase product
                if(e.target.classList.contains('purchase_price')) {
                    let purchasePrice = e.target.value;
                    let productId = e.target.getAttribute('product-id');
                    let isPurchasePriceValid = true;


                    // validate the purchase price
                    if (purchasePrice == 0 || parseFloat(purchasePrice) === NaN || isNaN(purchasePrice)) {
                        e.target.classList.add('is-invalid');
                        isPurchasePriceValid = false;
                    } else {
                        e.target.classList.remove('is-invalid');
                        isPurchasePriceValid = true;
                    }

                    if(isPurchasePriceValid) {
                        purchaseThis.addPurchasePriceToPurchaseItem(productId, purchasePrice);
                        purchaseThis.updateTotalPriceOfPurchaseItem(productId);
                        purchaseThis.updateTotalPriceOfPurchaseItemGui(productId);
                        purchaseThis.updateTotalPrice();
                        purchaseThis.updateTotalPriceGui();
                        purchaseThis.updateTotalDueInGui();

                    } else {
                        purchaseThis.addPurchasePriceToPurchaseItem(productId, 0);
                        purchaseThis.updateTotalPriceOfPurchaseItem(productId);
                        purchaseThis.updateTotalPriceOfPurchaseItemGui(productId);
                        purchaseThis.updateTotalPrice();
                        purchaseThis.updateTotalPriceGui();
                        purchaseThis.updateTotalDueInGui();

                        Codebase.helpers('notify', {
                            align: 'right',             // 'right', 'left', 'center'
                            from: 'bottom',                // 'top', 'bottom'
                            type: 'danger',               // 'info', 'success', 'warning', 'danger'
                            icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                            message: 'invalid purchase price!'
                        });

                       ""

                    }

                }

                // add purchase quantity to the purchase product
                if(e.target.classList.contains('purchase_quantity')) {
                    let purchaseQuantity = e.target.value;
                    let productId = e.target.getAttribute('product-id');
                    let isPurchaseQuantityValid = true;


                    // validate the purchase price
                    if (purchaseQuantity == 0 || parseFloat(purchaseQuantity) === NaN || isNaN(purchaseQuantity)) {
                        e.target.classList.add('is-invalid');
                        isPurchaseQuantityValid = false;
                    } else {
                        e.target.classList.remove('is-invalid');
                        isPurchaseQuantityValid = true;
                    }

                    if(isPurchaseQuantityValid) {
                        purchaseThis.addPurchaseQuantityToPurchaseItem(productId, purchaseQuantity);
                        purchaseThis.updateTotalPriceOfPurchaseItem(productId);
                        purchaseThis.updateTotalPriceOfPurchaseItemGui(productId);
                        purchaseThis.updateTotalPrice();
                        purchaseThis.updateTotalPriceGui();
                        purchaseThis.updateTotalDueInGui();

                    } else {
                        purchaseThis.addPurchaseQuantityToPurchaseItem(productId, 0);
                        purchaseThis.updateTotalPriceOfPurchaseItem(productId);
                        purchaseThis.updateTotalPriceOfPurchaseItemGui(productId);
                        purchaseThis.updateTotalPrice();
                        purchaseThis.updateTotalPriceGui();
                        purchaseThis.updateTotalDueInGui();

                        Codebase.helpers('notify', {
                            align: 'right',             // 'right', 'left', 'center'
                            from: 'bottom',                // 'top', 'bottom'
                            type: 'danger',               // 'info', 'success', 'warning', 'danger'
                            icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                            message: 'invalid quantity!'
                        });

                       ""
                    }

                }

            }
        })();

        // add vendor
        (function(){
            purchaseThis.vendorDom.onchange = function() {
                let vendorId = parseInt(this.value);
                let vendorIsValid = true;

                // validate vendor id
                if(isNaN(vendorId)) {
                    Codebase.helpers('notify', {
                        align: 'left',             // 'right', 'left', 'center'
                        from: 'bottom',                // 'top', 'bottom'
                        type: 'warning',               // 'info', 'success', 'warning', 'danger'
                        icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                        message: 'Please select one vendor!'
                    });
                    vendorIsValid = false;
                }

                if(vendorIsValid) {
                    purchaseThis.vendorId = vendorId;
                } else {
                    purchaseThis.vendorId = null;
                }
            }
        })();

        // add warehouse
        (function(){
            purchaseThis.warehouseDom.onchange = function() {
                let warehouseId = parseInt(this.value);
                let warehouseIsValid = true;

                // validate warehouse id
                if(isNaN(warehouseId)) {
                    Codebase.helpers('notify', {
                        align: 'left',             // 'right', 'left', 'center'
                        from: 'bottom',                // 'top', 'bottom'
                        type: 'warning',               // 'info', 'success', 'warning', 'danger'
                        icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                        message: 'Please select one warehouse!'
                    });
                    warehouseIsValid = false;
                }

                if(warehouseIsValid) {
                    purchaseThis.warehouseId = warehouseId;
                } else {
                    purchaseThis.warehouseId = null;
                }
            }
        })();

        // add payment to purchase
        (function(){
            purchaseThis.paymentButtonDom.onclick = function() {
                let paymentType = document.querySelector('.payment-type');
                let paymentPrice = document.querySelector('.payment-price');
                let paymentDescription = document.querySelector('.payment-description');
                let paymentError = {};
                // validate payment data
               ""

                if(paymentType.value === "") {
                    paymentType.classList.add('is-invalid');
                    paymentError["paymentType"] = "Please Select one payment method";
                } else {
                    paymentType.classList.remove('is-invalid');
                    delete  paymentError["paymentType"];
                }

                if( isNaN(paymentPrice.value) || parseFloat(paymentPrice.value) === NaN || paymentPrice.value === "" || parseFloat(paymentPrice.value) === 0 ) {
                    paymentPrice.classList.add('is-invalid');
                    paymentError["paymentPrice"] = "Please Enter a valid payment price";
                } else {
                    paymentPrice.classList.remove('is-invalid');
                    delete  paymentPrice["paymentPrice"];
                }

                let paymentErrorFound = Object.getOwnPropertyNames(paymentError);

                if(paymentErrorFound.length > 0) {
                    let paymentErrorMessage = "";
                    Object.keys(paymentError).forEach((key) => {
                        paymentErrorMessage += paymentError[key] + "<br>";
                    });
                   ""
                    Codebase.helpers('notify', {
                        align: 'left',             // 'right', 'left', 'center'
                        from: 'bottom',                // 'top', 'bottom'
                        type: 'danger',               // 'info', 'success', 'warning', 'danger'
                        icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                        message: paymentErrorMessage
                    });
                } else {


                    let paymentAdded = purchaseThis.addPaymentPrice(paymentType.value, paymentPrice.value, paymentDescription.value);

                    if(paymentAdded) {
                        paymentType.value = "";
                        paymentPrice.value = "";
                        paymentDescription.value = "";

                        purchaseThis.updatePaymentPriceGui(purchaseThis.purchasePaymentList[purchaseThis.purchasePaymentList.length - 1])

                        purchaseThis.updateTotalDueInGui();

                        Codebase.helpers('notify', {
                            align: 'left',             // 'right', 'left', 'center'
                            from: 'bottom',                // 'top', 'bottom'
                            type: 'success',               // 'info', 'success', 'warning', 'danger'
                            icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                            message: "payment added successful"
                        });
                    }

                }


            };
        })();

        // remove payment
        (function(){
            purchaseThis.purchasePaymentsDom.onclick = function(e) {
                e.preventDefault();
                if(e.target.classList.contains('remove-from-payment-item')) {
                    let paymentId = e.target.getAttribute('payment-id');
                    let removeElement = e.target.parentElement.parentElement;
                   ""

                    removeElement.classList.add('animated', 'slideOutRight');
                    setTimeout(function(){removeElement.remove();}, 1150);

                    purchaseThis.removePayment(paymentId);

                   ""

                    purchaseThis.updateTotalDueInGui();
                }
            }
        })();

    }

    getCheckedProducts() {
        let purchaseThis = this;
        let checkProductsNode = null;
        checkProductsNode = document.querySelectorAll('input[name="products"]:checked');
        let productsValue = [];

        if(checkProductsNode.length > 0) {
            for(let i = 0; i < checkProductsNode.length; i++) {
                productsValue.push(checkProductsNode[i].value);
            }
            purchaseThis.checkedProducts = productsValue;
            purchaseThis.addMultipleProductsToDom.style.display = 'inline-block';
        } else {
            purchaseThis.checkedProducts = productsValue;
            purchaseThis.addMultipleProductsToDom.style.display = 'none';
        }
    }

    addPaymentPrice(paymentType, paymentPrice, paymentDescription) {
        // validate payment before add
        let paymentMade = this.purchasePaymentList.length === 0 ? false : true;
        let paymentPriceFloat = Math.abs(parseFloat(paymentPrice));

        if( !paymentMade ) {
            if(this.validatePaymentPrice(paymentPriceFloat)) {
                this.purchasePaymentList.push({
                    payment_id: new Date().getTime(),
                    payment_type : paymentType,
                    payment_price: paymentPriceFloat,
                    payment_description: paymentDescription
                });
                return true;
            }

        } else {
            let previousPaymentPrice = 0;
            this.purchasePaymentList.forEach(function(singlePaymentPrice){
                previousPaymentPrice += singlePaymentPrice.payment_price;
            });


            let newTotalPaymentPrice = previousPaymentPrice + paymentPriceFloat;

           ""

            if(this.validatePaymentPrice(newTotalPaymentPrice)) {
                this.purchasePaymentList.push({
                    payment_id: new Date().getTime(),
                    payment_type : paymentType,
                    payment_price: paymentPriceFloat,
                    payment_description: paymentDescription
                });
                return true;
            }
        }

        return false;
    }

    updatePaymentPriceGui(paymentDetails) {
        let tr = document.createElement('tr');
        tr.classList.add('animated', 'slideInUp');
        tr.innerHTML = `<tr>
                            <td class="text-center">
                                <i class="fa fa-remove text-danger remove-from-payment-item"  payment-id="${paymentDetails.payment_id}"></i>
                            </td>

                            <td colspan="3" class="text-right">
                                <strong>Paid </strong>
                                <a href="#">
                                    <i class="si si-info"></i>
                                </a>
                            </td>
                            <td class="format-number-with-comma">${paymentDetails.payment_price}</td>
                        </tr>`;

        this.purchasePaymentsDom.appendChild(tr);
    }

    validatePaymentPrice(paymentPrice) {
        let paymentPriceError = {};

        if(this.totalPrice == 0) {
            paymentPriceError["purchaseTotalPrice"] = "Purchase Total Price Cannot be 0";
        } else {
            delete paymentPriceError["purchaseTotalPrice"];
        }
        if(paymentPrice === 0) {
            paymentPriceError["paymentZero"] = "Payment Price cannot be 0";
        } else {
            delete paymentPriceError["paymentZero"];
        }

        if(paymentPrice > this.totalPrice) {
            paymentPriceError["greaterPaymentPrice"] = "Payment price cannot greater than purchase price";
        } else {
            delete paymentPriceError["greaterPaymentPrice"]
        }

        let paymentPriceErrorFound = Object.getOwnPropertyNames(paymentPriceError);

        if(paymentPriceErrorFound.length > 0) {
            let paymentErrorMessage = "<ul>";
            Object.keys(paymentPriceError).forEach((key) => {
                paymentErrorMessage += "<li>" + paymentPriceError[key] + "</li>";
            });
            paymentErrorMessage += "</ul>";
           ""
            Codebase.helpers('notify', {
                align: 'left',             // 'right', 'left', 'center'
                from: 'bottom',                // 'top', 'bottom'
                type: 'danger',               // 'info', 'success', 'warning', 'danger'
                icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                message: paymentErrorMessage
            });
            return false;
        } else {
            return true;
        }

    }

    updateTheProductPurchaseListGui(productDetails) {

        let tr = document.createElement('tr');
        tr.classList.add('animated', 'slideInUp');
        tr.innerHTML = `
            <td class="text-center"><a href=""><i class="fa fa-remove text-danger remove-from-purchase-item"  product-id="${productDetails.id}"></i></a>
            </td>
            <td>${productDetails.name}</td>
            <td><input type="text" class="form-control p-1 border-radius-0 font-size-10 purchase_price" value="" product-id="${productDetails.id}"></td>
            <td><input type="text" class="form-control p-1 border-radius-0 font-size-10 purchase_quantity" value="" product-id="${productDetails.id}"></td>
            <td class="format-number-with-comma purchase_total_price_${productDetails.id}">0</td>
        `;

        this.purchaseItems.prepend(tr);
    }

    addToPurchaseProductList(productDetails) {
        let purchaseProductListLength = this.purchaseProductList.length;
        let found = this.purchaseProductList.filter(function(purchaseProductList){
            return purchaseProductList.id === productDetails.id
        });

        if(purchaseProductListLength === 0 || found.length === 0) {
            this.purchaseProductList.push(productDetails);
            return true;
        } else {
            return false;
        }
    }

    removePurchaseProductFromList(removeItemId) {
        let purchaseProductListLength = this.purchaseProductList.length;
        for(let i = 0; i < purchaseProductListLength; i++) {
            if( this.purchaseProductList[i].id === parseInt(removeItemId, 10) ) {
                this.purchaseProductList.splice(i,1);
                break;
            }
        }
        this.updateTotalPrice();
        this.updateTotalPriceGui();
        this.canLeaveThePage();
        this.togglePurchaseItemEmptyMessage();
    }

    removePayment(paymentId) {
        let purchasePaymentLength = this.purchasePaymentList.length;
        for(let i = 0; i < purchasePaymentLength; i++) {
            if( this.purchasePaymentList[i].payment_id === parseInt(paymentId, 10) ) {
                this.purchasePaymentList.splice(i,1);
                break;
            }
        }
    }

    addPurchasePriceToPurchaseItem(productId, purchasePrice) {
        let purchaseProductListLength = this.purchaseProductList.length;
        for(let i = 0; i < purchaseProductListLength; i++) {
            if( this.purchaseProductList[i].id === parseInt(productId, 10) ) {
                this.purchaseProductList[i].purchase_price = parseFloat(purchasePrice);
                break;
            }
        }
    }

    addPurchaseQuantityToPurchaseItem(productId, purchaseQuantity) {
        let purchaseProductListLength = this.purchaseProductList.length;
        for(let i = 0; i < purchaseProductListLength; i++) {
            if( this.purchaseProductList[i].id === parseInt(productId, 10) ) {
                this.purchaseProductList[i].purchase_quantity = parseFloat(purchaseQuantity);
                break;
            }
        }
    }

    updateTotalPriceOfPurchaseItem(productId) {
        let purchaseProductListLength = this.purchaseProductList.length;
        for(let i = 0; i < purchaseProductListLength; i++) {
            if( this.purchaseProductList[i].id === parseInt(productId, 10) ) {
                let totalPurchasePrice = parseFloat(this.purchaseProductList[i].purchase_price) * parseFloat(this.purchaseProductList[i].purchase_quantity);
                this.purchaseProductList[i].purchase_total_price = parseFloat(totalPurchasePrice.toFixed(2));
                break;
            }
        }
    }

    updateTotalPriceOfPurchaseItemGui(productId) {
        let purchaseProductListLength = this.purchaseProductList.length;
        for(let i = 0; i < purchaseProductListLength; i++) {
            if( this.purchaseProductList[i].id === parseInt(productId, 10) ) {
                document.querySelector('.purchase_total_price_' + productId).innerHTML = this.purchaseProductList[i].purchase_total_price;
                break;
            }
        }

    }

    updateTotalPrice() {
        let purchaseProductListLength = this.purchaseProductList.length;
        let totalPrice = 0;
        for(let i = 0; i < purchaseProductListLength; i++) {
            totalPrice += this.purchaseProductList[i].purchase_total_price;
        }
        this.totalPrice = totalPrice;
    }

    updateTotalPriceGui() {
        this.totalPriceDom.innerHTML = this.totalPrice;
    }

    canLeaveThePage() {
        if(this.purchaseProductList.length > 0) {
            window.onbeforeunload = function(e) {
                // If we haven't been passed the event get the window.event
               ""
                e = e || window.event;

                let message = 'Are you sure you want to leave the page';

                // For IE6-8 and Firefox prior to version 4
                if (e)
                {
                    e.returnValue = message;
                }

                // For Chrome, Safari, IE8+ and Opera 12+
                return message;
            };
        } else {
            window.onbeforeunload = null;
        }
    }

    togglePurchaseItemEmptyMessage() {
        let purchaseItemEmpty = document.querySelector('.purchase-item-empty');
        if(this.purchaseProductList.length > 0) {
            purchaseItemEmpty.style.display = 'none';
        } else {
            purchaseItemEmpty.style.display = 'table-row';
        }
    }

    get calculateTotalPayment() {
        let totalPayment = 0;
        if(this.purchasePaymentList.length == 0) {
            return totalPayment;
        } else {
            this.purchasePaymentList.forEach((singlePayment) => {
                totalPayment += singlePayment.payment_price;
            });
            return totalPayment;
        }
    }

    get calculateTotalDue() {
        let totalPrice = this.totalPrice;
        let totalPayment = this.calculateTotalPayment;

        if(this.totalPrice === 0) {
            return 0;
        }

        if( !isNaN(totalPrice) && !isNaN(totalPayment) ) {
            return  totalPrice - totalPayment;
        }
    }

    updateTotalDueInGui() {
        this.totalDueDom.innerHTML = this.calculateTotalDue;
    }

    validatePurchasePriceAndQuantity() {
        let errors = true;
        for (let i = 0; i < this.purchaseProductList.length; i++) {
            if(this.purchaseProductList[i].purchase_price === 0 ||
                this.purchaseProductList[i].purchase_quantity === 0 ||
                isNaN(this.purchaseProductList[i].purchase_price) ||
                isNaN(this.purchaseProductList[i].purchase_quantity)
            ) {
                errors = false;
                break;
            } else {
                errors = true;
            }
        }
        return errors;
    }

    validatePurchase() {
        let purchaseThis = this;

            let errors = {};
            // validate vendor
            if(purchaseThis.vendorId === null) {
                errors['vendorId'] = "In valid Vendor Id";
            } else {
                delete errors['vendorId'];
            }

            // validate warehouse
            if(purchaseThis.warehouseId === null) {
                errors['warehouseId'] = "In valid Warehouse Id";
            } else {
                delete errors['warehouseId'];
            }

            // validate purchase products (product items, product price, quantity)
            if(purchaseThis.purchaseProductList.length === 0) {
                errors['purchaseItemEmpty'] = "Please add some purchase items";
            } else {
                delete errors['purchaseItemEmpty'];
            }

            if(!purchaseThis.validatePurchasePriceAndQuantity()) {
                errors['purchasePriceQuantity'] = "Please check purchase price and quantity carefully";
            } else {
                delete errors['purchasePriceQuantity']
            }

            let errorFound = Object.getOwnPropertyNames(errors);

            if(errorFound.length > 0) {
                let errorMessage = "<ul>";
                Object.keys(errors).forEach((key) => {
                    errorMessage += "<li>" + errors[key] + "</li>";
                });
                errorMessage += "</ul>";
               ""
                Codebase.helpers('notify', {
                    align: 'left',             // 'right', 'left', 'center'
                    from: 'bottom',                // 'top', 'bottom'
                    type: 'danger',               // 'info', 'success', 'warning', 'danger'
                    icon: 'fa fa-exclamation-triangle mr-5',    // Icon class
                    message: errorMessage
                });
                return false;
            }

            return true;

    }

    processData() {
        let { purchaseProductList, purchasePaymentList, vendorId, warehouseId } = this;
        let data = {
            vendorId,
            purchaseProductList,
            purchasePaymentList,
            warehouseId
        }
        return JSON.stringify(data);
    }

}


let purchase = new Purchase();

purchase.endPurchaseDom.onclick = function() {

    let valid = purchase.validatePurchase();

    if(!valid) {
        return;
    }

    if(confirm("Please check every thing very carefully once you purchase you cannot re-edit this back")) {
        let data = purchase.processData();
        let purchaseForm = document.querySelector('#purchase-form');
        let url = purchaseForm.action;
        showAjaxProgress("please wait for a second...");
        axios({
            url: url,
            method: "POST",
            data: {
                data: data
            },
            onDownloadProgress: function(res) {

            },

        }).then(function (res) {

            if(res.data.success == 1) {
                window.onbeforeunload = null;
                window.location.href = purchaseRoute;
            }
            closeAjaxProgress();

        })
        .catch(function (error) {
            showError([
                error.message
            ]);
            closeAjaxProgress();
        });
    }
}

