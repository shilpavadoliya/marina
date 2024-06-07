import React, { useState } from 'react';
import { connect } from 'react-redux';
import MasterLayout from '../MasterLayout';
import { fetchAvailableLocations } from '../../store/action/availableLocationAction';
import ReactDataTable from '../../shared/table/ReactDataTable';
import DeleteAvailableLocation from './DeleteAvailableLocation';
import CreateAvailableLocation from './CreateAvailableLocation';
import EditAvailableLocation from './EditAvailableLocation';
import TabTitle from '../../shared/tab-title/TabTitle';
import { getFormattedMessage, placeholderText } from '../../shared/sharedMethod';
import ActionButton from '../../shared/action-buttons/ActionButton';
import TopProgressBar from "../../shared/components/loaders/TopProgressBar";

const AvaialbleLocation = ( props ) => {
    const { fetchAvailableLocations, availableLocations, totalRecord, isLoading } = props;
    const [ deleteModel, setDeleteModel ] = useState( false );
    const [ isDelete, setIsDelete ] = useState( null );
    const [ editModel, setEditModel ] = useState( false );
    const [ unit, setUnit ] = useState();

    const handleClose = ( item ) => {
        setEditModel( !editModel );
        setUnit( item );
    };

    const onClickDeleteModel = ( isDelete = null ) => {
        setDeleteModel( !deleteModel );
        setIsDelete( isDelete );
    };

    const onChange = ( filter ) => {
        fetchAvailableLocations( filter, true );
    };

    console.log(availableLocations);
    

    const itemsValue = availableLocations.length >= 0 && availableLocations.map( unit => {
        return {
            name: unit.attributes.name,
            id: unit.id
        }
    } );

    const columns = [
        {
            name: getFormattedMessage( 'globally.input.id.label' ),
            selector: row => row.id,
            sortField: 'id',
            sortable: true,
        },
        {
            name: getFormattedMessage( 'globally.input.name.label' ),
            selector: row => row.name,
            sortField: 'name',
            sortable: true,
        },
        {
            name: getFormattedMessage( 'react-data-table.action.column.label' ),
            right: true,
            ignoreRowClick: true,
            allowOverflow: true,
            button: true,
            cell: row => <ActionButton item={row} goToEditProduct={handleClose} isEditMode={true}
                onClickDeleteModel={onClickDeleteModel} />
        }
    ];

    return (
        <MasterLayout>
            <TopProgressBar />
            <TabTitle title={placeholderText( 'available-locations.title' )} />
            <ReactDataTable columns={columns} items={itemsValue} onChange={onChange} isLoading={isLoading}
                AddButton={<CreateAvailableLocation />} title={getFormattedMessage( 'available_location.modal.input.available_location.label' )}
                totalRows={totalRecord} isUnitFilter />
            <EditAvailableLocation handleClose={handleClose} show={editModel} unit={unit} />
            <DeleteAvailableLocation onClickDeleteModel={onClickDeleteModel} deleteModel={deleteModel}
                         onDelete={isDelete}/>

        </MasterLayout>
    )
};

const mapStateToProps = ( state ) => {
    const { availableLocations, totalRecord, isLoading } = state;
    return { availableLocations, totalRecord, isLoading }
};

export default connect( mapStateToProps, { fetchAvailableLocations } )( AvaialbleLocation );

