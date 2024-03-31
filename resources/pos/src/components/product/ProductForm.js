import React, { useEffect, useState } from 'react';
import { connect } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import Form from 'react-bootstrap/Form';
import { InputGroup, Button } from 'react-bootstrap-v5';
import MultipleImage from './MultipleImage';
import { fetchUnits } from '../../store/action/unitsAction';
import { fetchAllProductCategories } from '../../store/action/productCategoryAction';
import { fetchAllSubProductCategories } from '../../store/action/productSubCategoryAction';
import { fetchAllBrands } from '../../store/action/brandsAction';
import { fetchAvailableLocations } from '../../store/action/availableLocationAction';
import { editProduct, fetchProduct } from '../../store/action/productAction';
import { productUnitDropdown } from '../../store/action/productUnitAction';
import { decimalValidate, getFormattedMessage, getFormattedOptions, placeholderText } from '../../shared/sharedMethod';
import taxes from '../../shared/option-lists/taxType.json';
import barcodes from '../../shared/option-lists/barcode.json';
import ModelFooter from '../../shared/components/modelFooter';
import ReactSelect from '../../shared/select/reactSelect';
import { saleStatusOptions, taxMethodOptions } from '../../constants';
import { fetchAllWarehouses } from "../../store/action/warehouseAction";
import { fetchAllSuppliers } from "../../store/action/supplierAction";
import moment from "moment";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPlus } from '@fortawesome/free-solid-svg-icons';
import UnitsForm from '../units/UnitsForm';
import { addUnit } from '../../store/action/unitsAction';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
import PriceOptions from '../prices/PriceOptions';
import { faTimes } from '@fortawesome/free-solid-svg-icons';
import ImagePicker from '../../shared/image-picker/ImagePicker';
import user from '../../assets/images/productCategory_logo.jpeg';


