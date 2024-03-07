import {productSubCategoriesActionType} from '../../constants';

export default (state = [], action) => {
        console.log(action.type);
        console.log('come');
    switch (action.type) {
        case productSubCategoriesActionType.FETCH_PRODUCTS_SUB_CATEGORIES:
            return action.payload;
        case productSubCategoriesActionType.FETCH_PRODUCT_SUB_CATEGORIES:
            return [action.payload];
        case productSubCategoriesActionType.ADD_PRODUCT_SUB_CATEGORIES:
            return action.payload;
        case productSubCategoriesActionType.EDIT_PRODUCT_SUB_CATEGORIES:
            return state.map(item => item.id === +action.payload.id ? action.payload : item);
        case productSubCategoriesActionType.DELETE_PRODUCT_SUB_CATEGORIES:
            return state.filter(item => item.id !== action.payload);
        case productSubCategoriesActionType.FETCH_ALL_PRODUCTS_SUB_CATEGORIES:
            return action.payload;
        default:
            return state;
    }
};
