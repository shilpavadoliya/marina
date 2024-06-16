export default ( state = [], action ) => {
    switch ( action.type ) {
        case 'FETCH_CITY_DATA':
            return action.payload;    
        default:
            return state;
    }
};
