import React, { useState } from 'react'
import { connect } from 'react-redux'
import MasterLayout from '../MasterLayout'
import { fetchProductSubCategories } from '../../store/action/productSubCategoryAction'
import ReactDataTable from '../../shared/table/ReactDataTable'
import DeleteProductSubCategory from './DeleteProductSubCategory'
import CreateProductSubCategory from './CreateProductSubCategory'
import EditProductSubCategory from './EditProductSubCategory'
import TabTitle from '../../shared/tab-title/TabTitle'
import { getFormattedMessage, placeholderText } from '../../shared/sharedMethod'
import user from '../../assets/images/productCategory_logo.jpeg'
import ActionButton from '../../shared/action-buttons/ActionButton'
import { Tokens } from '../../constants';
import TopProgressBar from "../../shared/components/loaders/TopProgressBar";

const ProductSubCategory = (props) => {
    // console.log(props);
    const {
        fetchProductSubCategories,
        productSubCategories,
        totalRecord,
        isLoading,
    } = props
    const [deleteModel, setDeleteModel] = useState(false)
    const [isDelete, setIsDelete] = useState(null)
    const [editModel, setEditModel] = useState(false)
    const [productSubCategory, setProductSubCategory] = useState()
    const updatedLanguage = localStorage.getItem(Tokens.UPDATED_LANGUAGE)

    const handleClose = (item) => {
        setEditModel(!editModel)
        setProductSubCategory(item);
    };

    const onClickDeleteModel = (isDelete = null) => {
        setDeleteModel(!deleteModel);
        setIsDelete(isDelete);
    };

    const onChange = (filter) => {
        fetchProductSubCategories(filter, true);
    };


    const itemsValue = productSubCategories.length >= 0 && productSubCategories.map(product => ({
        name: product.attributes.name,
        image: product.attributes.image,
        products_count: product.attributes.products_count,
        category_id: product.attributes.category_id,
        id: product.id,
    }));

    const columns = [
        {
            name: "Product Subcategory",
            selector: row => row.name,
            sortField: 'name',
            sortable: true,
            cell: row => {
                const imageUrl = row.image ? row.image : user;
                return (
                    <div className='d-flex align-items-center'>
                        <div className='d-flex flex-column'>
                            <span>{row.name}</span>
                        </div>
                    </div>
                )
            },
        },
        {
            name: getFormattedMessage('brand.table.product-count.column.label'),
            selector: row => row.products_count,
            style: updatedLanguage === 'ar' ? {paddingRight: '87px'} : {paddingLeft: '130px'},
        },
        {
            name: getFormattedMessage('react-data-table.action.column.label'),
            right: true,
            ignoreRowClick: true,
            allowOverflow: true,
            button: true,
            cell: row => <ActionButton item={row} goToEditProduct={handleClose} isEditMode={true}
                                      onClickDeleteModel={onClickDeleteModel}/>
        }
    ];

    return (
        <MasterLayout>
            <TopProgressBar />
            <TabTitle title={placeholderText('product-sub-categories.title')}/>
                <ReactDataTable columns={columns} items={itemsValue} onChange={onChange} isLoading={isLoading}
                                AddButton={<CreateProductSubCategory/>}
                                totalRows={totalRecord}/>
                <EditProductSubCategory handleClose={handleClose} show={editModel} productSubCategory={productSubCategory}/>
                <DeleteProductSubCategory onClickDeleteModel={onClickDeleteModel} deleteModel={deleteModel}
                                       onDelete={isDelete}/>
        </MasterLayout>
    )
};

const mapStateToProps = (state) => {
    const {productSubCategories, totalRecord, isLoading} = state;
    return {productSubCategories, totalRecord, isLoading}
};

export default connect(mapStateToProps, {fetchProductSubCategories})(ProductSubCategory);

