import React, {useEffect} from 'react';
import {connect} from 'react-redux';
import {useNavigate} from 'react-router-dom';
import AdjustmentForm from './AdjustmentForm';
import MasterLayout from '../MasterLayout';
import HeaderTitle from '../header/HeaderTitle';
import { addAdjustment } from '../../store/action/adjustMentAction';
import {fetchAllWarehouses} from '../../store/action/warehouseAction';
import {getFormattedMessage} from '../../shared/sharedMethod';
import { fetchAllPurchases } from '../../store/action/purchaseAction';

const CreateAdjustment = (props) => {
    const {addAdjustment, warehouses, fetchAllWarehouses, purchases, fetchAllPurchases} = props;
    const navigate = useNavigate();

    useEffect(() => {
        fetchAllWarehouses();
        fetchAllPurchases();
    }, []);

    const addAdjustmentData = (formValue) => {
        addAdjustment(formValue, navigate);
    };

    return (
        <MasterLayout>
            <HeaderTitle title={getFormattedMessage('adjustments.create.title')} to='/app/adjustments'/>
            <AdjustmentForm addAdjustmentData={addAdjustmentData} warehouses={warehouses} purchases={purchases}/>
        </MasterLayout>
    )
};

const mapStateToProps = (state) => {
    const {warehouses, totalRecord, purchases} = state;
    return {warehouses, totalRecord, purchases}
};

export default connect(mapStateToProps, {addAdjustment, fetchAllWarehouses, fetchAllPurchases})(CreateAdjustment);
