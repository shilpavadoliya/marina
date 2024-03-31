import apiConfig from "../../config/apiConfig";
import {
    apiBaseURL,
    toastType,
    avaiableLocationActionType,
    Filters,
} from "../../constants";
import requestParam from "../../shared/requestParam";
import { addToast } from "./toastAction";
import {
    setTotalRecord,
    addInToTotalRecord,
    removeFromTotalRecord,
} from "./totalRecordAction";
import { setLoading } from "./loadingAction";
import { getFormattedMessage } from "../../shared/sharedMethod";

export const fetchAvailableLocations =
    (filter = {}, isLoading = true) =>
    async (dispatch) => {
        if (isLoading) {
            dispatch(setLoading(true));
        }
        let url = apiBaseURL.AVAILABLE_LOCATION;
        if (
            !_.isEmpty(filter) &&
            (filter.page ||
                filter.pageSize ||
                filter.search ||
                filter.ordear_By ||
                filter.created_at)
        ) {
            url += requestParam(filter, null, null, null, url);
        }
        apiConfig
            .get(url)
            .then((response) => {
                dispatch({
                    type: avaiableLocationActionType.FETCH_ALL_AVAILABLE_LOCATIONS,
                    payload: response.data.data,
                });
                dispatch(
                    setTotalRecord(
                        response.data.meta.total !== undefined &&
                            response.data.meta.total >= 0
                            ? response.data.meta.total
                            : response.data.data.total
                    )
                );
                if (isLoading) {
                    dispatch(setLoading(false));
                }
            })
            .catch(({ response }) => {
                dispatch(
                    addToast({
                        text: response?.data?.message,
                        type: toastType.ERROR,
                    })
                );
            });
    };

export const fetchAvailableLocation = (availableLocationId, singleAvailableLocation) => async (dispatch) => {
    apiConfig
        .get(apiBaseURL.AVAILABLE_LOCATION + "/" + availableLocationId, singleAvailableLocation)
        .then((response) => {
            dispatch({
                type: avaiableLocationActionType.FETCH_AVAILABLE_LOCATION,
                payload: response.data.data,
            });
        })
        .catch(({ response }) => {
            dispatch(
                addToast({ text: response.data.message, type: toastType.ERROR })
            );
        });
};

export const addAvailableLocation = (AVAILABLE_LOCATION) => async (dispatch) => {
    await apiConfig
        .post(apiBaseURL.AVAILABLE_LOCATION, AVAILABLE_LOCATION)
        .then((response) => {
            dispatch({
                type: avaiableLocationActionType.ADD_AVAILABLE_LOCATION,
                payload: response.data.data,
            });
            dispatch(fetchAvailableLocation(Filters.OBJ));
            dispatch(
                addToast({
                    text: getFormattedMessage(
                        "available-location.success.create.message"
                    ),
                })
            );
            dispatch(addInToTotalRecord(1));
        })
        .catch(({ response }) => {
            dispatch(
                addToast({
                    text: response?.data?.message,
                    type: toastType.ERROR,
                })
            );
        });
};

export const editAvailableLocation =
    (availableLocationId, avaiableLocations, handleClose) => async (dispatch) => {
        apiConfig
            .patch(apiBaseURL.AVAILABLE_LOCATION + "/" + availableLocationId, avaiableLocations)
            .then((response) => {
                dispatch({
                    type: avaiableLocationActionType.EDIT_AVAILABLE_LOCATION,
                    payload: response.data.data,
                });
                handleClose(false);
                dispatch(
                    addToast({
                        text: getFormattedMessage(
                            "available-location.success.edit.message"
                        ),
                    })
                );
            })
            .catch(({ response }) => {
                dispatch(
                    addToast({
                        text: response?.data?.message,
                        type: toastType.ERROR,
                    })
                );
            });
    };

export const deleteAvailableLocation = (availableLocationId) => async (dispatch) => {
    apiConfig
        .delete(apiBaseURL.AVAILABLE_LOCATION + "/" + availableLocationId)
        .then((response) => {
            dispatch(removeFromTotalRecord(1));
            dispatch({
                type: avaiableLocationActionType.DELETE_AVAILABLE_LOCATION,
                payload: availableLocationId,
            });
            dispatch(
                addToast({
                    text: getFormattedMessage(
                        "available-location.success.delete.message"
                    ),
                })
            );
        })
        .catch(({ response }) => {
            dispatch(
                addToast({
                    text: response?.data?.message,
                    type: toastType.ERROR,
                })
            );
        });
};

export const fetchAllAvailableLocation = () => async (dispatch) => {
    apiConfig
        .get(`available-location?page[size]=0`)
        .then((response) => {
            dispatch({
                type: avaiableLocationActionType.FETCH_ALL_AVAILABLE_LOCATION,
                payload: response.data.data,
            });
        })
        .catch(({ response }) => {
            dispatch(
                addToast({
                    text: response?.data?.message,
                    type: toastType.ERROR,
                })
            );  
        });
};
