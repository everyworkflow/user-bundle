<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UserBundle\DataGrid;

use EveryWorkflow\CoreBundle\Model\DataObjectInterface;
use EveryWorkflow\DataFormBundle\Model\FormInterface;
use EveryWorkflow\DataGridBundle\Factory\ActionFactoryInterface;
use EveryWorkflow\DataGridBundle\Model\Action\ButtonAction;
use EveryWorkflow\DataGridBundle\Model\Collection\ArraySourceInterface;
use EveryWorkflow\DataGridBundle\Model\DataGrid;
use EveryWorkflow\DataGridBundle\Model\DataGridConfigInterface;
use EveryWorkflow\UserBundle\Repository\UserRepositoryInterface;

class UserDataGrid extends DataGrid implements UserDataGridInterface
{
    protected UserRepositoryInterface $userRepository;
    protected ActionFactoryInterface $actionFactory;

    public function __construct(
        DataObjectInterface     $dataObject,
        DataGridConfigInterface $dataGridConfig,
        FormInterface           $form,
        ArraySourceInterface    $source,
        UserRepositoryInterface $userRepository,
        ActionFactoryInterface  $actionFactory
    ) {
        parent::__construct($dataObject, $dataGridConfig, $form, $source);
        $this->userRepository = $userRepository;
        $this->actionFactory = $actionFactory;
    }

    public function getConfig(): DataGridConfigInterface
    {
        $config = parent::getConfig();

        /** @var string[] $allColumns */
        $allColumns = array_map(static fn ($field) => $field->getName(), $this->getForm()->getFields());
        $skipAbleFields = ['profile_image', 'password', 'verify_password'];
        $allColumns = array_filter($allColumns, fn ($name) => !in_array($name, $skipAbleFields, true));

        $config->setIsFilterEnabled(true)
            ->setIsColumnSettingEnabled(true)
            ->setActiveColumns($allColumns)
            ->setSortableColumns($allColumns)
            ->setFilterableColumns($allColumns);

        $config->setHeaderActions([
            $this->actionFactory->create(ButtonAction::class, [
                'path' => '/user/create',
                'label' => 'Create new user',
            ]),
        ]);

        $config->setRowActions([
            $this->actionFactory->create(ButtonAction::class, [
                'path' => '/user/{_id}/edit',
                'label' => 'Edit',
            ]),
            $this->actionFactory->create(ButtonAction::class, [
                'path' => '/user/{_id}/delete',
                'label' => 'Delete',
            ]),
        ]);

        $config->setBulkActions([
            $this->actionFactory->create(ButtonAction::class, [
                'path' => '/user/enable/{_id}',
                'label' => 'Enable',
            ]),
            $this->actionFactory->create(ButtonAction::class, [
                'path' => '/user/disable/{_id}',
                'label' => 'Disable',
            ]),
        ]);

        return $config;
    }

    public function getForm(): FormInterface
    {
        return $this->userRepository->getForm();
    }
}
