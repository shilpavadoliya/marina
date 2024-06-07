import React, {useState, createRef, useEffect} from 'react';
import {connect} from 'react-redux';
import {Form, Modal} from 'react-bootstrap-v5';
import {getFormattedMessage, placeholderText} from "../../shared/sharedMethod";
import {editAvailableLocation} from '../../store/action/availableLocationAction';
import ModelFooter from '../../shared/components/modelFooter';

const AvailabelLocationForm = (props) => {
    const {handleClose, base, show, title, addProductData, editAvailableLocation, singleUnit,hide, product_unit} = props;
    const innerRef = createRef();
    const newUnit = singleUnit && base.filter((da) => singleUnit.base_unit === da.attributes.name);

    const [unitValue, setUnitValue] = useState({
        name: singleUnit ? singleUnit.name : '',
    });
    const [errors, setErrors] = useState({
        name: ''
    });

    

    useEffect(() => {
        if(newUnit && newUnit?.length >= 1){
            setUnitValue(unitValue => ({...unitValue, base_unit: {
                value: newUnit[0].id,
                label: newUnit[0].attributes.name
            }}));
        }
    },[])

    useEffect(() => {
        if(singleUnit){
          const data =  base.filter((da) => Number(singleUnit.base_unit) === da.id);
            data.length && setUnitValue({
                name: singleUnit ? singleUnit.name : '',
            })
        }
    },[singleUnit])

    const disabled = singleUnit && singleUnit.name === unitValue.name.trim()
    const [selectedBaseUnit] = useState( newUnit ? ([{label: newUnit[0]?.attributes?.name, value: newUnit[0]?.id}]) : null);

    const handleValidation = () => {
        let errorss = {};
        let isValid = false;
        if (!unitValue['name'].trim()) {
            errorss['name'] = getFormattedMessage("globally.input.name.validate.label");
        } else {
            isValid = true;
        }
        setErrors(errorss);
        return isValid;
    };

    const onChangeInput = (e) => {
        e.preventDefault();
        setUnitValue(inputs => ({...inputs, [e.target.name]: e.target.value}))
        setErrors('');
    };

    const onBaseUnitChange = (obj) => {
        setUnitValue(unitValue => ({...unitValue, base_unit: obj}));
    };

    const prepareFormData = (data) => {
        const params = new URLSearchParams();
        params.append('name', data.name);
        
        return params;
    };

    const onSubmit = (event) => {
        event.preventDefault();
        const valid = handleValidation();
        if (singleUnit && valid) {
            if (!disabled) {
                editAvailableLocation(singleUnit.id, prepareFormData(unitValue), handleClose);
                clearField(false);
            }
        } else {
            if (valid) {
                setUnitValue(unitValue);
                addProductData(prepareFormData(unitValue));
                clearField(false);
            }
        }
    };

    const clearField = () => {
        setUnitValue({
            name: '',
        });
        setErrors('');
        // handleClose(false);
        handleClose ? handleClose(false) : hide(false)
    };

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
                    onSubmit(e)
                }
            }}>
                <Modal.Header closeButton>
                    <Modal.Title>{title}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div className='row'>
                        <div className='col-md-12 mb-3'>
                            <label
                                className='form-label'>{getFormattedMessage("globally.input.name.label")}: </label>
                            <span className='required'/>
                            <input type='text' name='name' value={unitValue.name}
                                   placeholder={placeholderText("globally.input.name.placeholder.label")}
                                   className='form-control' ref={innerRef} autoComplete='off'
                                   onChange={(e) => onChangeInput(e)}/>
                            <span
                                className='text-danger d-block fw-400 fs-small mt-2'>{errors['name'] ? errors['name'] : null}</span>
                        </div>
                        
                    </div>
                </Modal.Body>
            </Form>
            <ModelFooter onEditRecord={singleUnit} onSubmit={onSubmit} editDisabled={disabled}
                         clearField={clearField} addDisabled={!unitValue.name.trim()}/>
        </Modal>
    )
};

const mapStateToProps = (state) => {
    const {base} = state;
    return {base}
};

export default connect(mapStateToProps, {editAvailableLocation})(AvailabelLocationForm);
