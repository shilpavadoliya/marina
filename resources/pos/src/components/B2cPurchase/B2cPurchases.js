import React, { useEffect, useState } from "react";
import MasterLayout from "../MasterLayout";
import { connect } from "react-redux";
import moment from "moment";
import ReactDataTable from "../../shared/table/ReactDataTable";
import ActionDropDownButton from "../../shared/action-buttons/ActionDropDownButton";
import TabTitle from "../../shared/tab-title/TabTitle";
import { fetchPurchases,fetchOrders } from "../../store/action/purchaseAction";
import { fetchAllSuppliers } from "../../store/action/supplierAction";
import { fetchAllWarehouses } from "../../store/action/warehouseAction";
import {
    currencySymbolHandling,
    placeholderText,
} from "../../shared/sharedMethod";
import { getFormattedMessage, getFormattedOptions } from "../../shared/sharedMethod";
import { purchasePdfAction } from "../../store/action/purchasePdfAction";
import { fetchFrontSetting } from "../../store/action/frontSettingAction";
import ShowPayment from "../../shared/showPayment/ShowPayment";
import TopProgressBar from "../../shared/components/loaders/TopProgressBar";
import ReactSelect from '../../shared/select/reactSelect';
import { saleStatusOptions } from '../../constants';
import { changePurchaseStatus } from '../../store/action/purchaseAction';


