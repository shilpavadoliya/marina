import React, {createRef, useEffect, useState} from 'react';
import {connect} from 'react-redux';
import {Form, Modal} from 'react-bootstrap-v5';
import {
    editProductSubCategory, fetchProductSubCategory, fetchProductSubCategories
} from '../../store/action/productSubCategoryAction';
import ImagePicker from '../../shared/image-picker/ImagePicker';
import user from '../../assets/images/productCategory_logo.jpeg';
import {getFormattedMessage, placeholderText} from '../../shared/sharedMethod';
import ModelFooter from '../../shared/components/modelFooter';
import ReactSelect from '../../shared/select/reactSelect';
import { fetchAllProductCategories } from '../../store/action/productCategoryAction';


const ProductSubCategoryForm = (props) => {
    const {handleClose, show, title, addProductData, editProductSubCategory, singleProductCategory,fetchAllProductCategories,productCategories} = props;
    
    // console.log(singleProductCategory.category_id);
    const innerRef = createRef();
    const [productCategoryValue, setProductCategoryValue] = useState({
        name: singleProductCategory ? singleProductCategory.name : '',
        image: singleProductCategory ? singleProductCategory.image : '',
        category_id: singleProductCategory ? singleProductCategory.category_id : '',
    });
    console.log(productCategoryValue.category_id);
    const [errors, setErrors] = useState({
        name: '',
    });
    const editImg = singleProductCategory ? singleProductCategory.image : user;
    const newImg = productCategoryValue.image === false ? user : editImg;
    const [imagePreviewUrl, setImagePreviewUrl] = useState(newImg);
    const [selectImg, setSelectImg] = useState(null);

    const disabled = selectImg ? false : singleProductCategory && singleProductCategory.name === productCategoryValue.name.trim();

    const [ selectedProductCategory ] = useState( singleProductCategory && singleProductCategory[ 0 ] ? ( [ {
        label: singleProductCategory[ 0 ].category_id.label, value: singleProductCategory[ 0 ].category_id.value
    } ] ) : productCategoryValue.category_id );
    const handleImageChanges = (e) => {
        e.preventDefault();
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (file.type === 'image/jpeg' || file.type === 'image/png') {
                setSelectImg(file);
                const fileReader = new FileReader();
                fileReader.onloadend = () => {
                    setImagePreviewUrl(fileReader.result);
                };
                fileReader.readAsDataURL(file);
                setErrors('');
            }
        }
    };

    const handleValidation = () => {
        let errorss = {};
        let isValid = false;
        if (!productCategoryValue['name'].trim()) {
            errorss['name'] = getFormattedMessage('globally.input.name.validate.label');
        } else if ((productCategoryValue['name'] && productCategoryValue['name'].length > 50)) {
            errorss['name'] = getFormattedMessage('brand.input.name.valid.validate.label');
        } else {
            isValid = true;
        }
        setErrors(errorss);
        return isValid;
    };

    const onChangeInput = (e) => {
        e.preventDefault();
        setProductCategoryValue(inputs => ({...inputs, [e.target.name]: e.target.value}))
        setErrors('');
    };

    const prepareFormData = (data) => {
        const formData = new FormData();
        formData.append('name', data.name);
        // formData.append('category_id', data.category_id);
        formData.append( 'category_id', data.category_id.value );
        if (selectImg) {
            formData.append('image', data.image);
        }
        return formData;
    };

    const onSubmit = (event) => {
        event.preventDefault();
        const valid = handleValidation();
        productCategoryValue.image = selectImg;
        if (singleProductCategory && valid) {
            if (!disabled) {
                productCategoryValue.image = selectImg;
                editProductSubCategory(singleProductCategory.id, prepareFormData(productCategoryValue), handleClose);
                clearField(false);
            }
        } else {
            if (valid) {
                setProductCategoryValue(productCategoryValue);
                addProductData(prepareFormData(productCategoryValue));
                clearField(false);
            }
        }
        setSelectImg(null);
    };

    const clearField = () => {
        setProductCategoryValue({
            name: '',
            image: ''
        });
        setImagePreviewUrl(user);
        setErrors('');
        handleClose(false);
    };

    const onProductCategoryChange = ( obj ) => {
        setProductCategoryValue( productCategoryValue => ( { ...productCategoryValue, category_id: obj } ) );
        setErrors( '' );
    };

        useEffect( () => {
        fetchAllProductCategories();
    }, [] );

    return (
        <Modal show={show}
               onHide={clearField}
               keyboard={true}
               onShow={() => setTimeout(() => {
                   innerRef.current.focus();
               }, 1)}
        >
            <Form onKeyPress={(e) => {
                if (e.key === 'Enter') {
                    singleProductCategory ? onEdit(e) : onSubmit(e)
                }
            }}>
                <Modal.Header closeButton>
                    <Modal.Title>{title}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div className='row'>
                        <div className='col-md-12 mb-5'>
                                <label
                                    className='form-label'>{getFormattedMessage('globally.input.name.label')}: </label>
                                <span className='required'/>
                                <input type='text' name='name'
                                              placeholder={placeholderText('globally.input.name.placeholder.label')}
                                              className='form-control' ref={innerRef} autoComplete='off'
                                              onChange={(e) => onChangeInput(e)}
                                              value={productCategoryValue.name}/>
                                <span className='text-danger d-block fw-400 fs-small mt-2'>{errors['name'] ? errors['name'] : null}</span>
                        </div>
                       <div className='col-md-12 mb-3'>
                       {productCategoryValue.category_id}
                                        <ReactSelect title={getFormattedMessage( 'product.input.product-category.label' )}
                                            placeholder={placeholderText( 'product.input.product-category.placeholder.label' )}
                                            defaultValue={productCategoryValue.category_id}
                                            value={productCategoryValue.category_id}
                                            data={productCategories} 
                                            onChange={onProductCategoryChange}
                                            errors={errors[ 'category_id' ]} />
                                    </div>
                        <ImagePicker imagePreviewUrl={imagePreviewUrl} handleImageChange={handleImageChanges}
                                     user={user} imageTitle={placeholderText('globally.input.change-logo.tooltip')}/>
                    </div>
                </Modal.Body>
            </Form>
            <ModelFooter onEditRecord={singleProductCategory} onSubmit={onSubmit} editDisabled={disabled}
                         clearField={clearField} addDisabled={!productCategoryValue.name.trim()}/>
        </Modal>
    )
};



const mapStateToProps = ( state ) => {
    const { productCategories } = state;
    return { productCategories };
};

export default connect( mapStateToProps, {fetchProductSubCategory, editProductSubCategory, fetchProductSubCategories,fetchAllProductCategories} )( ProductSubCategoryForm );