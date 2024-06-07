import React, {useState} from 'react';
import {Button} from 'react-bootstrap-v5';
import {connect} from 'react-redux';
import {addAvailableLocation} from '../../store/action/availableLocationAction';
import AvailabelLocationForm from './AvailabelLocationForm';
import {getFormattedMessage} from '../../shared/sharedMethod';

const CreateAvailableLocation = (props) => {
    const {addAvailableLocation} = props;
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(!show);

    const addAvailableLocationsData = (productValue) => {
        addAvailableLocation(productValue);
    };

    return (
        <div className='text-end w-sm-auto'>
            <Button variant='primary mb-lg-0 mb-md-0 mb-4' onClick={handleClose}>
                {getFormattedMessage('available_location.create.title')}
            </Button>
            <AvailabelLocationForm addProductData={addAvailableLocationsData} handleClose={handleClose} show={show}
                       title={getFormattedMessage('available_location.create.title')}/>
        </div>

    )
};

export default connect(null, {addAvailableLocation})(CreateAvailableLocation);
