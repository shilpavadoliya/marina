import React, { useState, useRef } from 'react';
import Form from 'react-bootstrap/Form';
import { connect } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import * as EmailValidator from 'email-validator';
import { editSupplier } from '../../store/action/supplierAction';
import { getFormattedMessage, placeholderText, numValidate } from '../../shared/sharedMethod';
import ModelFooter from '../../shared/components/modelFooter';

const SupplierForm = (props) => {
    const { addSupplierData, id, editSupplier, singleSupplier } = props;
    const navigate = useNavigate();

    const [supplierValue, setSupplierValue] = useState({
        name: singleSupplier ? singleSupplier[0].name : '',
        email: singleSupplier ? singleSupplier[0].email : '',
        businessConstitution: singleSupplier ? singleSupplier[0].business_constitution : '',
        distributorCategory: singleSupplier ? singleSupplier[0].distributor_category : '',
        managingPartner: singleSupplier ? singleSupplier[0].managing_partner : '',
        phone: singleSupplier ? singleSupplier[0].phone : '',
        country: singleSupplier ? singleSupplier[0].country : '',
        city: singleSupplier ? singleSupplier[0].city : '',
        address: singleSupplier ? singleSupplier[0].address : '',
        registeredOfficeState: singleSupplier ? singleSupplier[0].registered_office_state : '',
        contactPerson: singleSupplier ? singleSupplier[0].contact_person : '',
        mobileNumber: singleSupplier ? singleSupplier[0].mobile_number : '',
        principalAddress: singleSupplier ? singleSupplier[0].principal_address : '',
        brandsHandled: singleSupplier ? singleSupplier[0].brands_handled : '',
        cstNumber: singleSupplier ? singleSupplier[0].cst_number : '',
        vatNumber: singleSupplier ? singleSupplier[0].vat_number : '',
        gstin: singleSupplier ? singleSupplier[0].gstin : '',
        serviceTaxNumber: singleSupplier ? singleSupplier[0].service_tax_number : '',
        pan: singleSupplier ? singleSupplier[0].pan : '',
        bankName: singleSupplier ? singleSupplier[0].bank_name : '',
        bankBranch: singleSupplier ? singleSupplier[0].bank_branch : '',
        accountNumber: singleSupplier ? singleSupplier[0].account_number : '',
        ifscCode: singleSupplier ? singleSupplier[0].ifsc_code : '',
        appointmentType: singleSupplier ? singleSupplier[0].appointment_type : '',
        distributorMargin: singleSupplier ? singleSupplier[0].distributor_margin : '',
        paymentTerms: singleSupplier ? singleSupplier[0].payment_terms : '',
        securityRequired: singleSupplier ? singleSupplier[0].security_required : '',
        territoryAssigned: singleSupplier ? singleSupplier[0].territory_assigned : '',
        customersCovered: singleSupplier ? singleSupplier[0].customers_covered : '',
        claimPeriodicity: singleSupplier ? singleSupplier[0].claim_periodicity : '',

    });

    const [errors, setErrors] = useState({
        distributorName: '',
        email: '',
        phone: '',
        country: '',
        city: '',
        address: ''
    });

    const fileInputRef = useRef(null);

    const handleFileSelect = () => {
        fileInputRef.current.click();
    };

    const disabled = singleSupplier && singleSupplier[0].name === supplierValue.name && singleSupplier[0].country === supplierValue.country && singleSupplier[0].city === supplierValue.city && singleSupplier[0].email === supplierValue.email && singleSupplier[0].address === supplierValue.address && singleSupplier[0].phone === supplierValue.phone

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
        } else {
            isValid = true;
        }
        setErrors(errorss);
        return isValid;
    };

    const onChangeInput = (e) => {
        e.preventDefault();
        setSupplierValue(inputs => ({ ...inputs, [e.target.name]: e.target.value }))
        setErrors('');
    };

    const onSubmit = (event) => {
        event.preventDefault();
        const valid = handleValidation();
        if (singleSupplier && valid) {
            if (!disabled) {
                editSupplier(id, supplierValue, navigate);
            }
        } else {
            if (valid) {
                setSupplierValue(supplierValue);
                addSupplierData(supplierValue);
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
         x                       className='form-control'
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
                                value={supplierValue.businessConstitution}>
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
                                value={supplierValue.distributorCategory}>
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
                                value={supplierValue.managingPartner} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                State (Registered Office):
                            </label>
                            <input type='text' name='registered_office_state'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.registeredOfficeState} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Contact Person:
                            </label>
                            <input type='text' name='contact_person'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.contactPerson} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Mobile No:
                            </label>
                            <input type='text' name='mobile_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.mobileNumber} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Address (Principal place of business):
                            </label>
                            <input type='text' name='principal_address'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.principalAddress} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Brands currently handled:
                            </label>
                            <input type='text' name='brands_handled'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.brandsHandled} />
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
                                value={supplierValue.cstNumber} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                VAT Registration No/TIN No/GSTIN No:
                            </label>
                            <input type='text' name='vat_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.vatNumber} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Service Tax Registration No:
                            </label>
                            <input type='text' name='service_tax_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.serviceTaxNumber} />
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
                                value={supplierValue.bankName} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Bank Account Number:
                            </label>
                            <input type='text' name='account_number'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.accountNumber} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                IFSC Code:
                            </label>
                            <input type='text' name='ifsc_code'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.ifscCode} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Type of Appointment:
                            </label>
                            <input type='text' name='appointment_type'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.appointmentType} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Distributor margin offered:
                            </label>
                            <input type='text' name='distributor_margin'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.distributorMargin} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Payment Terms:
                            </label>
                            <textarea name='payment_terms'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}>
                                {supplierValue.paymentTerms}
                            </textarea>
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Security required in case of credit terms:
                            </label>
                            <input type='text' name='security_required'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.securityRequired} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Location/Territory Assigned:
                            </label>
                            <input type='text' name='territory_assigned'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.territoryAssigned} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Types of Customers covered:
                            </label>
                            <input type='text' name='customers_covered'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}
                                value={supplierValue.customersCovered} />
                        </div>
                        <div className='col-md-6 mb-3'>
                            <label className='form-label'>
                                Periodicity of claims:
                            </label>
                            <textarea name='claim_periodicity'
                                className='form-control'
                                onChange={(e) => onChangeInput(e)}>
                                {supplierValue.claimPeriodicity}
                            </textarea>
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
                    </div>
                    <ModelFooter onEditRecord={singleSupplier} onSubmit={onSubmit} editDisabled={disabled}
                        link='/app/suppliers' addDisabled={!supplierValue.name} />
                </Form>
            </div>
        </div >
    )
};

export default connect(null, { editSupplier })(SupplierForm);
