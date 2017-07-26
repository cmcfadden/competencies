<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:cmcfadden/competencies.git');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers

host('cla-rate-dev')
    ->user('mcfa0086')
    ->stage('development')
    // ->identityFile()
    ->set('bin/php', '/opt/rh/rh-php56/root/usr/bin/php')
	->set('deploy_path', '/swadm/var/www/html/');


// $result = run("scl enable rh-php56 'php -v'");
// Tasks

// desc('Restart PHP-FPM service');
// task('php-fpm:restart', function () {
//     // The user must have rights for restart service
//     // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//     run('sudo systemctl restart php-fpm.service');
// });
// after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');
