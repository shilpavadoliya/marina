export const subTotalCount = (cartItem) => {
    const salePrice = parseFloat(cartItem.sale_price);
    const quantity = parseFloat(cartItem.quantity);
    if (isNaN(salePrice) || isNaN(quantity)) {
        return 0; // Return 0 if either sale price or quantity is not a number
    } else {
        return (salePrice * quantity).toFixed(2); // Calculate subtotal and round to 2 decimal places
    }
}
export const discountAmount = (cartItem) => {
    if (cartItem.discount_type === '1' || cartItem.discount_type === 1) {
        return ((+cartItem.fix_net_unit / 100) * +cartItem.discount_value);
    } else if (cartItem.discount_type === '2' || cartItem.discount_type === 2) {
        return +cartItem.discount_value;
    }
    return +cartItem.discount_amount.toFixed(2);
};

export const discountAmountMultiply = (cartItem) => {
    let discountMultiply = discountAmount(cartItem);
    return (+discountMultiply * cartItem.quantity).toFixed(2);
}

export const taxAmount = (cartItem) => {
    if (cartItem.tax_type === '2' || cartItem.tax_type === 2) {
        return ((+cartItem.fix_net_unit - discountAmount(cartItem)) * +cartItem.tax_value) / (100 + +cartItem.tax_value);
    } else if (cartItem.tax_type === '1' || cartItem.tax_type === 1) {
        return ((+cartItem.fix_net_unit - discountAmount(cartItem)) * +cartItem.tax_value) / 100;
    }

    return +cartItem.tax_amount.toFixed(2);
}

export const taxAmountMultiply = (cartItem) => {
    let taxMultiply = taxAmount(cartItem);
    return (+taxMultiply * cartItem.quantity).toFixed(2);
}

export const amountBeforeTax = (cartItem) => {
    let price = +cartItem.fix_net_unit;
    const unitCost = +price - discountAmount(cartItem);
    const inclusiveTax = +unitCost - taxAmount(cartItem);
    let finalCalPrice = cartItem.tax_type === '1' || cartItem.tax_type === 1 ? +unitCost : +inclusiveTax;
    return +finalCalPrice.toFixed(2);
}

//Grand Total Calculation
export const calculateCartTotalTaxAmount = (carts, inputValue) => {
    let taxValue = inputValue && inputValue.tax_rate;
    let totalTax = 0;
    let price = 0;

    carts.forEach(cartItem => {
        if (taxValue > 0) {
            price = price + +cartItem.sub_total
            totalTax = (((+price - inputValue.discount) / 100) * +taxValue) * +cartItem.quantity;
        }
    })

    return (parseFloat(totalTax)).toFixed(2);
}

export const calculateSubTotal = (carts) => {
    let subTotalAmount = 0;
    carts.forEach(cartItem => {
        subTotalAmount = subTotalAmount + Number(subTotalCount(cartItem))
    })
    return +subTotalAmount; 
}

export const calculateCartTotalAmount = (carts, inputValue) => {
    console.log(carts);
    let finalTotalAmount = 0; // 
    const value = inputValue || {};
    const subtotal = calculateSubTotal(carts);
    finalTotalAmount = subtotal;
    return finalTotalAmount.toFixed(2);
}