const ProductForm = (props) => {
    const {
        addProductData,
        warehouses,
        suppliers,
        id,
        editProduct,
        singleProduct,
        brands,
        availableLocations, 
        fetchAllBrands,
        fetchAllProductCategories,
        fetchAllSubProductCategories,
        productCategories,
        productSubCategories,
        fetchUnits,
        fetchAvailableLocations,
        productUnits,
        productUnitDropdown,
        frontSetting,
        fetchAllWarehouses,
        fetchAllSuppliers,
        addUnit,
        baseUnits,
        productUnit
    } = props;

    const navigate = useNavigate();
    const [productValue, setProductValue] = useState({
        date: new Date(),
        name: '',
        code: '',
        product_category_id: '',
        sub_category_id: '',
        brand_id: '',
        barcode_symbol: '',
        minimum_price: '',
        product_price: '',
        product_unit: '',
        sale_unit: '',
        purchase_unit: '',
        stock_alert: 0,
        order_tax: 0,
        tax_type: '',
        sale_quantity_limit: "",
        notes: '',
        images: [],
        warehouse_id: '',
        supplier_id: '',
        add_stock: '',
        status_id: { label: getFormattedMessage("status.filter.received.label"), value: 1 },
        isEdit: false,
        product_description: '',
        image: '',
        product_unit_quantity: '',
    });

    const [removedImage, setRemovedImage] = useState([])
    const [isClearDropdown, setIsClearDropdown] = useState(true);
    const [isDropdown, setIsDropdown] = useState(true);
    const [multipleFiles, setMultipleFiles] = useState([]);


    const [selectImg, setSelectImg] = useState(null);

// Determine the image to be used for preview

const previewImg = productValue && productValue.image ? productValue.image : user;

// Initialize imagePreviewUrl state with the selected image
const [imagePreviewUrl, setImagePreviewUrl] = useState(previewImg);



    const [errors, setErrors] = useState({
        name: '',
        code: '',
        product_category_id: '',
        sub_category_id: '',
        brand_id: '',
        barcode_symbol: '',
        minimum_price: '',
        product_price: '',
        product_unit: '',
        sale_unit: '',
        purchase_unit: '',
        stock_alert: '',
        order_tax: '',
        tax_type: '',
        notes: '',
        images: [],
        warehouse_id: '',
        supplier_id: '',
        add_stock: '',
        status_id: '',
        product_description: '',
        product_unit_quantity:'',
    });



    useEffect(() => {
        // fetchAllBrands();
        fetchAllProductCategories();
        fetchAllSubProductCategories();
        fetchUnits();
        // fetchAllWarehouses();
        // fetchAllSuppliers();
        fetchAvailableLocations();
    }, []);

    useEffect(() => {
        if (singleProduct && productUnit) {
            productUnitDropdown(productUnit[0]?.id)
        }
    }, []);

    const [formFields, setFormFields] = useState([
        {
            dropdownValue: '',
            inputValue: ''
        }
    ]);

    const [priceFields, setPriceFields] = useState([
        {
          location: '',
          price: '',
        },
      ]);


      const handleAddFormField = () => {
        
        setPriceFields([...priceFields, { location: '', price: '' }]);
      };
      
      const handleRemoveFormField = (index) => {
        const updatedPriceFields = [...priceFields];
        updatedPriceFields.splice(index, 1);
        setPriceFields(updatedPriceFields);
      };
      
      const handleFormFieldDropdownChange = (index, value, field) => {
        const updatedPriceFields = [...priceFields];
        updatedPriceFields[index][field] = value;
        setPriceFields(updatedPriceFields);
      };
      
      const handleFormFieldInputChange = (index, value, field) => {
        const updatedPriceFields = [...priceFields];
        updatedPriceFields[index][field] = value;
        setPriceFields(updatedPriceFields);
      };

      
    const disabled = multipleFiles.length !== 0 ? false : singleProduct && productValue.product_unit[0] && productValue.product_unit[0].value === singleProduct[0].product_unit && productValue.barcode_symbol[0] && productValue.barcode_symbol[0].value === singleProduct[0].barcode_symbol.toString() && singleProduct[0].name === productValue.name && singleProduct[0].notes === productValue.notes && singleProduct[0].product_price === productValue.product_price && singleProduct[0]?.stock_alert?.toString() === productValue.stock_alert && singleProduct[0].minimum_price === productValue.minimum_price && singleProduct[0].code === productValue.code && JSON.stringify(singleProduct[0].order_tax) === productValue.order_tax && singleProduct[0].quantity_limit === productValue.sale_quantity_limit && singleProduct[0].brand_id.value === productValue.brand_id.value && newTax.length === productValue.tax_type.length && singleProduct[0].product_category_id.value === productValue.product_category_id.value && JSON.stringify(singleProduct[0].images.imageUrls) === JSON.stringify(removedImage)


    const [selectedProductCategory] = useState(singleProduct && singleProduct[0] ? ([{
        label: singleProduct[0].product_category_id.label, value: singleProduct[0].product_category_id.value
    }]) : null);

    const [selectedSubProductCategory] = useState(singleProduct && singleProduct[0] ? ([{
        label: singleProduct[0].sub_category_id.label, value: singleProduct[0].sub_category_id.value
    }]) : null);

    const saleUnitOption = productUnits && productUnits.length && productUnits.map((productUnit) => {
        return { value: productUnit?.id, label: productUnit.attributes.name }
    });

    const [selectedB2BorB2C, setSelectedB2BorB2C] = useState(
        singleProduct && singleProduct[0]
            ? [
                {
                    label: singleProduct[0].product_type.label,
                    value: singleProduct[0].product_type.value,
                },
            ]
            : null
    );

    useEffect(() => {
        if (singleProduct) {
            setProductValue({
                name: singleProduct ? singleProduct[0].name : '',
                code: singleProduct ? singleProduct[0].code : '',
                product_category_id: singleProduct ? singleProduct[0].product_category_id : '',
                sub_category_id: singleProduct ? singleProduct[0].sub_category_id : '',
                minimum_price: singleProduct ? singleProduct[0].minimum_price : '',
                product_price: singleProduct ? singleProduct[0].product_price : '',
                product_unit: singleProduct ? { value: productUnit[0]?.id, label: productUnit[0].attributes.name } : '',
                images: singleProduct ? singleProduct[0].images : '',
                isEdit: singleProduct ? singleProduct[0].is_Edit : false,
                product_description: singleProduct ? singleProduct[0].product_description : '',
                product_type: singleProduct ? singleProduct[0].product_type : '',
                image: singleProduct ? singleProduct[0].image.replace(/\\/g, '/') : '',
                product_unit_quantity: singleProduct ? singleProduct[0].product_unit_quantity : '',
            })

            if (singleProduct && singleProduct[0] && singleProduct[0].prices) {
                const existingPrices = singleProduct[0].prices.map(price => ({
                    location: { label: price.label, value: price.value },
                    price: price.price,
                }));
                setPriceFields(existingPrices);
            }
            setImagePreviewUrl(singleProduct[0].image);
        }
    }, []);

    const onChangeFiles = (file) => {
        setMultipleFiles(file);
    };

    const transferImage = (item) => {
        setRemovedImage(item);
        setMultipleFiles([])
    };

    const handleProductUnitChange = (obj) => {
        productUnitDropdown(obj.value);
        setIsClearDropdown(false);
        setIsDropdown(false);
        setProductValue({ ...productValue, product_unit: obj });
        setErrors('');
    };

    const handleSaleUnitChange = (obj) => {
        setIsClearDropdown(true);
        setProductValue({ ...productValue, sale_unit: obj });
        setErrors('');
    };

    const handlePurchaseUnitChange = (obj) => {
        setIsDropdown(true);
        setProductValue({ ...productValue, purchase_unit: obj });
        setErrors('');
    };

    const onBrandChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, brand_id: obj }));
        setErrors('');
    };

    const onBarcodeChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, barcode_symbol: obj }));
        setErrors('');
    };

    const onProductCategoryChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, product_category_id: obj }));
        setErrors('');
    };

    const handleDescriptionChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, product_description: obj }));
        setErrors('');
    };



    const onProductSubCategoryChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, sub_category_id: obj }));
        setErrors('');
    };
    // tax type dropdown functionality
    const taxTypeFilterOptions = getFormattedOptions(taxMethodOptions)

    const defaultTaxType = singleProduct ? singleProduct[0].tax_type === '1' ? {
        value: 1, label: getFormattedMessage("tax-type.filter.exclusive.label")
    } : {
        value: 2, label: getFormattedMessage("tax-type.filter.inclusive.label")
    } || singleProduct[0].tax_type === '2' ? {
        value: 2, label: getFormattedMessage("tax-type.filter.inclusive.label")
    } : {
        value: 1, label: getFormattedMessage("tax-type.filter.exclusive.label")
    } : {
        value: 1, label: getFormattedMessage("tax-type.filter.exclusive.label")
    }

    const onTaxTypeChange = (obj) => {
        setProductValue(productValue => ({ ...productValue, tax_type: obj }));
        setErrors('');
    };

    const onWarehouseChange = (obj) => {
        setProductValue(inputs => ({ ...inputs, warehouse_id: obj }))
        setErrors('')
    };

    const onSupplierChange = (obj) => {
        setProductValue(inputs => ({ ...inputs, supplier_id: obj }))
        setErrors('');
    };

    const onStatusChange = (obj) => {
        setProductValue(inputs => ({ ...inputs, status_id: obj }))
    };

    const onB2BorB2CChange = (obj) => {
        setProductValue(inputs => ({ ...productValue, product_type: obj }))
        setErrors('');
    };

    const statusFilterOptions = getFormattedOptions(saleStatusOptions)
    const statusDefaultValue = statusFilterOptions.map((option) => {
        return {
            value: option.id,
            label: option.name
        }
    })

    const handleValidation = () => {
        // let errorss = {};
        let isValid = true;
        /* if ( !productValue[ 'name' ] ) {
            errorss[ 'name' ] = getFormattedMessage( 'globally.input.name.validate.label' );
        } else if ( !productValue[ 'code' ] ) {
            errorss[ 'code' ] = getFormattedMessage( 'product.input.code.validate.label' );
        } else if ( !productValue[ 'product_category_id' ] ) {
            errorss[ 'product_category_id' ] = getFormattedMessage( 'product.input.product-category.validate.label' );
        } else if ( !productValue[ 'product_price' ] ) {
            errorss[ 'product_price' ] = getFormattedMessage( 'product.input.product-price.validate.label' );
        } else if ( !productValue[ 'product_unit' ] ) {
            errorss[ 'product_unit' ] = getFormattedMessage( 'product.input.product-unit.validate.label' );
        }else if ( productValue[ 'isEdit' ] === false ) {
           
                isValid = true;
            
        } else {
            isValid = true;
        }
        setErrors( errorss ); */
        return isValid;
    };

    const onChangeInput = (e) => {
        e.preventDefault();
        const { value } = e.target;
        // check if value includes a decimal point
        if (value.match(/\./g)) {
            const [, decimal] = value.split('.');
            // restrict value to only 2 decimal places
            if (decimal?.length > 2) {
                // do nothing
                return;
            }
        }
        setProductValue(inputs => ({ ...inputs, [e.target.name]: value }))
        setErrors('');
    };

    const [unitModel, setUnitModel] = useState(false);
    const showUnitModel = (val) => {
        setUnitModel(val)
    }

    const addUnitsData = (productValue) => {
        addUnit(productValue);
    };

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
    const prepareFormData = (data) => {
        const formData = new FormData();
        formData.append('name', data.name);
        formData.append('product_description', data.product_description);
        formData.append('code', data.code);
        formData.append('product_category_id', data.product_category_id.value);
        formData.append('sub_category_id', data.sub_category_id.value);
        formData.append('product_type', data.product_type.value ? data.product_type.value : '');
       
        
        formData.append('minimum_price', data.minimum_price);
        formData.append('product_price', data.product_price);
        formData.append('product_unit', data.product_unit && data.product_unit[0] ? data.product_unit[0].value : data.product_unit.value);
        formData.append('product_unit_quantity', data.product_unit_quantity);

        if (multipleFiles) {
            multipleFiles.forEach((image, index) => {
                formData.append(`images[${index}]`, image);
            })
        }
     

        if (selectImg) {
            formData.append('image', data.image);
        }
        priceFields.forEach((price, index) => {
            formData.append(`prices[${index}][location]`, price.location.value);
            formData.append(`prices[${index}][price]`, price.price);
          });
        return formData;
    };

    const onSubmit = (event) => {
        event.preventDefault();
        const valid = handleValidation();
        productValue.images = multipleFiles;
        productValue.image = selectImg;
        if (singleProduct && valid && isClearDropdown === true && isDropdown === true) {
            if (!disabled) {
                editProduct(id, prepareFormData(productValue), navigate);
            }
        } else {
            if (valid) {

                productValue.images = multipleFiles;
                
                setProductValue(productValue);
                addProductData(prepareFormData(productValue));
            }
        }
        // setSelectImg(null);
    };

    return (
        <div className='card'>
            <div className='card-body'>
                <Form>
                    <div className='row'>
                        <div className='col-xl-12'>
                            <div className='card'>
                                <div className='row'>
                                    <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('globally.input.name.label')}: </label>
                                        <span className='required' />
                                        <input type='text' name='name' value={productValue.name}
                                            placeholder={placeholderText('globally.input.name.placeholder.label')}
                                            className='form-control' autoFocus={true}
                                            onChange={(e) => onChangeInput(e)} />
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['name'] ? errors['name'] : null}</span>
                                    </div>

                                    <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('product.input.description.label')}: </label>
                                        <span className='required' />
                                        <ReactQuill value={productValue.product_description} onChange={handleDescriptionChange} />
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['product_description'] ? errors['product_description'] : null}</span>
                                    </div>
                                    <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('product.input.code.label')}: </label>
                                        <span className='required' />
                                        <input type='text' name='code' className=' form-control'
                                            placeholder={placeholderText('product.input.code.placeholder.label')}
                                            onChange={(e) => onChangeInput(e)}
                                            value={productValue.code} />
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['code'] ? errors['code'] : null}</span>
                                    </div>
                                    <div className='col-md-6 mb-3'>
                                        <ReactSelect title={getFormattedMessage('product.input.product-category.label')}
                                            placeholder={placeholderText('product.input.product-category.placeholder.label')}
                                            defaultValue={selectedProductCategory}
                                            value={productValue.product_category_id}
                                            data={productCategories} onChange={onProductCategoryChange}
                                            errors={errors['product_category_id']} />
                                    </div>
                                    <div className='col-md-6 mb-3'>
                                        <ReactSelect title={getFormattedMessage('product.input.product-sub-category.label')}
                                            placeholder={placeholderText('product.input.product-sub-category.placeholder.label')}
                                            defaultValue={selectedProductCategory}
                                            value={productValue.sub_category_id}
                                            data={productSubCategories} onChange={onProductSubCategoryChange}
                                            errors={errors['sub_category_id']} />
                                    </div>


                                    <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('product.input.product-cost.label')}: </label>
                                        <span className='required' />
                                        <InputGroup>
                                            <input type='text' name='minimum_price'
                                                min={0} className='form-control'
                                                placeholder={placeholderText('product.input.product-cost.placeholder.label')}
                                                onKeyPress={(event) => decimalValidate(event)}
                                                onChange={(e) => onChangeInput(e)}
                                                value={productValue.minimum_price} />
                                            <InputGroup.Text>{frontSetting.value && frontSetting.value.currency_symbol}</InputGroup.Text>
                                        </InputGroup>
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['minimum_price'] ? errors['minimum_price'] : null}</span>
                                    </div>
                                    <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('product.input.product-price.label')}: </label>
                                        <span className='required' />
                                        <InputGroup>
                                            <input type='text' name='product_price' min={0}
                                                className='form-control'
                                                placeholder={placeholderText('product.input.product-price.placeholder.label')}
                                                onKeyPress={(event) => decimalValidate(event)}
                                                onChange={(e) => onChangeInput(e)}
                                                value={productValue.product_price} />
                                            <InputGroup.Text>{frontSetting.value && frontSetting.value.currency_symbol}</InputGroup.Text>
                                        </InputGroup>
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['product_price'] ? errors['product_price'] : null}</span>
                                    </div>
                                    <div className='col-md-6 mb-3'>
                                        <InputGroup className='flex-nowrap dropdown-side-btn'>
                                            <ReactSelect
                                                className='position-relative'
                                                title={getFormattedMessage("product.input.product-unit.label")}
                                                placeholder={placeholderText('product.input.product-unit.placeholder.label')}
                                                defaultValue={productValue.product_unit}
                                                value={productValue.product_unit}
                                                data={baseUnits}
                                                errors={errors['product_unit']}
                                                onChange={handleProductUnitChange} />
                                            <Button onClick={() => showUnitModel(true)} className='position-absolute model-dtn'><FontAwesomeIcon
                                                icon={faPlus} /></Button></InputGroup>
                                    </div>

                                     <div className='col-md-6 mb-3'>
                                        <label
                                            className='form-label'>{getFormattedMessage('product.input.product-unit-quantity.label')}: </label>
                                        <span className='required' />
                                        
                                            <input type='text' name='product_unit_quantity' min={0}
                                                className='form-control'
                                                placeholder={placeholderText('product.input.product-unit-quantity.label')}
                                                onKeyPress={(event) => decimalValidate(event)}
                                                onChange={(e) => onChangeInput(e)}
                                                value={productValue.product_unit_quantity} />
                                            
                                        
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'>{errors['product_unit_quantity'] ? errors['product_unit_quantity'] : null}</span>
                                    </div>
                                    

                                    <div className="col-md-6 mb-3">
                                        <ReactSelect
                                            title={getFormattedMessage('product.input.b2b-or-b2c.label')}
                                            placeholder={placeholderText('product.input.b2b-or-b2c.placeholder.label')}
                                            defaultValue={productValue.product_type}
                                            value={productValue.product_type}
                                            data={[
                                                { label: 'B2B', value: 1 },
                                                { label: 'B2C', value: 2 },
                                            ]}
                                            onChange={onB2BorB2CChange}
                                            errors={errors['b2b_or_b2c']}
                                        />
                                    </div>
                                    <div className='col-lg-6 mb-3'>
                                         <ImagePicker imagePreviewUrl={imagePreviewUrl} handleImageChange={handleImageChanges}
                                     user={user} imageTitle={placeholderText('product.table.image.column.label')}/>
                                    </div>

                                    <div className='col-md-6 mb-3'>
                                        <label className='form-label'>
                                            {getFormattedMessage('product.input.multiple-image.label')}: </label>
                                        <MultipleImage product={singleProduct} fetchFiles={onChangeFiles}
                                            transferImage={transferImage} />
                                    </div>
                                    
                                    <div className='col-md-12 mb-3'>
  <h2>Add Price</h2>
  {priceFields.map((field, index) => (
    <div key={index} className="dynamic-form-fields">
      <div className="d-flex align-items-center">
        <div > {/* Adjust margin as needed */}
          <ReactSelect
            title={placeholderText('available_location.modal.input.available_location.label')}
            placeholder={placeholderText('available_location.modal.input.available_location.placeholder.label')}
            defaultValue={field.location}
            value={field.location}
            data={availableLocations}
            onChange={(obj) => handleFormFieldDropdownChange(index, obj, 'location')}
          />
        </div>
        <div style={{ marginTop: '10px', marginLeft: '10px', marginBottom: '5px' }}>
          <label className='form-label'>{getFormattedMessage('product.input.product-price.label')}: </label>
          <span className='required' />
          <InputGroup>
            <input
              type='text'
              name='price'
              min={0}
              className='form-control'
              placeholder={placeholderText('product.input.product-price.placeholder.label')}
              onKeyPress={(event) => decimalValidate(event)}
              onChange={(e) => handleFormFieldInputChange(index, e.target.value, 'price')}
              value={field.price}
            />
            <InputGroup.Text>
              <FontAwesomeIcon icon={faTimes} onClick={() => handleRemoveFormField(index)} />
            </InputGroup.Text>
          </InputGroup>
          <span className='text-danger d-block fw-400 fs-small mt-2'>
            {errors['price'] ? errors['price'] : null}
          </span>
        </div>
      </div>
    </div>
  ))}
  <Button onClick={() => handleAddFormField()} className=''>
    <FontAwesomeIcon icon={faPlus} /> Add More Price
  </Button>
  <span className='text-danger d-block fw-400 fs-small mt-2'>
    {errors['price'] ? errors['price'] : null}
  </span>
</div>



                                    <ModelFooter onEditRecord={singleProduct} onSubmit={onSubmit}
                                        editDisabled={disabled}
                                        link='/app/products' addDisabled={!productValue.name} />                               </div>
                            </div>
                        </div>

                    </div>
                </Form>
            </div>
            {unitModel && <UnitsForm addProductData={addUnitsData} product_unit={productValue.product_unit}
                title={getFormattedMessage('unit.create.title')} show={unitModel}
                hide={setUnitModel} />}
        </div>
    )
}
    ;

const mapStateToProps = (state) => {
    const { brands, productCategories, productSubCategories, units, totalRecord, suppliers, warehouses, productUnits, frontSetting, availableLocations} = state;
    return { brands, productCategories, productSubCategories, units, totalRecord, suppliers, warehouses, productUnits, frontSetting,availableLocations};
};

export default connect(mapStateToProps, {
    fetchProduct,
    editProduct,
    fetchAllBrands,
    fetchAllProductCategories,
    fetchAllSubProductCategories,
    fetchUnits,
    productUnitDropdown,
    fetchAllWarehouses,
    fetchAllSuppliers,
    addUnit,
    fetchAvailableLocations
})(ProductForm);
