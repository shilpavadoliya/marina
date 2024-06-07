import React, {useEffect} from 'react';
import {connect} from 'react-redux';
import {useParams} from 'react-router-dom';
import MasterLayout from '../MasterLayout';
import HeaderTitle from '../header/HeaderTitle';
import {fetchAdjustment} from '../../store/action/adjustMentAction';
import {fetchAllWarehouses} from '../../store/action/warehouseAction';
import {getFormattedMessage} from '../../shared/sharedMethod';
import AdjustmentType from '../../shared/option-lists/AdjustmentType.json';
import AdjustmentForm from './AdjustmentForm';
import Spinner from "../../shared/components/loaders/Spinner";
import TopProgressBar from "../../shared/components/loaders/TopProgressBar";
import { fetchAllPurchases } from '../../store/action/purchaseAction';

const EditAdjustMent = (props) => {
    const {warehouses, fetchAllWarehouses, purchases, fetchAllPurchases, isLoading} = props;

    
    useEffect(() => {
        fetchAllWarehouses();
        fetchAllPurchases();
    }, []);



    return (
        <MasterLayout>
            <TopProgressBar />
            <HeaderTitle title={getFormattedMessage('adjustments.edit.title')} to='/app/adjustments'/>
            {isLoading ? <Spinner /> :
                <AdjustmentForm warehouses={warehouses} purchases={purchases} isOutStock={true}/>}
                
        </MasterLayout>
    )
};

const mapStateToProps = (state) => {
    // console.log(state);
    const {warehouses, isLoading, purchases} = state;
    // console.log(warehouses);
    // console.log(purchases);
    return {warehouses, isLoading, purchases}
};

export default connect(mapStateToProps, {fetchAllWarehouses, fetchAllPurchases})(EditAdjustMent);
