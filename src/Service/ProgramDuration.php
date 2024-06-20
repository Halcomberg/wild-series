<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{
    public function calculate(Program $program): array
    {
        $totalMinutes = 0;

        foreach ($program->getSeasons() as $season) {
            foreach ($season->getEpisodes() as $episode) {
                $totalMinutes += $episode->getDuration();
            }
        }

        return $this->convertMinutesToDaysHoursMinutes($totalMinutes);
    }

    private function convertMinutesToDaysHoursMinutes(int $totalMinutes): array
    {
        $jours = (round(($totalMinutes / 1440) * 2)) / 2;
        $heures = round((($totalMinutes % 1440) / 60), 0.5);
        $minutes = $totalMinutes % 60;

        return [
            'jours' => $jours,
            'heures' => $heures,
            'minutes' => $minutes,
        ];
    }
}
