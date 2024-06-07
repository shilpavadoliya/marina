import {avaiableLocationActionType} from '../../constants';


export default (state = [], action) => {    
    switch (action.type) {
        case avaiableLocationActionType.FETCH_ALL_AVAILABLE_LOCATIONS:
            return action.payload;
        case avaiableLocationActionType.FETCH_AVAILABLE_LOCATION:
            return [action.payload];
        case avaiableLocationActionType.ADD_AVAILABLE_LOCATION:
            return [...state, action.payload];
        case avaiableLocationActionType.EDIT_AVAILABLE_LOCATION:
            return state.map(item => item.id === +action.payload.id ? action.payload : item);
        case avaiableLocationActionType.DELETE_AVAILABLE_LOCATION:
            return state.filter(item => item.id !== action.payload);
        default:
            return state;
    }
};

