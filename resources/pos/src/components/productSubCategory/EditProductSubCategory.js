import React from 'react';
import {connect} from 'react-redux';
import ProductSubCategoryForm from './ProductSubCategoryForm';
import {getFormattedMessage} from '../../shared/sharedMethod';

const EditProductSubCategory = (props) => {
    const {handleClose, show, productSubCategory} = props;

    return (
        <>
            {productSubCategory &&
            <ProductSubCategoryForm handleClose={handleClose} show={show} singleProductCategory={productSubCategory}
                                 title={getFormattedMessage('product-category.edit.title')}/>
            }
        </>
    )
};

export default connect(null)(EditProductSubCategory);

