<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Repair;
use App\Models\Request;
use App\Models\Tool;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create(['is_admin' => 1, 'email' => 'admin@email.com']);//Creating one admin

        $mechanics = Mechanic::factory()->count(10)->create();
        DB::table('services')->insert([
            ['price' => 200, 'name' => 'Замена масла в двигателе', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Компьютерная диагностика', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 80, 'name' => 'Замена воздушного фильтра двигателя', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 80, 'name' => 'Замена воздушного фильтра салона', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 80, 'name' => 'Замена масла в КПП', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 250, 'name' => 'Замена охлаждающей жидкости', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 2000, 'name' => 'Замена комплекта ремня ГРМ с роликами и водяной помпой', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Промывка двигателя', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Регулярный осмотр автомобиля', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Первичный осмотр автомобиля', 'category' => 'Сервисное ТО', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Диагностика тормозной системы', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Замена передних тормозных колодок', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Замена задних тормозных колодок', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 300, 'name' => 'Дисковый тормоз', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 300, 'name' => 'Замена тормозной жидкости', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена задних тормозных дисков', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена барабанных колодо', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Замена тормозных барабанов', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Проточка тормозных дисков (со снятием)', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Замена тормозного шланга', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 550, 'name' => 'Замена троса ручного тормоза', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 300, 'name' => 'Регулировка ручного тормоза', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Ремонт суппорта', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Замена главного тормозного цилиндра', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена рабочего тормозного цилиндра', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 900, 'name' => 'Замена вакуумного усилителя тормозов', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена датчика ABS', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Прокачка тормозной системы', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена тормозного барабана с подшипником', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Замена тормозного суппорта', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена ремкомплекта тормозного суппорта', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена передних тормозных дисков', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 450, 'name' => 'Замена заднего тормозного цилиндра', 'category' => 'Тормозная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 200, 'name' => 'Диагностика ходовой части автомобиля', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Замена подшипника ступицы', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 550, 'name' => 'Замена передних амортизаторов', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена задних амортизаторов', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена шаровой опоры', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 100, 'name' => 'Замена втулки стабилизатора', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 140, 'name' => 'Замена стойки стабилизатора', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена пружин подвески', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Замена опоры передней стойки', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 600, 'name' => 'Предпокупочная диагностика автомобиля', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Развал-схождения (1 ось)', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Развал-схождения (2 ось)', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 560, 'name' => 'Замена ступицы', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1800, 'name' => 'Снятие-установка задней балки', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 2100, 'name' => 'Снятие-установка моста', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Снятие-установка переднего рычага', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1400, 'name' => 'Снятие-установка подрамник', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 500, 'name' => 'Замена сайлентблоков рычага', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 300, 'name' => 'Замена рычага продольного', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена переднего рычага', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 450, 'name' => 'Замена подвесного подшиника', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 250, 'name' => 'Замена сайлентблока плавающего', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 450, 'name' => 'Замена сайлентблока балки', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 450, 'name' => 'Замена подушки двигателя', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 2300, 'name' => 'Замена сайлентблоков подрамника', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена сальника полуоси', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена отбойников', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Снятие-установка рессор', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 140, 'name' => 'Замена наконечника рулевой тяги', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена верхней опоры амортизатора', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 225, 'name' => 'Замена сайлентблоков', 'category' => 'Подвеска', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Диагностика рулевого управления', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 735, 'name' => 'Замена рулевой рейки и насоса', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1400, 'name' => 'Ремонт рулевой рейки и насоса', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 228, 'name' => 'Замена жидкости ГУР', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 280, 'name' => 'Замена рулевой тяги', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена пыльника рулевой тяги', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 140, 'name' => 'Замена элементов рулевого управления', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена бачка ГУР', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Замена насоса ГУР', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Ремонт рулевого карданчика', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1750, 'name' => 'Снятие-установка-ремонт насоса ГУР', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Снятие-установка-ремонт трубки ГУР', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена пыльника рулевой рейки', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1400, 'name' => 'Снятие-установка рулевой рейки', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена рулевого наконечника', 'category' => 'Рулевое управление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 280, 'name' => 'Диагностика двигателя', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена водяной помпы', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1750, 'name' => 'Замена турбины', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 10000, 'name' => 'Капитальный ремонт двигателя', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 6300, 'name' => 'Ремонт головки блока цилиндров (ГБЦ)', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена термостата', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена радиатора охлаждения', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 3150, 'name' => 'Замена прокладки блока цилиндров (ГБЦ)', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 3500, 'name' => 'Замена цепи ГРМ', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена датчика коленвала и распредвала', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1275, 'name' => 'Замена турбины', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 245, 'name' => 'Замена термостата', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 450, 'name' => 'Замена радиатора охлаждения', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 3500, 'name' => 'Замена ДВС', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 725, 'name' => 'Замена прокладки клапанной крышки', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1750, 'name' => 'Снятие/установка турбины', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Замена шкива коленвала', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 2400, 'name' => 'Замена заднего сальника коленвала', 'category' => 'Двигатель', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Диагностика топливной системы', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 300, 'name' => 'Замена топливного фильтра', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена бензиновой форсунки', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 550, 'name' => 'Замена дроссельной заслонки', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1000, 'name' => 'Замена топливного бака', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1050, 'name' => 'Промывка топливного бака', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1050, 'name' => 'Чистка инжектора', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1050, 'name' => 'Замена дизельных форсунок', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Чистка дроссельной заслонки', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Снятие-установка форсунок', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена бензонасоса подвесного', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 560, 'name' => 'Замена бензонасоса погружного (в баке)', 'category' => 'Топливная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Диагностика электрики', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Настройка системы зажигания', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 210, 'name' => 'Замена свечей зажигания', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена генератора', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 105, 'name' => 'Замена аккумуляторной батареи', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена стартера', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 110, 'name' => 'Замена катушки зажигания', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 100, 'name' => 'Замена автолампочек', 'category' => 'Электрика', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Диагностика выхлопной системы', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 210, 'name' => 'Замена лямбда-зонда', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена катализатора	', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 420, 'name' => 'Установка пламегасителя', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Замена сажевого фильтра', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена глушителя', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Ремонт глушителя', 'category' => 'Выхлопная система', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 100, 'name' => 'Диагностика сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Замена главного цилиндра сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1610, 'name' => 'Замена двухмассового маховика', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Регулировка тросика сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1400, 'name' => 'Замена комплекта сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 490, 'name' => 'Замена рабочего цилиндра сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 770, 'name' => 'Замена тросика сцепления', 'category' => 'Сцепление', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Установка ксенона', 'category' => 'Дополнительно', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 2275, 'name' => 'Установка сигнализации', 'category' => 'Дополнительно', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 445, 'name' => 'Установка защиты двигателя', 'category' => 'Дополнительно', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1225, 'name' => 'Установка парктроника', 'category' => 'Дополнительно', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Установка фаркопа', 'category' => 'Дополнительно', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 260, 'name' => 'Демонтаж и монтаж покрышки R13-14', 'category' => 'Шиномонтаж', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 360, 'name' => 'Демонтаж и монтаж покрышки R15-17', 'category' => 'Шиномонтаж', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 480, 'name' => 'Демонтаж и монтаж покрышки R18-19', 'category' => 'Шиномонтаж', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Диагностика трансмиссии', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 10500, 'name' => 'Ремонт АКПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 4200, 'name' => 'Замена АКПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1400, 'name' => 'Замена МКПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 455, 'name' => 'Замена масла АКПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена масла МКПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена полуоси', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена пыльника ШРУС', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена ШРУС', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 175, 'name' => 'Замена масла в элементах трансмиссии', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена сальников полуоси', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 525, 'name' => 'Замена подвесного подшипника', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Ремонт рычага КПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 1225, 'name' => 'Cнятие-установка КПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 350, 'name' => 'Замена опоры КПП', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 700, 'name' => 'Снятие-установка кардана', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
            ['price' => 630, 'name' => 'Снятие-установка раздаточной коробки', 'category' => 'Трансмиссия', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $services = Service::all();
        $tools = Tool::factory()->count(250)->create();
        $mechanicIds = $mechanics->pluck('id');

        User::factory()->count(50)->create()->each(function ($user) use ($tools, $mechanicIds, $services) {
            $cars = Car::factory()->count(rand(1, 3))->create(['user_id' => $user->id]);
            $cars->shuffle();
            $shuffledCarsIds = $cars->pluck('id');
            Request::factory()->count(rand(1, 2))
                ->create(['user_id' => $user->id, 'car_id' => $shuffledCarsIds->random()])
                ->each(function ($request) use ($tools, $mechanicIds, $services) {
                    $randRequestService = rand(1, 5);
                    $randMechanicId = $mechanicIds->random();
                    for ($i = 0; $i < $randRequestService; $i++) {
                        $serviceId = $services->pluck('id')->random();
                        $request->services()->attach($serviceId);
                        if ($request->status === 1) {
                            Repair::factory()->create(
                                ['request_id' => $request->id, 'mechanic_id' => $randMechanicId,
                                    'service_id' => $serviceId, 'result' => Str::random(15),
                                    'payment' => (Service::find($serviceId)->price + round(rand(0, 300), -2)), 'status' => 1]
                            );
                        } elseif ($i === 0) {
                            Repair::factory()->create(
                                ['request_id' => $request->id, 'mechanic_id' => $randMechanicId,
                                    'service_id' => $serviceId, 'result' => null, 'status' => 0]
                            );
                        } else {
                            $rand = rand(0, 1);
                            Repair::factory()->create(
                                ['request_id' => $request->id, 'mechanic_id' => $randMechanicId,
                                    'service_id' => $serviceId,
                                    'payment' => $rand ? (Service::find($serviceId)->price + round(rand(0, 300), -2)) : null,
                                    'result' => $rand ? Str::random(15) : null, 'status' => $rand]
                            );
                        }
                    }
                });
        });
        $repairs = Repair::all();
        $repairs->each(function ($repair) use ($tools) {
            $repair->tools()->attach($tools->pluck('id')->random(rand(0, 3)), ['used_quantity' => rand(0, 15)]);
        });
    }
}
