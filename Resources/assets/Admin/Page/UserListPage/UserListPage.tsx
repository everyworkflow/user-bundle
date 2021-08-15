/*
 * @copyright EveryWorkflow. All rights reserved.
 */

import React, {useContext, useEffect} from 'react';
import PanelContext from "@EveryWorkflow/AdminPanelBundle/Admin/Context/PanelContext";
import {ACTION_SET_PAGE_TITLE} from "@EveryWorkflow/AdminPanelBundle/Admin/Reducer/PanelReducer";
import DataGridComponent from "@EveryWorkflow/DataGridBundle/Component/DataGridComponent";
import {DATA_GRID_TYPE_PAGE} from "@EveryWorkflow/DataGridBundle/Component/DataGridComponent/DataGridComponent";
import {useHistory} from "react-router-dom";

const UserListPage = () => {
    const {dispatch: panelDispatch} = useContext(PanelContext);
    const history = useHistory();

    useEffect(() => {
        panelDispatch({type: ACTION_SET_PAGE_TITLE, payload: 'User list'});
    }, [panelDispatch]);

    return (
        <>
            <DataGridComponent
                dataGridUrl={'/user' + history.location.search}
                dataGridType={DATA_GRID_TYPE_PAGE}
            />
        </>
    );
};

export default UserListPage;
