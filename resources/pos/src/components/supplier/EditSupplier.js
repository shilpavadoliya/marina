import React, {useEffect} from 'react';
import {connect} from 'react-redux';
import {useParams} from 'react-router-dom'
import {fetchSupplier} from '../../store/action/supplierAction';
import HeaderTitle from '../header/HeaderTitle';
import MasterLayout from '../MasterLayout';
import SupplierForm from './SupplierForm';
import {getFormattedMessage} from '../../shared/sharedMethod';
import TopProgressBar from "../../shared/components/loaders/TopProgressBar";

const EditSupplier = (props) => {
    const {fetchSupplier, suppliers} = props;
    const {id} = useParams();

    useEffect(() => {
        fetchSupplier(id,true);
    }, []);

    console.log(props);

    const itemsValue = suppliers && suppliers.length === 1 && suppliers.map(supplier => ({
        name: supplier.attributes.name,
        email: supplier.attributes.email,
        phone: supplier.attributes.phone,
        country: supplier.attributes.country,
        city: supplier.attributes.city,
        address: supplier.attributes.address,
        managing_partner: supplier.attributes.managing_partner,
        areaPinTags: supplier.attributes.area_pin_code,
        status :supplier.attributes.status,
        business_constitution :supplier.attributes.business_constitution,
        distributor_category :supplier.attributes.distributor_category,
        managing_partner  :supplier.attributes.managing_partner,
        contact_person  :supplier.attributes.contact_person,
        phone_number  :supplier.attributes.phone_number,
        mobile_number  :supplier.attributes.mobile_number,
        principal_address  :supplier.attributes.principal_address,
        brands_handled  :supplier.attributes.brands_handled,
        cst_number  :supplier.attributes.cst_number,
        vat_number  :supplier.attributes.vat_number,
        gstin  :supplier.attributes.gstin,
        service_tax_number  :supplier.attributes.service_tax_number,
        pan  :supplier.attributes.pan,
        bank_name  :supplier.attributes.bank_name,
        bank_branch  :supplier.attributes.bank_branch,
        account_number  :supplier.attributes.account_number,
        ifsc_code  :supplier.attributes.ifsc_code,
        appointment_type  :supplier.attributes.appointment_type,
        distributor_margin  :supplier.attributes.distributor_margin,
        payment_terms  :supplier.attributes.payment_terms,
        security_required  :supplier.attributes.security_required,
        territory_assigned  :supplier.attributes.territory_assigned,
        customers_covered  :supplier.attributes.customers_covered,
        claim_periodicity  :supplier.attributes.claim_periodicity,
        registered_office_state  :supplier.attributes.registered_office_state,
        status  :supplier.attributes.status,
        user_id  :supplier.attributes.user_id,
        id: supplier.id
    }));

    return (
        <MasterLayout>
            <TopProgressBar />
            <HeaderTitle title={getFormattedMessage('supplier.edit.title')} to='/app/suppliers'/>
            {suppliers.length === 1 && <SupplierForm singleSupplier={itemsValue} id={id}/>}
        </MasterLayout>
    )
};

const mapStateToProps = (state) => {
    const {suppliers} = state;
    return {suppliers}
};

export default connect(mapStateToProps, {fetchSupplier})(EditSupplier);

