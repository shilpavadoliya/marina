export const preparePurchaseProductArray = (products, isBarcode) => {
    let purchaseProductRowArray = [];
    products.forEach(product => {
        purchaseProductRowArray.push({
            name: product.attributes.name,
            code: product.attributes.code,
            barcode_url: product.attributes.barcode_url,
            stock: product.attributes.stock ? product.attributes.stock.quantity : "",
            // short_name: product.attributes.purchase_unit_name.short_name,
            product_unit: product.attributes.product_unit,
            product_id: product.id,
            product_cost: parseFloat(product.attributes.prices[0].price),
            net_unit_cost: parseFloat(product.attributes.prices[0].price),
            minimum_price: parseFloat(product.attributes.minimum_price),
            fix_net_unit: product.attributes.product_cost,
            tax_type: product.attributes.tax_type ? product.attributes.tax_type : 1,
            tax_value: product.attributes.order_tax ? product.attributes.order_tax : 0.00,
            tax_amount: 0.00,
            discount_type: '2',
            discount_value: 0.00,
            discount_amount: 0.00,
            purchase_unit: product.attributes.purchase_unit,
            quantity: product.attributes.product_unit_quantity,
            sub_total: 0.00,
            id: product.id,
            purchase_item_id: '',
            product_price: product.attributes.product_price
        })
    });
    console.log(products);
    console.log('prepare');
    return purchaseProductRowArray;
};
