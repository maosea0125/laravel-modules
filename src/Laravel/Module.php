<?php

namespace Nwidart\Modules\Laravel;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\ProviderRepository;
use Nwidart\Modules\Module as BaseModule;
use Nwidart\Modules\Support\ModuleStr;

class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public function getCachedServicesPath()
    {
        return ModuleStr::replaceLast('services.php', $this->getSnakeName() . '_module.php', $this->app->getCachedServicesPath());
    }

    /**
     * {@inheritdoc}
     */
    public function registerProviders()
    {
        (new ProviderRepository($this->app, new Filesystem(), $this->getCachedServicesPath()))
            ->load($this->get('providers', []));
    }

    /**
     * {@inheritdoc}
     */
    public function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->get('aliases', []) as $aliasName => $aliasClass) {
            $loader->alias($aliasName, $aliasClass);
        }
    }
}