const Product = (props) => {
    const {
        fetchPurchases,
        fetchOrders,
        fetchAllWarehouses,
        fetchAllSuppliers,
        purchases,
        totalRecord,
        isLoading,
        suppliers,
        purchasePdfAction,
        changePurchaseStatus,
        frontSetting,
        fetchFrontSetting,
        allConfigData,
        userRole
    } = props;
    const [deleteModel, setDeleteModel] = useState(false);
    const [isDelete, setIsDelete] = useState(null);
    const [isShowPaymentModel, setIsShowPaymentModel] = useState(false);
    const [selectedPurchaseId, setSelectedPurchaseId] = useState(null); 
    const currencySymbol =
        frontSetting &&
        frontSetting.value &&
        frontSetting.value.currency_symbol;
    const [tableArray, setTableArray] = useState([]);
    const [disabledOptions, setDisabledOptions] = useState([]);


    useEffect(() => {
        fetchFrontSetting();
    }, []);

    const onClickDeleteModel = (isDelete = null) => {
        setDeleteModel(!deleteModel);
        setIsDelete(isDelete);
    };

    const onChange = (filter) => {
        fetchAllSuppliers();
        fetchAllWarehouses();
        // fetchPurchases(filter, true, true);
        fetchOrders(filter, true);
    };

    const goToEditProduct = (item) => {
        const id = item.id;
        window.location.href = "#/app/purchases/edit/" + id;
    };

    const goToDetailScreen = (ProductId) => {
        window.location.href = "#/app/b2c-purchases/detail/" + ProductId;
    };

    const onShowPaymentClick = () => {
        setIsShowPaymentModel(!isShowPaymentModel);
    };

    //onClick pdf function
    const onPdfClick = (id) => {
        purchasePdfAction(id);
    };
    
    const onStatusChange = (selectedPurchaseId, selectedOption) => {
        changePurchaseStatus(selectedPurchaseId, selectedOption);
            // Handle success if needed
        
    };

    const itemsValue =
        currencySymbol &&
        purchases.length >= 0 &&
        purchases.map((purchase) => {
            const supplier = suppliers.filter(
                (supplier) => supplier.id === purchase.attributes.supplier_id
            );
            const supplierName =
                supplier[0] &&
                supplier[0].attributes &&
                supplier[0].attributes.name;
            return {
                reference_code: purchase.attributes.reference_code,
                supplier: supplierName,
                warehouse: purchase.attributes.warehouse_name,
                status: purchase.attributes.status,
                paid: 0,
                due: 0,
                payment: purchase.attributes.payment_type,
                date: moment(purchase.attributes.date).format("YYYY-MM-DD"),
                time: moment(purchase.attributes.created_at).format("LT"),
                grand_total: purchase.attributes.grand_total,
                currency: currencySymbol,
                id: purchase.id,
            };
        });

    useEffect(() => {
        const grandTotalSum = () => {
            let x = 0;
            itemsValue.length &&
                itemsValue.map((item) => {
                    x = x + Number(item.grand_total);
                    return x;
                });
            return x;
        };
        const paidTotalSum = (itemsValue) => {
            let x = 0;
            itemsValue.length &&
                itemsValue.map((item) => {
                    x = x + Number(item.paid_amount);
                    return x;
                });
            return x;
        };
        if (purchases.length) {
            const newObject = itemsValue.length && {
                date: "",
                time: "",
                reference_code: "Total",
                customer_name: "",
                warehouse_name: "",
                status: "",
                payment_status: "",
                payment_type: "",
                grand_total: grandTotalSum(itemsValue),
                paid_amount: paidTotalSum(itemsValue),
                paid: 0,
                due: 0,
                id: "",
                payment: "",
                currency: currencySymbol,
            };
            const newItemValue =
                itemsValue.length && newObject && itemsValue.concat(newObject);
            const latestArray = newItemValue.map((item) => item);
            newItemValue.length && setTableArray(latestArray);
        }
    }, [purchases]);

    useEffect(() => {
        updateDisabledOptions(statusDefaultValue);
        if (purchases.length === 0) {
            setTableArray([]);
        }
    }, [purchases]);

    
    const statusFilterOptions = getFormattedOptions( saleStatusOptions )
    const statusDefaultValue = statusFilterOptions.map( ( option ) => {
        return {
            value: option.id,
            label: option.name
        }
    } )


    const updateDisabledOptions = (selectedStatus) => {
        let disabledOptions = [];
        switch (selectedStatus) {
            case 1:
                disabledOptions = [2, 3, 4, 5];
                break;
            case 2:
                disabledOptions = [1];
                break;
            case 3:
                disabledOptions = [1, 2];
                break;
            case 4:
                disabledOptions = [1, 2, 3];
                break;
            case 5:
                disabledOptions = [1, 2, 3, 4];
                break;
            default:
                break;
        }
        setDisabledOptions(disabledOptions);
    };

    const columns = [
        {
            name: getFormattedMessage("dashboard.recentSales.reference.label"),
            sortField: "reference_code",
            sortable: true,
            cell: (row) => {
                return row.reference_code === "Total" ? (
                    <span className="fw-bold fs-4">
                        {getFormattedMessage("pos-total.title")}
                    </span>
                ) : (
                    <span className="badge bg-light-danger">
                        <span>{row.reference_code}</span>
                    </span>
                );
            },
        },
        {
            name: getFormattedMessage("supplier.title"),
            selector: (row) => row.supplier,
            sortField: "supplier",
            sortable: false,
        },
        // {
        //     name: getFormattedMessage("purchase.select.status.label"),
        //     sortField: "status",
        //     sortable: false,
        //     cell: (row) => {
        //         return (
        //             (row.status === 1 && (
        //                 <span className="badge bg-light-success">
        //                     <span>
        //                         {getFormattedMessage(
        //                             "status.filter.received.label"
        //                         )}
        //                     </span>
        //                 </span>
        //             )) ||
        //             (row.status === 2 && (
        //                 <span className="badge bg-light-primary">
        //                     <span>
        //                         {getFormattedMessage(
        //                             "status.filter.pending.label"
        //                         )}
        //                     </span>
        //                 </span>
        //             )) ||
        //             (row.status === 3 && (
        //                 <span className="badge bg-light-warning">
        //                     <span>
        //                         {getFormattedMessage(
        //                             "status.filter.ordered.label"
        //                         )}
        //                     </span>
        //                 </span>
        //             ))
        //         );
        //     },
        // },
        {
            name: getFormattedMessage("purchase.grant-total.label"),
            // selector: row => row.currency + ' ' + parseFloat(row.grand_total).toFixed(2),
            sortField: "grand_total",
            cell: (row) => {
                return row.reference_code === "Total" ? (
                    <span className="fw-bold fs-4">
                        {currencySymbolHandling(
                            allConfigData,
                            row.currency,
                            row.grand_total
                        )}
                    </span>
                ) : (
                    <span>
                        {currencySymbolHandling(
                            allConfigData,
                            row.currency,
                            row.grand_total
                        )}
                    </span>
                );
            },
            sortable: true,
        },
        // {
        //     name: getFormattedMessage('dashboard.recentSales.paid.label'),
        //     // selector: row => row.currency + ' ' + parseFloat(row.paid).toFixed(2),
        //     sortField: 'paid',
        //     cell: row => {
        //         return row.reference_code === "Total" ? <span
        //                 className="fw-bold fs-4">{currencySymbolHandling(allConfigData, row.currency, row.paid)}</span> :
        //             <span>{currencySymbolHandling(allConfigData, row.currency, row.paid)}</span>
        //     },
        //     sortable: false,
        // },
        // {
        //     name: getFormattedMessage('dashboard.recentSales.due.label'),
        //     cell: row => {
        //         return row.reference_code === "Total" ? <span
        //                 className="fw-bold fs-4">{currencySymbolHandling(allConfigData, row.currency, row.due)}</span> :
        //             <span>{currencySymbolHandling(allConfigData, row.currency, row.due)}</span>
        //     },
        //     sortField: 'due',
        //     sortable: false,
        // },
        {
            name: getFormattedMessage(
                "globally.react-table.column.status.label"
            ),
            selector: (row) => row.status,
            sortField: "status",
            sortable: false,
            cell: (row) => {
                return   row.reference_code != "Total" ? <ReactSelect isRequired multiLanguageOption={statusFilterOptions} name='status'
                defaultValue={statusDefaultValue[ row.status ]}  onChange={(option) => {  onStatusChange(row.id,option); }} 
                isOptionDisabled={disabledOptions.includes(row.status)}/>
                : '';
            },
        },
        // {
        //     name: getFormattedMessage(
        //         "globally.react-table.column.created-date.label"
        //     ),
        //     selector: (row) => row.date,
        //     sortField: "date",
        //     sortable: true,
        //     cell: (row) => {
        //         return (
        //             row.date && (
        //                 <span className="badge bg-light-info">
        //                     <div className="mb-1">{row.time}</div>
        //                     <div>{row.date}</div>
        //                 </span>
        //             )
        //         );
        //     },
        // },
        (userRole === 1 || userRole === 4 || userRole === 5 || userRole === 6)
        ? {
        
            name: getFormattedMessage("react-data-table.action.column.label"),
            right: true,
            ignoreRowClick: true,
            allowOverflow: true,
            button: true,
            cell: (row) =>
                row.reference_code === "Total" ? null : (
                    <ActionDropDownButton
                        item={row}
                        isPdfIcon={true}
                        isEditMode={true} onClickDeleteModel={false}
                        isViewIcon={true}
                        isDeleteIcon={false}
                        onPdfClick={onPdfClick}
                        goToDetailScreen={goToDetailScreen}
                        onShowPaymentClick={onShowPaymentClick}
                        // isPaymentShow={true}
                        title={getFormattedMessage("purchase.title")}
                    />
                ),
        } : null,
        ].filter(column => column !== null);

    return (
        <MasterLayout>
            <TopProgressBar />
            <TabTitle title={placeholderText("purchases.title")} />
            <div className="purchases_table">
                <ReactDataTable
                    columns={columns}
                    items={tableArray}
                    onChange={onChange}
                    isLoading={isLoading}
                    isShowDateRangeField
                    totalRows={totalRecord}
                    isShowFilterField
                    isStatus
                />
            </div>
            
            <ShowPayment
                onShowPaymentClick={onShowPaymentClick}
                isShowPaymentModel={isShowPaymentModel}
            />
        </MasterLayout>
    );
};

const mapStateToProps = (state) => {
    const userRoleArray = localStorage.getItem('loginUserArray');
    const parsedRoles = JSON.parse(userRoleArray);
    const userRole = parsedRoles.roles[0].id;

    // const userRole = parsedRoles ? parsedRoles.id : null; // Provide a default value or fallback mechanism
    const {
        purchases,
        totalRecord,
        isLoading,
        warehouses,
        suppliers,
        frontSetting,
        fetchFrontSetting,
        allConfigData,
    } = state;
    return {
        purchases,
        totalRecord,
        isLoading,
        warehouses,
        suppliers,
        frontSetting,
        fetchFrontSetting,
        allConfigData,
        userRole
    };
};

export default connect(mapStateToProps, {
    fetchPurchases,
    fetchOrders,
    fetchAllWarehouses,
    fetchAllSuppliers,
    purchasePdfAction,
    fetchFrontSetting,
    changePurchaseStatus
})(Product);
