import React from 'react';
import {connect} from 'react-redux';
import AvailabelLocationForm from './AvailabelLocationForm';
import {getFormattedMessage} from '../../shared/sharedMethod';

const EditAvailableLocation = (props) => {
    const {handleClose, show, unit} = props;

    return (
        <>
            {unit &&
            <AvailabelLocationForm handleClose={handleClose} show={show} singleUnit={unit}
                       title={getFormattedMessage('unit.edit.title')}/>
            }
        </>
    )
};

export default connect(null)(EditAvailableLocation);

