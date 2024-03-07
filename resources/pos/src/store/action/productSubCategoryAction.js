import apiConfig from "../../config/apiConfig";
import {
    apiBaseURL,
    productSubCategoriesActionType,
    toastType,
} from "../../constants";
import { addToast } from "./toastAction";
import {
    addInToTotalRecord,
    setTotalRecord,
    removeFromTotalRecord,
} from "./totalRecordAction";
import requestParam from "../../shared/requestParam";
import { setLoading } from "./loadingAction";
import { getFormattedMessage } from "../../shared/sharedMethod";

export const fetchProductSubCategories =
    (filter = {}, isLoading = true) =>
    async (dispatch) => {
        if (isLoading) {
            dispatch(setLoading(true));
        }
        let url = apiBaseURL.PRODUCTS_SUB_CATEGORIES;
        console.log(url);
        if (
            !_.isEmpty(filter) &&
            (filter.page ||
                filter.pageSize ||
                filter.search ||
                filter.order_By ||
                filter.created_at)
        ) {
            url += requestParam(filter, null, null, null, url);
        }
        apiConfig
            .get(url)
            .then((response) => {
                console.log(response);
                dispatch({
                    type: productSubCategoriesActionType.FETCH_PRODUCTS_SUB_CATEGORIES,
                    payload: response.data.data,
                });
                dispatch(setTotalRecord(response.data.meta.total));
            })
            .catch((response) => {
                console.log(response);
                dispatch(
                    addToast({
                        text: response.response.data.message,
                        type: toastType.ERROR,
                    })
                );
            })
            .finally(() => {
                if (isLoading) {
                    dispatch(setLoading(false));
                }
            });
    };

export const fetchProductCategory =
    (productId, singleProduct) => async (dispatch) => {
        apiConfig
            .get(
                apiBaseURL.PRODUCTS_SUB_CATEGORIES + "/" + productId,
                singleProduct
            )
            .then((response) => {
                dispatch({
                    type: productSubCategoriesActionType.FETCH_PRODUCT_SUB_CATEGORIES,
                    payload: response.data.data,
                });
            })
            .catch(({ response }) => {
                dispatch(
                    addToast({
                        text: response.data.message,
                        type: toastType.ERROR,
                    })
                );
            });
    };

export const addProductSubCategory = (products) => async (dispatch) => {
    await apiConfig
        .post(apiBaseURL.PRODUCTS_SUB_CATEGORIES, products)
        .then((response) => {
            dispatch({
                type: productSubCategoriesActionType.ADD_PRODUCT_SUB_CATEGORIES,
                payload: response.data.data,
            });
            dispatch(
                addToast({
                    text: getFormattedMessage(
                        "product-category.success.create.message"
                    ),
                })
            );
            dispatch(addInToTotalRecord(1));
        })
        .catch(({ response }) => {
            dispatch(
                addToast({ text: response.data.message, type: toastType.ERROR })
            );
        });
};

export const editProductSubCategory =
    (productId, products, handleClose) => async (dispatch) => {
        apiConfig
            .post(apiBaseURL.PRODUCTS_SUB_CATEGORIES + "/" + productId, products)
            .then((response) => {
                dispatch({
                    type: productSubCategoriesActionType.EDIT_PRODUCT_SUB_CATEGORIES,
                    payload: response.data.data,
                });
                handleClose(false);
                dispatch(
                    addToast({
                        text: getFormattedMessage(
                            "product-category.success.edit.message"
                        ),
                    })
                );
            })
            .catch(({ response }) => {
                dispatch(
                    addToast({
                        text: response.data.message,
                        type: toastType.ERROR,
                    })
                );
            });
    };

export const deleteProductSubCategory = (productId) => async (dispatch) => {
    apiConfig
        .delete(apiBaseURL.PRODUCTS_SUB_CATEGORIES + "/" + productId)
        .then((response) => {
            dispatch(removeFromTotalRecord(1));
            dispatch({
                type: productSubCategoriesActionType.DELETE_PRODUCT_SUB_CATEGORIES,
                payload: productId,
            });
            dispatch(
                addToast({
                    text: getFormattedMessage(
                        "product-category.success.delete.message"
                    ),
                })
            );
        })
        .catch(({ response }) => {
            dispatch(
                addToast({ text: response.data.message, type: toastType.ERROR })
            );
        });
};

export const fetchAllSubProductCategories = () => async (dispatch) => {
    apiConfig
        .get(`product-sub-categories?page[size]=0`)
        .then((response) => {
            dispatch({
                type: productSubCategoriesActionType.FETCH_ALL_PRODUCTS_SUB_CATEGORIES,
                payload: response.data.data,
            });
        })
        .catch(({ response }) => {
            dispatch(
                addToast({ text: response.data.message, type: toastType.ERROR })
            );
        });
};
