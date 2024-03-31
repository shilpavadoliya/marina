// DynamicFormFields.js
import React from 'react';
import { InputGroup } from 'react-bootstrap-v5';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTimes } from '@fortawesome/free-solid-svg-icons';
import ReactSelect from '../../shared/select/reactSelect';
import { decimalValidate, getFormattedMessage, getFormattedOptions, placeholderText } from '../../shared/sharedMethod';

const PriceOptions = ({
  formData,
  index,
  handleDropdownChange,
  handleInputChange,
  handleRemoveForm,
  productUnits,
  baseUnits,
}) => {
  return (
    <div key={index} className="dynamic-form-fields">
      <ReactSelect
        title={placeholderText('product.input.product-unit.label')}
        placeholder={placeholderText('product.input.product-unit.placeholder.label')}
        defaultValue={formData.product_unit}
        value={formData.product_unit}
        data={baseUnits}
        onChange={(obj) => handleDropdownChange(index, obj, 'product_unit')}
      />

<label
                                            className='form-label'>{getFormattedMessage('product.input.product-price.label')}: </label>
                                        <span className='required' />
                                        <InputGroup>
                                            <input type='text' name='product_price' min={0}
                                                className='form-control'
                                                placeholder={placeholderText('product.input.product-price.placeholder.label')}
                                                onKeyPress={(event) => decimalValidate(event)}
                                                onChange={(e) => onChangeInput(e)}
                                                // value={productValue.product_price}
                                                 />
                                            <InputGroup.Text><FontAwesomeIcon icon={faTimes} onClick={() => handleRemoveForm(index)} /></InputGroup.Text>
                                        </InputGroup>
                                        <span
                                            className='text-danger d-block fw-400 fs-small mt-2'></span>
    </div>
  );
};


export default PriceOptions;