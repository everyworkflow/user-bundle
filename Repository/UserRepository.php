<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UserBundle\Repository;

use EveryWorkflow\CoreBundle\Annotation\RepoDocument;
use EveryWorkflow\DataFormBundle\Model\FormInterface;
use EveryWorkflow\EavBundle\Repository\BaseEntityRepository;
use EveryWorkflow\UserBundle\Entity\UserEntity;

/**
 * @RepoDocument(doc_name=UserEntity::class)
 */
class UserRepository extends BaseEntityRepository implements UserRepositoryInterface
{
    protected string $collectionName = 'user_entity_collection';
    protected array $indexNames = ['email'];
    protected string $entityCode = 'user';

    public function getForm(): FormInterface
    {
        $form = parent::getForm();

        //        $form->addField('status', $this->formFieldFactory->createField([
        //            'label' => 'Status',
        //            'name' => 'status',
        //            'field_type' => 'select_field',
        //            'sort_order' => 1,
        //            'options' => [
        //                $this->formFieldFactory->create(Option::class, [
        //                    'key' => 'enable',
        //                    'value' => 'Enable',
        //                ]),
        //                $this->formFieldFactory->create(Option::class, [
        //                    'key' => 'disable',
        //                    'value' => 'Disable',
        //                ]),
        //            ],
        //        ]));
        //        $form->addField('email', $this->formFieldFactory->createField([
        //            'label' => 'Email',
        //            'name' => 'email',
        //            'input_type' => 'email',
        //        ]));
        //        $form->addField('dob', $this->formFieldFactory->createField([
        //            'label' => 'Date of birth',
        //            'name' => 'dob',
        //            'field_type' => 'date_picker_field',
        //        ]));
        //        $form->addField('password', $this->formFieldFactory->createField([
        //            'label' => 'Password',
        //            'name' => 'password',
        //            'input_type' => 'password',
        //        ]));
        //        $form->addField('confirm_password', $this->formFieldFactory->createField([
        //            'label' => 'Confirm password',
        //            'name' => 'password',
        //            'input_type' => 'password',
        //        ]));

        return $form;
    }
}
