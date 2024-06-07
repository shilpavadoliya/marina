export const preparePurchaseProductArray = (products, isBarcode) => {
    let purchaseProductRowArray = [];
    products.forEach(product => {
        const { 
            attributes: { 
                name, 
                code, 
                barcode_url, 
                stock, 
                product_unit, 
                prices, 
                minimum_price, 
                product_cost, 
                tax_type, 
                order_tax, 
                purchase_unit, 
                product_unit_quantity,
                product_price
            }, 
            id 
        } = product;

        const price = prices && prices.length > 0 ? parseFloat(prices[0].price) : parseFloat(product_price);
        
        purchaseProductRowArray.push({
            name,
            code,
            barcode_url,
            stock: stock ? stock.quantity : "",
            product_unit,
            product_id: id,
            product_cost: price ? price : 0,
            net_unit_cost: price ? price : 0,
            minimum_price: (minimum_price) ? parseFloat(minimum_price) : 0,
            fix_net_unit: product_cost,
            tax_type: tax_type || 1,
            tax_value: order_tax || 0.00,
            tax_amount: 0.00,
            discount_type: '2',
            discount_value: 0.00,
            discount_amount: 0.00,
            purchase_unit,
            quantity: 1,
            sub_total: 0.00,
            id,
            purchase_item_id: '',
            product_price
        });
    });

    return purchaseProductRowArray;
};
