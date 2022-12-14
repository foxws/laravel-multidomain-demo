<?php

namespace App\Core\Support\Multitenancy\Tasks;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class SwitchRootUrlTask implements SwitchTenantTask
{
    public function makeCurrent(Tenant $tenant): void
    {
        $scheme = $this->getScheme();

        $this->forceRootUrl("{$scheme}://{$tenant->domain}");
    }

    public function forgetCurrent(): void
    {
        $this->forceRootUrl(config('app.url'));
    }

    protected function forceRootUrl(string $url): void
    {
        URL::forceRootUrl($url);
    }

    protected function getScheme(): string
    {
        return Request::getScheme();
    }
}
