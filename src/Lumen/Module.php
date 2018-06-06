<?php

namespace Nwidart\Modules\Lumen;

use Nwidart\Modules\Module as BaseModule;
use Nwidart\Modules\Support\ModuleStr;

class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public function getCachedServicesPath()
    {
        return ModuleStr::replaceLast('services.php', $this->getSnakeName() . '_module.php', $this->app->basePath('storage/app/') . 'services.php');
    }

    /**
     * {@inheritdoc}
     */
    public function registerProviders()
    {
        foreach ($this->get('providers', []) as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function registerAliases()
    {
    }
}
