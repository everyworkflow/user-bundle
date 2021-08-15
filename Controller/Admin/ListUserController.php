<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UserBundle\Controller\Admin;

use EveryWorkflow\CoreBundle\Annotation\EWFRoute;
use EveryWorkflow\UserBundle\DataGrid\UserDataGrid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListUserController extends AbstractController
{
    protected UserDataGrid $userDataGrid;

    public function __construct(UserDataGrid $userDataGrid)
    {
        $this->userDataGrid = $userDataGrid;
    }

    /**
     * @EWFRoute(
     *     admin_api_path="user",
     *     priority=10,
     *     name="admin_user",
     *     methods="GET"
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        $dataGrid = $this->userDataGrid->setFromRequest($request);

        return (new JsonResponse())->setData($dataGrid->toArray());
    }
}
