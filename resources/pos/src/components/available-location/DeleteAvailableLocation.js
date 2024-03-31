import React from 'react';
import {connect} from 'react-redux';
import {deleteAvailableLocation} from '../../store/action/availableLocationAction';
import DeleteModel from '../../shared/action-buttons/DeleteModel';
import {getFormattedMessage} from '../../shared/sharedMethod';

const DeleteAvailableLocation = (props) => {
    const {deleteAvailableLocation, onDelete, deleteModel, onClickDeleteModel} = props;

    const deleteUserClick = () => {
        deleteAvailableLocation(onDelete.id);
        onClickDeleteModel(false);
    };

    return (
        <div>
            {deleteModel && <DeleteModel onClickDeleteModel={onClickDeleteModel} deleteModel={deleteModel}
                                         deleteUserClick={deleteUserClick} name={getFormattedMessage('unit.title')}/>}
        </div>
    )
};

export default connect(null, {deleteAvailableLocation})(DeleteAvailableLocation);
