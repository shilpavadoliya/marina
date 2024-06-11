import React, { useState, useRef, useEffect } from 'react';
import Form from 'react-bootstrap/Form';
import { connect } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import * as EmailValidator from 'email-validator';
import { editSupplier,fetchCountries } from '../../store/action/supplierAction';
import { getFormattedMessage, placeholderText, numValidate } from '../../shared/sharedMethod';
import ModelFooter from '../../shared/components/modelFooter';
import { fetchAllWarehouses } from '../../store/action/warehouseAction';
import ReactSelect from '../../shared/select/reactSelect';
import { fetchState } from '../../store/action/settingAction';



const SupplierForm = (props) => {
    const { addSupplierData, id, editSupplier, isEdit, singleSupplier,  warehouses, fetchAllWarehouses, countries, fetchCountries, fetchState, countryState,defaultCountry } = props;
    const navigate = useNavigate();


    console.log(countries);
    const [supplierValue, setSupplierValue] = useState({
        name: singleSupplier ? singleSupplier[0].name : '',
        email: singleSupplier ? singleSupplier[0].email : '',
        business_constitution: singleSupplier ? singleSupplier[0].business_constitution : '',
        distributor_category: singleSupplier ? singleSupplier[0].distributor_category : '',
        managing_partner: singleSupplier ? singleSupplier[0].managing_partner : '',
        phone: singleSupplier ? singleSupplier[0].phone : '',
        country: singleSupplier ? singleSupplier[0].country : '',
        city: singleSupplier ? singleSupplier[0].city : '',
        address: singleSupplier ? singleSupplier[0].address : '',
        registered_office_state: singleSupplier ? singleSupplier[0].registered_office_state : '',
        contact_person: singleSupplier ? singleSupplier[0].contact_person : '',
        mobile_number: singleSupplier ? singleSupplier[0].mobile_number : '',
        pin_code: singleSupplier ? singleSupplier[0].pin_code : '',
        principal_address: singleSupplier ? singleSupplier[0].principal_address : '',
        brands_handled: singleSupplier ? singleSupplier[0].brands_handled : '',
        cst_number: singleSupplier ? singleSupplier[0].cst_number : '',
        vat_number: singleSupplier ? singleSupplier[0].vat_number : '',
        gstin: singleSupplier ? singleSupplier[0].gstin : '',
        service_tax_number: singleSupplier ? singleSupplier[0].service_tax_number : '',
        pan: singleSupplier ? singleSupplier[0].pan : '',
        bank_name: singleSupplier ? singleSupplier[0].bank_name : '',
        bank_branch: singleSupplier ? singleSupplier[0].bank_branch : '',
        account_number: singleSupplier ? singleSupplier[0].account_number : '',
        ifsc_code: singleSupplier ? singleSupplier[0].ifsc_code : '',
        appointment_type: singleSupplier ? singleSupplier[0].appointment_type : '',
        distributor_margin: singleSupplier ? singleSupplier[0].distributor_margin : '',
        payment_terms: singleSupplier ? singleSupplier[0].payment_terms : '',
        security_required: singleSupplier ? singleSupplier[0].security_required : '',
        territory_assigned: singleSupplier ? singleSupplier[0].territory_assigned : '',
        customers_covered: singleSupplier ? singleSupplier[0].customers_covered : '',
        claim_periodicity: singleSupplier ? singleSupplier[0].claim_periodicity : '',

    });
    useEffect( () => {
        fetchAllWarehouses()
        // fetchCountries()
    }, [] );

    // const [ byDefaultCountry, setByDefaultCountry ] = useState( null )


    const [areaPinTags, setAreaPinTags] = useState([]);
    const [areaPinInputValue, setAreaPinInputValue] = useState('');

    const handleAreaPinCodeChange = (event) => {
        setAreaPinInputValue(event.target.value);
    };

    const handleAreaPinInputKeyDown = (event) => {
        if (event.key === 'Enter' && areaPinInputValue.trim() !== '') {
            setAreaPinTags([...areaPinTags, areaPinInputValue.trim()]);
            setAreaPinInputValue('');
        }
    };

    const removeAreaPinTag = (tagToRemove) => {
        const updatedAreaPinTags = areaPinTags.filter(tag => tag !== tagToRemove);
        setAreaPinTags(updatedAreaPinTags);
    };

    // useEffect( () => {

    //         const countries = defaultCountry && defaultCountry.countries && defaultCountry.countries.filter( ( country ) => country.name === defaultCountry.country )
    //         countries && setByDefaultCountry( countries[ 0 ] )
        
    // }, [] )

    // useEffect( () => {
    //     byDefaultCountry && fetchState( byDefaultCountry && byDefaultCountry.id )
    // }, [ byDefaultCountry ] )

    // const [ checkState, setCheckState ] = useState( false )
    // const [ allState, setAllState ] = useState( null )

    // useEffect( () => {
    //     if ( countryState.value ) {
    //         setCheckState( true )
    //         setAllState( countryState )
    //     }
    // }, [countryState ] )

    // const stateOptions = checkState && allState && allState.value && allState.value.map( ( item ) => {
    //     return {
    //         id: item,
    //         name: item
    //     }
    // } )

    const [errors, setErrors] = useState({
        name: '',
        email: '',
        phone: '',
        country: '',
        city: '',
        address: '',
        warehouse_id: '',
        
    });

    const fileInputRef = useRef(null);

    const handleFileSelect = () => {
        fileInputRef.current.click();
    };

    const disabled = singleSupplier && singleSupplier[0].name === supplierValue.name && singleSupplier[0].country === supplierValue.country && singleSupplier[0].city === supplierValue.city && singleSupplier[0].email === supplierValue.email && singleSupplier[0].address === supplierValue.address && singleSupplier[0].phone === supplierValue.phone

    const onWarehouseChange = ( obj ) => {
        setSaleValue( inputs => ( { ...inputs, warehouse_id: obj } ) );
        setErrors( '' );
    };

    const handleValidation = () => {
        console.log('come inside');
        let errorss = {};
        let isValid = false;
        if (!supplierValue['name']) {
            errorss['name'] = getFormattedMessage("globally.input.name.validate.label");
        } else if (!EmailValidator.validate(supplierValue['email'])) {
            if (!supplierValue['email']) {
                errorss['email'] = getFormattedMessage("globally.input.email.validate.label");
            } else {
                errorss['email'] = getFormattedMessage("globally.input.email.valid.validate.label");
            }
        } else if (!supplierValue['country']) {
            errorss['country'] = getFormattedMessage("globally.input.country.validate.label");
        } else if (!supplierValue['city']) {
            errorss['city'] = getFormattedMessage("globally.input.city.validate.label");
        } else if (!supplierValue['phone']) {
            errorss['phone'] = getFormattedMessage("globally.input.phone-number.validate.label");
        } else if (!supplierValue['address']) {
            errorss['address'] = getFormattedMessage("globally.input.address.validate.label");
        } else {
            isValid = true;
        }
        setErrors(errorss);
        return isValid;
    };

    const onChangeInput = (e) => {
        console.log(e.target.name,e.target.value );
        e.preventDefault();
        setSupplierValue(inputs => ({ ...inputs, [e.target.name]: e.target.value }))
        // setErrors('');
    };

    const onCountryChange = ( obj ) => {
        setDisable( false );
        setSupplierValue( supplierValue => ( { ...supplierValue, country: obj } ) )
        setSupplierValue( supplierValue => ( { ...supplierValue, state: null } ) )
        fetchState( obj.value )
        setErrors( '' );
    };
    useEffect(() => {
        if (singleSupplier && singleSupplier[0] && singleSupplier[0].areaPinTags) {
            setAreaPinTags(singleSupplier[0].areaPinTags);
        }
    }, [singleSupplier]);
    

    const onStateChange = ( obj ) => {
        setDisable( false );
        setSupplierValue( supplierValue => ( { ...supplierValue, state: obj } ) )
        setErrors( '' );
    };

    const onSubmit = (event) => {
        event.preventDefault();
        const isValid = handleValidation();

        if (isValid) {
            const formData = {
                ...supplierValue,
                areaPinTags: areaPinTags // Include areaPinTags in the form data
            };

            if (singleSupplier) {
                editSupplier(id, formData, navigate);
            } else {
                addSupplierData(formData);
            }
        }
    };
    return (
        <div className='card'>
            <div className='card-body'>
                <Form>
                    <div className='row'>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                {getFormattedMessage("Distributor/Super Stockist Name")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='name'
                                placeholder={placeholderText("globally.input.name.placeholder.label")}
                                className='form-control'
                                autoFocus={true}
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.name} />
                            <span
                                className='text-danger d-block fw-400 fs-small mt-2'>{errors['name'] ? errors['name'] : null}</span>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label
                                className='form-label'>
                                {getFormattedMessage("globally.input.email.label")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='email'
                                placeholder={placeholderText("globally.input.email.placeholder.label")}
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.email} />
                            <span
                                className='text-danger d-block fw-400 fs-small mt-2'>{errors['email'] ? errors['email'] : null}</span>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label
                                className='form-label'>
                                {getFormattedMessage("globally.input.phone-number.label")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='phone'
                                placeholder={placeholderText("globally.input.phone-number.label")}
                                className='form-control'
                                pattern='[0-9]*' min={0}
                                onKeyPress={(event) => numValidate(event)}
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.phone} />
                            <span
                                className='text-danger d-block fw-400 fs-small mt-2'>{errors['phone'] ? errors['phone'] : null}</span>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                {getFormattedMessage("globally.input.country.label")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='country'
                                placeholder={placeholderText("globally.input.country.placeholder.label")}
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.country} />
                            <span
                                className='text-danger d-block fw-400 fs-small mt-2'>{errors['country'] ? errors['country'] : null}</span>
                        </div>

                        
                                {/* Country 
                                <div className='col-lg-6 mb-3'>
                                    <ReactSelect
                                        title={getFormattedMessage( "globally.input.country.label" )}
                                        placeholder={placeholderText( "globally.input.country.label" )}
                                        defaultValue={supplierValue.country ? { label: supplierValue.country.label, value: supplierValue.country.value } : ""}
                                        name='country'
                                        data={countries} onChange={onCountryChange}
                                        errors={errors[ 'country' ]} />                                </div>
                                state 
                                <div className='col-lg-6 mb-3'>
                                    <ReactSelect
                                        title={'State (Registered Office):'}
                                        placeholder={placeholderText( "setting.state.lable" )}
                                        name='state'
                                        value={supplierValue && supplierValue.state !== null ? supplierValue.state : ''}
                                         onChange={onStateChange}
                                        errors={errors[ 'state' ]} />
                                </div>
                                */}
                       
                        <div className='col-md-6 mb-3'>
                            <label
                                className='form-label'>
                                {getFormattedMessage("City (Registered Office):")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='city'
                                placeholder={placeholderText("globally.input.city.placeholder.label")}
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.city} />
                            <span className='text-danger d-block fw-400 fs-small mt-2'>{errors['city'] ? errors['city'] : null}</span>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label
                                className='form-label'>
                                {getFormattedMessage("Address (Registered Office):")}:
                            </label>
                            <span className='required' />
                            <input type='text' name='address'
                                placeholder={placeholderText("globally.input.address.placeholder.label")}
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.address}
                            />
                            <span className='text-danger d-block fw-400 fs-small mt-2'>{errors['address'] ? errors['address'] : null}</span>
                        </div>


                        {/* Distributor/Super Stockist Information */}

                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Constitution of Business:
                            </label>
                            <select name='business_constitution'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.business_constitution}>
                                <option value=''>Select Constitution of Business</option>
                                <option value='1'>PROPRITORSHIP</option>
                                <option value='2'>PARTNERSHIP</option>
                                <option value='3'>LIMITED COMPANY (Public)</option>
                                <option value='4'>LIMITED COMPANY (Private)</option>
                            </select>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Distributor Category/Type:
                            </label>
                            <select name='distributor_category'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.distributor_category}>
                                <option value=''>Select Distributor Category/Type</option>
                                <option value='1'>FROZEN SEAFOOD FOODS</option>
                                <option value='2'>Super Stockist</option>
                                <option value='3'>Distributor</option>
                            </select>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Name of Proprietor MD/Managing Partner:
                            </label>
                            <input type='text' name='managing_partner'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.managing_partner} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Contact Person:
                            </label>
                            <input type='text' name='contact_person'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.contact_person} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Mobile No:
                            </label>
                            <input type='text' name='mobile_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.mobile_number} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Pin Code:
                            </label>
                            <input type='text' name='pin_code'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.pin_code} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Address (Principal place of business):
                            </label>
                            <input type='text' name='principal_address'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.principal_address} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Brands currently handled:
                            </label>
                            <input type='text' name='brands_handled'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.brands_handled} />
                        </div>
                    </div>

                    <h2>Tax Particulars & Bank Details</h2>
                    <div className='row'>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Central Sales Tax No:
                            </label>
                            <input type='text' name='cst_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.cst_number} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                VAT Registration No/TIN No/GSTIN No:
                            </label>
                            <input type='text' name='vat_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.vat_number} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Service Tax Registration No:
                            </label>
                            <input type='text' name='service_tax_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.service_tax_number} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Permanent Account No (PAN):
                            </label>
                            <input type='text' name='pan'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.pan} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Bank Name & Branch:
                            </label>
                            <input type='text' name='bank_name'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.bank_name} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Bank Account Number:
                            </label>
                            <input type='text' name='account_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.account_number} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                IFSC Code:
                            </label>
                            <input type='text' name='ifsc_code'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.ifsc_code} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Type of Appointment:
                            </label>
                            <input type='text' name='appointment_type'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.appointment_type} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Distributor margin offered:
                            </label>
                            <input type='text' name='distributor_margin'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.distributor_margin} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Payment Terms:
                            </label>
                            <textarea name='payment_terms'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                  value={supplierValue.payment_terms} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Security required in case of credit terms:
                            </label>
                            <input type='text' name='security_required'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.security_required} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Location/Territory Assigned:
                            </label>
                            <input type='text' name='territory_assigned'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.territory_assigned} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Types of Customers covered:
                            </label>
                            <input type='text' name='customers_covered'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.customers_covered} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Periodicity of claims:
                            </label>
                            <textarea name='claim_periodicity'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}>
                                {supplierValue.claim_periodicity}
                            </textarea>
                        </div>
                        <div className='col-md-6 mb-3'>
                        <ReactSelect name='warehouse_id' data={warehouses} onChange={onWarehouseChange}
                            title={getFormattedMessage( 'warehouse.title' )} errors={errors[ 'warehouse_id' ]}
                            defaultValue={supplierValue.warehouse_id} value={supplierValue.warehouse_id} addSearchItems={singleSupplier}
                            isWarehouseDisable={true}
                            placeholder={placeholderText( 'purchase.select.warehouse.placeholder.label' )} />
                    </div>
                        <div className='col-md-6 mb-3'>
                            <input
                                type="file"
                                accept="image/*"
                                capture="environment"
                                style={{ display: 'none' }}
                                ref={fileInputRef}
                                onChange={handleFileSelect}
                                className='form-control'
                            />

                            <button type="button" className='btn btn-primary' onClick={handleFileSelect}>Choose Document</button>                       
                        </div>

                        {isEdit ? '' :
                            <div className='col-md-6 mb-3'>
                                    <label className='form-label'>
                                        {getFormattedMessage("user.input.password.label")}:
                                    </label>
                                    <span className='required'/>
                                    <input type='password' name='password'
                                                  placeholder={placeholderText("user.input.password.placeholder.label")}
                                                  className='form-control' value={supplierValue.password}
                                                  onChange={(e) => onChangeInput(e)}/>
                                    <span
                                        className='text-danger d-block fw-400 fs-small mt-2'>{errors['password'] ? errors['password'] : null}</span>
                            </div>}
                        {isEdit ? '' :
                            <div className='col-md-6 mb-3'>
                                    <label
                                        className='form-label'>
                                        {getFormattedMessage("user.input.confirm-password.label")}:
                                    </label>
                                    <span className='required'/>
                                    <input type='password' name='confirm_password' className='form-control'
                                                  placeholder={placeholderText("user.input.confirm-password.placeholder.label")}
                                                  onChange={(e) => onChangeInput(e)}
                                                  value={supplierValue.confirm_password}/>
                                    <span
                                        className='text-danger d-block fw-400 fs-small mt-2'>{errors['confirm_password'] ? errors['confirm_password'] : null}</span>
                            </div>}

                        <div className='col-md-6 mb-3'>
                        <label>Area Pin Code:</label>
                        <div className="tag-input-container">
                            <div className="tags">
                                {areaPinTags.map((tag, index) => (
                                    <span key={index} className="tag">
                                        {tag}
                                        <button type="button" className="tag-close" onClick={() => removeAreaPinTag(tag)}>x</button>
                                    </span>
                                ))}
                            </div>
                        </div>
                        <input
                            type="text"
                            value={areaPinInputValue}
                            onChange={handleAreaPinCodeChange}
                            onKeyDown={handleAreaPinInputKeyDown}
                            placeholder="Enter area pin code and press Enter"
                            className="tag-input"
                        />
                    </div>

                    </div>
                    <ModelFooter onEditRecord={singleSupplier} onSubmit={onSubmit} editDisabled={disabled}
                        link='/app/suppliers' addDisabled={!supplierValue.name} />
                </Form>
            </div>
        </div >
    )
};

// test
// export default connect( null, { editSupplier, fetchProductsByWarehouse } )( SupplierForm )

const mapStateToProps = ( state ) => {
    const { warehouses} = state;
    return {warehouses };
};

export default connect( mapStateToProps, {fetchAllWarehouses, editSupplier } )( SupplierForm );