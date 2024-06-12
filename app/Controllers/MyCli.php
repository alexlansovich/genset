<?php

namespace App\Controllers;

use App\Models\RunsModel;
use CodeIgniter\CLI\CLI;

class MyCli extends BaseController
{

    public function reportRunsDay()
    {
        $model = model(RunsModel::class);
        $startOfDay = strtotime('yesterday');
        //$startOfDay = strtotime('-3 day');
        //$endOfDay = strtotime('yesterday')-1;
        $endOfDay = strtotime('today')-1;

        CLI::write('Початок: ' . date('d-m-Y H:i:s', $startOfDay), 'green');
        CLI::write('Завершення: ' . date('d-m-Y H:i:s', $endOfDay), 'green');

        $getRunsDay = $model->getRunsDay($startOfDay, $endOfDay);
        $getRunsDay = $model->parseRuns($getRunsDay);

        $thead = ['Адреса', 'Генератор', 'Запуск', 'Зупинка', 'Час роботи', 'Тип', 'Результат'];
        $tbody = [];
        foreach ($getRunsDay as $run)
        {
            if (!empty($run['stopDate']))
                $stopDate = date('d-m-Y H:i:s', $run['stopDate']);
            else $stopDate = 'Працює зараз';
            $tbody[] = [
                $run['city'].', '.$run['address'],
                $run['type_name'],
                date('d-m-Y H:i:s', $run['startDate']),
                $stopDate,
                $run['worktime'],
                $run['runType'],
                $run['runResult']
                ];
        }

        CLI::table($tbody, $thead);

        return PHP_EOL;
    }

    public function reportRunsDayMail()
    {
        $model = model(RunsModel::class);
        $startOfDay = strtotime('+7 hours',strtotime('yesterday'));
        //$startOfDay = strtotime('today');
        //$startOfDay = strtotime('-3 day');
        //$endOfDay = strtotime('yesterday')-1;
        $endOfDay = strtotime('+7 hours',strtotime('today'))-1;

        $getRunsDay = $model->getRunsDay($startOfDay, $endOfDay);
        $getRunsDay = $model->parseRuns($getRunsDay);

        $thead = ['Адреса', 'Генератор', 'Запуск', 'Зупинка', 'Час роботи', 'Тип', 'Результат'];
        $tbody = [];
        foreach ($getRunsDay as $run)
        {
            if (!empty($run['stopDate']))
                $stopDate = date('d-m-Y H:i:s', $run['stopDate']);
            else $stopDate = 'Працює зараз';
            $tbody[] = [
                $run['city'].', '.$run['address'],
                $run['type_name'],
                date('d-m-Y H:i:s', $run['startDate']),
                $stopDate,
                $run['worktime'],
                $run['runType'],
                $run['runResult']
                ];
        }

        $tableHTML = "<h2>Час роботи генераторів</h2>";
        $tableHTML .= "<h2>Звіт з 07:00 вчора по 07:00 сьогодні</h2>";
        $tableHTML .= "<h3>"
            . date('d-m-Y H:i', $startOfDay)
            . " - "
            . date('d-m-Y H:i', $endOfDay)
            . "</h3>";
        $tableHTML .= "<table border='1'>";
        // Concatenate table header
        $tableHTML .= "<thead><tr>";
        foreach ($thead as $head) {
            $tableHTML .= "<th>$head</th>";
        }
        $tableHTML .= "</tr></thead>";
        // Concatenate table body
        $tableHTML .= "<tbody>";
        foreach ($tbody as $row) {
            $tableHTML .= "<tr>";
            foreach ($row as $cell) {
                $tableHTML .= "<td>$cell</td>";
            }
            $tableHTML .= "</tr>";
        }
        $tableHTML .= "</tbody>";

        $tableHTML .= "</table>";



        $email = \Config\Services::email();


        $email->setFrom('system-generator@DOMAIN', 'Генератор');
        $email->setTo('recepient1@DOMAIN');
        $email->setCC('recepient2@DOMAIN');
        $email->setReplyTo('system-generator@DOMAIN', 'Admin');
        $email->setSubject('Звіт по генераторах');
        $email->setMessage($tableHTML);
        $email->send();

        return PHP_EOL;
    }

}
