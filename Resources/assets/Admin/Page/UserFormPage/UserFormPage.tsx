/*
 * @copyright EveryWorkflow. All rights reserved.
 */

import React from 'react';
import DataFormPageComponent from '@EveryWorkflow/DataFormBundle/Component/DataFormPageComponent';
const UserFormPage = () => {
    return (
        <DataFormPageComponent
            title="User"
            getPath="/user/{uuid}"
            savePath="/user/{uuid}"
        />
    );
};

export default UserFormPage;
