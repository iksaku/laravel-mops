<?php

namespace iksaku\Laravel\Mops\Console;

use iksaku\Laravel\Mops\Util;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Process\Process;

class UpgradeLaravelMixCommand extends Command
{
    protected $signature = 'mops:upgrade-mix';

    protected $description = 'Upgrade your installation of Laravel Mix to v6.';

    public function handle()
    {
        $this->comment('Upgrading Laravel Mix to v6...');

        Util::updateNodePackages(function ($packages) {
            return array_merge(
                Arr::except($packages, 'vue-template-loader'),
                [
                    'laravel-mix' => '^6.0.0'
                ]
            );
        });

        Util::updateNodePackageFile(fn ($scripts) => array_merge(
            $scripts,
            [
                'development' => 'mix',
                'watch' => 'mix watch',
                'watch-poll' => 'mix watch --watch-options-poll=1000',
                'hot' => 'mix --hot',
                'production' => 'mix --production'
            ]
        ), 'scripts');

        if (!env('INSTALLING-MOPS', false)) {
            // Install Yarn packages
            (new Process(['yarn', 'install'], base_path()))
                ->setTimeout(null)
                ->run(function ($type, $output) {
                    $this->output->write($output);
                });
        }

        $this->info('Laravel Mix has been upgraded to v6.');
        $this->warn('Make sure to read the v6 upgrade guide: https://github.com/JeffreyWay/laravel-mix/blob/master/UPGRADE.md');
    }
}