<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\DeviceService;
use Illuminate\Console\Command;

class UserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';
    protected $service;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание пользователя администратора';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->service = resolve(DeviceService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Вы приступаете к созданию пользователя');
        $name = $this->ask('Имя пользователя: ');
        $password = $this->secret('Пароль пользователя: ');
        $email = $this->ask('Email пользователя: ');
        $seed = $this->choice('Создать тестовые данные?', ['Да', 'Нет']);

        $factory = User::factory([
            'name' => $name,
            'password' => \Hash::make($password),
            'email' => $email
        ]);

        if ($seed === 'Да') {
            $factory = $factory->has($this->service->deviceFactory(20), 'devices');
        }

        $factory->create();

        $this->info('Успешно!');
        return true;
    }
}
