<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UserExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $bundles = $container->getParameter('kernel.bundles');
        $ymlLoader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        if (isset($bundles['EveryWorkflowAuthBundle'])) {
            $ymlLoader->load('auth.yaml');
        }
        if (isset($bundles['EveryWorkflowSettingBundle'])) {
            $ymlLoader->load('setting.yaml');
        }
        if (isset($bundles['EveryWorkflowAdminPanelBundle'])) {
            $ymlLoader->load('admin_panel.yaml');
        }
    }
}
