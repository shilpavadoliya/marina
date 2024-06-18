import React, { useState, useRef, useEffect } from 'react';
import Form from 'react-bootstrap/Form';
import { connect } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import * as EmailValidator from 'email-validator';
import { editSupplier } from '../../store/action/supplierAction';
import { getFormattedMessage, placeholderText, numValidate } from '../../shared/sharedMethod';
import ModelFooter from '../../shared/components/modelFooter';
import { fetchAllWarehouses } from '../../store/action/warehouseAction';
import ReactSelect from '../../shared/select/reactSelect';
// import { fetchSetting } from "../../store/action/settingAction";
import { fetchSetting, editSetting, fetchCacheClear, fetchState,fetchCity } from '../../store/action/settingAction';
import MultipleImage from './MultipleImage';




const SupplierForm = (props) => {
    const { addSupplierData, id, editSupplier, isEdit, singleSupplier, warehouses, fetchAllWarehouses,
        fetchSetting,
        settings,
        fetchState,
        countryState,
        fetchCity,
        cityState,
        defaultCountry   

    } = props;
    const navigate = useNavigate();



    
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
        state: singleSupplier ? singleSupplier[0].state : '',
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
        pan_card: singleSupplier ? singleSupplier[0].pan_card : '',
        aadhar_card: singleSupplier ? singleSupplier[0].aadhar_card : '',
        fssai_license: singleSupplier ? singleSupplier[0].fssai_license : '',
        gst_certificate: singleSupplier ? singleSupplier[0].gst_certificate : '',
        warehouse_id: singleSupplier ? singleSupplier[0].warehouse : '',

    });
    useEffect( () => {
        fetchSetting();
        fetchAllWarehouses();

    }, [] );


    
    const [areaPinTags, setAreaPinTags] = useState([]);
    const [areaPinInputValue, setAreaPinInputValue] = useState('');
    const [ byDefaultCountry, setByDefaultCountry ] = useState( null )
    const [ disable, setDisable ] = React.useState( true );
    const [panCard, setPanCard] = useState(null);
    const [aadharCard, setAadharCard] = useState(null);
    const [fssaiLicense, setFssaiLicense] = useState(null);
    const [gstCertificate, setGstCertificate] = useState(null);
    const [removedImage, setRemovedImage] = useState([])


    const [multipleFiles, setMultipleFiles] = useState([]);

    const handleFileChange = (event, setter) => {
        setter(event.target.files[0]);
    };


    const handleAreaPinCodeChange = (event) => {
       

        setAreaPinInputValue(event.target.value);
    };

    const handleAreaPinInputKeyDown = (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (areaPinInputValue && !areaPinTags.includes(areaPinInputValue)) {
                setAreaPinTags([...areaPinTags, areaPinInputValue]);
                setAreaPinInputValue('');
            }
        }
    };

    const removeAreaPinTag = (tag) => {
        setAreaPinTags(areaPinTags.filter(t => t !== tag));
    };

    useEffect( () => {
        if ( defaultCountry ) {
            const countries = defaultCountry && defaultCountry.countries && defaultCountry.countries.filter( ( country ) => country.name === defaultCountry.country )
            countries && setByDefaultCountry( countries[ 0 ] )
        }
    }, [ defaultCountry ] )

    useEffect( () => {
        byDefaultCountry && fetchState( byDefaultCountry && byDefaultCountry.id )
    }, [ byDefaultCountry ] )


    const [ checkState, setCheckState ] = useState( false )
    const [ allState, setAllState ] = useState( null )

    useEffect( () => {
        if ( countryState.value ) {
            setCheckState( true )
            setAllState( countryState )
        }
    }, [ settings, countryState ] )

    const stateOptions = checkState && allState && allState.value && allState.value.map( ( item ) => {
        return {
            id: item.id,
            name: item.name
        }
    } )

    
    const [ checkCity, setCheckCity ] = useState( false )
    const [ allCity, setAllCity ] = useState( null )

    useEffect( () => {
        if ( cityState.value ) {
            setCheckCity( true )
            setAllCity( cityState )
        }
    }, [ settings, cityState ] )

    const cityOptions = checkCity && allCity && allCity.value && allCity.value.map( ( item ) => {
        return {
            id: item.id,
            name: item.name
        }
    } )
    const onCountryChange = ( obj ) => {
        setDisable( false );
        setSupplierValue( supplierValue => ( { ...supplierValue, country: obj } ) )
        // setSupplierValue( supplierValue => ( { ...supplierValue, state: null } ) )
        fetchState( obj.value )
        setErrors( '' );
    };

    const onStateChange = ( obj ) => {
        setDisable( false );
        setSupplierValue( supplierValue => ( { ...supplierValue, state: obj } ) )
        console.log(obj);
        fetchCity( obj.value )
        setErrors( '' );
    };


    const onCityChange = (selectedCity) => {
        setDisable( false );
        setSupplierValue( supplierValue => ( { ...supplierValue, city: selectedCity } ) )
        setErrors( '' );

    };

    const onChangeFiles = (file) => {
        setMultipleFiles(file);
    };

    const transferImage = (item) => {
        setRemovedImage(item);
        setMultipleFiles([])
    };

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

        setSupplierValue( supplierValue => ( { ...supplierValue, warehouse_id: obj } ) )
        setErrors( '' );
    };

    const handleValidation = () => {
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
        }else if (!supplierValue['warehouse_id']) {
            console.log('warehpuse');
            errorss['warehouse_id'] = "Please select Option";
        }
        else if (!supplierValue['password'] && !isEdit) {
            console.log('password');

            errorss['password'] = "Please enter password";
        }
        
         else {
            isValid = true;
        }
        setErrors(errorss);
        return isValid;
    };

    const onChangeInput = (e) => {
        e.preventDefault();
        setSupplierValue(inputs => ({ ...inputs, [e.target.name]: e.target.value }))
        // setErrors('');
    };

    useEffect(() => {
        try {
            if (singleSupplier?.[0]?.areaPinTags) {
                setAreaPinTags(singleSupplier[0].areaPinTags);
            }
        } catch (error) {
            console.error('Error setting areaPinTags', error);
        }
    }, [singleSupplier]);


    const prepareFormData = (data) => {
        
        // console.log(areaPinTags);
        // console.log(data);
        // const formValue = {
        //     name: data.name,
        //     email: data.email,
        //     business_constitution: data.business_constitution,
        //     distributor_category: data.distributor_category,
        //     managing_partner: data.managing_partner,
        //     phone: data.phone,
        //     country: data.country.value,
        //     city: data.city.value,
        //     address: data.address,
        //     state: data.state.value,
        //     contact_person: data.contact_person,
        //     mobile_number: data.mobile_number,
        //     pin_code: data.pin_code,
        //     principal_address: data.principal_address,
        //     brands_handled: data.brands_handled,
        //     cst_number: data.cst_number,
        //     vat_number: data.vat_number,
        //     gstin: data.gstin,
        //     service_tax_number: data.service_tax_number,
        //     pan: data.pan,
        //     bank_name: data.bank_name,
        //     bank_branch: data.bank_branch,
        //     account_number: data.account_number,
        //     ifsc_code: data.ifsc_code,
        //     appointment_type: data.appointment_type,
        //     distributor_margin: data.distributor_margin,
        //     payment_terms: data.payment_terms,
        //     security_required: data.security_required,
        //     territory_assigned: data.territory_assigned,
        //     customers_covered: data.customers_covered,
        //     claim_periodicity: data.claim_periodicity,
        //     warehouse_id: data.warehouse_id.value,
        //     areaPinTags: areaPinTags, // Assuming areaPinTags is an array of tags
        //     panCard: panCard, // Assuming areaPinTags is an array of tags
        //     aadharCard: aadharCard, // Assuming areaPinTags is an array of tags
        //     gstCertificate: gstCertificate, // Assuming areaPinTags is an array of tags
        //     fssaiLicense: fssaiLicense // Assuming areaPinTags is an array of tags
        // };

        const formValue = new FormData();
    formValue.append('name', data.name);
    formValue.append('email', data.email);
    formValue.append('business_constitution', data.business_constitution);
    formValue.append('distributor_category', data.distributor_category);
    formValue.append('managing_partner', data.managing_partner);
    formValue.append('phone', data.phone);
    formValue.append('country', data.country.value);
    formValue.append('city', data.city.value);
    formValue.append('address', data.address);
    formValue.append('state', data.state.value);
    formValue.append('contact_person', data.contact_person);
    formValue.append('mobile_number', data.mobile_number);
    formValue.append('pin_code', data.pin_code);
    formValue.append('principal_address', data.principal_address);
    formValue.append('brands_handled', data.brands_handled);
    formValue.append('cst_number', data.cst_number);
    formValue.append('vat_number', data.vat_number);
    formValue.append('gstin', data.gstin);
    formValue.append('service_tax_number', data.service_tax_number);
    formValue.append('pan', data.pan);
    formValue.append('bank_name', data.bank_name);
    formValue.append('bank_branch', data.bank_branch);
    formValue.append('account_number', data.account_number);
    formValue.append('ifsc_code', data.ifsc_code);
    formValue.append('appointment_type', data.appointment_type);
    formValue.append('distributor_margin', data.distributor_margin);
    formValue.append('payment_terms', data.payment_terms);
    formValue.append('security_required', data.security_required);
    formValue.append('territory_assigned', data.territory_assigned);
    formValue.append('customers_covered', data.customers_covered);
    formValue.append('claim_periodicity', data.claim_periodicity);
    formValue.append('warehouse_id', data.warehouse_id.value);

    if(data.password) formValue.append('password', data.password);
    // formValue.append('areaPinTags', areaPinTags);

    areaPinTags.forEach((tag, index) => {
        formValue.append(`areaPinTags[${index}]`, tag);
    });

    if (panCard) formValue.append('panCard', panCard);
    if (aadharCard) formValue.append('aadharCard', aadharCard);
    if (fssaiLicense) formValue.append('fssaiLicense', fssaiLicense);
    if (gstCertificate) formValue.append('gstCertificate', gstCertificate);
    
    if (multipleFiles) {
        multipleFiles.forEach((image, index) => {
            formValue.append(`images[${index}]`, image);
        })
    }
        return formValue;
    };
    

    const onSubmit = (event) => {
        event.preventDefault();
        const isValid = handleValidation();
    
        if (isValid) {
            
            supplierValue.images = multipleFiles;

            // Debugging: Log formData before sending the request
            if (singleSupplier) {
                editSupplier(id, prepareFormData(supplierValue), navigate); // Assuming this sends formData to backend
            } else {
                addSupplierData(prepareFormData(supplierValue)); // Assuming this sends formData to backend
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
                    

                        
                                {/* Country  */}
                                <div className='col-lg-6 mb-3'>
                                    {settings && settings.attributes && byDefaultCountry && <ReactSelect
                                        title={getFormattedMessage( "globally.input.country.label" )}
                                        placeholder={"Choose Option"}
                                        // defaultValue={settings && settings.attributes && byDefaultCountry ? { label: supplierValue.country.label, value: supplierValue.country.value } : ""}
                                        name='country'
                                        value={supplierValue && supplierValue.country !== null ? supplierValue.country : ''}

                                        multiLanguageOption={defaultCountry.countries ? defaultCountry.countries : []} onChange={onCountryChange}
                                        errors={errors[ 'country' ]} />}
                                </div>
                                {/* state  */}
                                <div className='col-lg-6 mb-3'>
                                    {settings && settings.attributes && stateOptions.length && <ReactSelect
                                        title={getFormattedMessage( "setting.state.lable" )}
                                        placeholder={"Choose Option"}
                                        name='state'
                                        value={supplierValue && supplierValue.state !== null ? supplierValue.state : ''}
                                        multiLanguageOption={stateOptions} onChange={onStateChange}
                                        errors={errors[ 'state' ]} />}
                                </div>
                                {/* City  */}
                            
                                <div className='col-lg-6 mb-3'>
                                    <ReactSelect
                                        title={'City'}
                                        placeholder={'Choose option'}
                                        name='city'
                                        value={supplierValue && supplierValue.city !== null ? supplierValue.city : ''}
                                        multiLanguageOption={cityOptions.length ? cityOptions : []} onChange={onCityChange}
                                        errors={errors[ 'city' ]} />
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
                             value={supplierValue.warehouse_id} addSearchItems={singleSupplier}
                            isWarehouseDisable={true}
                            placeholder={placeholderText( 'purchase.select.warehouse.placeholder.label' )} />
                    </div>

                    
                        {/* <div className='col-md-6 mb-3'>
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
                        </div> */}

                        

                        <div className='col-md-6 mb-5'>
                        <label className='form-label'>
                                        {getFormattedMessage("globally.input.pan-card.label")}:
                                    </label>
                            <Form.Group controlId='formFileMultiple' className='mb-3'>
                                <Form.Control type='file'
                                    className='upload-input-file' onChange={(e) => handleFileChange(e, setPanCard)}

                                />
                                <span className='text-danger d-block fw-400 fs-small mt-2'>
                                    {errors[ 'file' ] ? errors[ 'file' ] : null}
                                </span>

                                {supplierValue.pan_card && (
                        <div className='mt-2'>
                        <span className='text-muted'> {supplierValue.pan_card}</span>
                        </div>
                         )}
                            </Form.Group>
                        </div>

                        <div className='col-md-6 mb-5'>
                        <label className='form-label'>
                                        {getFormattedMessage("globally.input.adhar-card.label")}:
                                    </label>
                            <Form.Group controlId='formFileMultiple' className='mb-3'>
                                <Form.Control type='file'
                                    className='upload-input-file'  
                                    onChange={(e) => handleFileChange(e, setAadharCard)}
                                />
                                <span className='text-danger d-block fw-400 fs-small mt-2'>
                                    {errors[ 'file' ] ? errors[ 'file' ] : null}
                                </span>
                                {supplierValue.aadhar_card && (
                        <div className='mt-2'>
                        <span className='text-muted'> {supplierValue.aadhar_card}</span>
                        </div>
                         )}
                            </Form.Group>
                        </div>

                        <div className='col-md-6 mb-5'>
                        <label className='form-label'>
                                        {getFormattedMessage("globally.input.fssai-license.label")}:
                                    </label>
                            <Form.Group controlId='formFileMultiple' className='mb-3'>
                                <Form.Control type='file' 
                                    className='upload-input-file'
                                    onChange={(e) => handleFileChange(e, setFssaiLicense)}
                                />
                                <span className='text-danger d-block fw-400 fs-small mt-2'>
                                    {errors[ 'file' ] ? errors[ 'file' ] : null}
                                </span>
                                {supplierValue.fssai_license && (
                        <div className='mt-2'>
                        <span className='text-muted'> {supplierValue.fssai_license}</span>
                        </div>
                         )}
                            </Form.Group>
                        </div>
 

                        <div className='col-md-6 mb-5'>
                        <label className='form-label'>
                                        {getFormattedMessage("globally.input.gst-certificate.label")}:
                                    </label>
                            <Form.Group controlId='formFileMultiple' className='mb-3'>
                                <Form.Control type='file'
                                    className='upload-input-file'
                                    onChange={(e) => handleFileChange(e, setGstCertificate)} 
                                />
                                <span className='text-danger d-block fw-400 fs-small mt-2'>
                                    {errors[ 'file' ] ? errors[ 'file' ] : null}
                                </span>
                                {supplierValue.gst_certificate && (
                        <div className='mt-2'>
                        <span className='text-muted'> {supplierValue.gst_certificate}</span>
                        </div>
                         )}
                            </Form.Group>
                        </div>

                        
                        <div className='col-md-6 mb-3'>
                                        <label className='form-label'>
                                            {getFormattedMessage('product.input.multiple-image.label')}: </label>
                                        <MultipleImage product={singleSupplier} fetchFiles={onChangeFiles}
                                            transferImage={transferImage} />
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
                        <label className='form-label'>Area Pin Code:</label>
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
                            className="tag-input form-control"
                        />
                        <span
                                        className='text-danger d-block fw-400 fs-small mt-2'>{errors['areaPinTags'] ? errors['areaPinTags'] : null}</span>

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

const mapStateToProps = (state) => {
    const { warehouses, settings, countryState, defaultCountry,cityState  } = state;
    return { warehouses, settings, countryState, defaultCountry, cityState }
};

export default connect( mapStateToProps, {fetchAllWarehouses, fetchSetting, fetchState, fetchCity,editSupplier } )( SupplierForm );

